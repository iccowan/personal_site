<?php

namespace App\Console\Commands;

use App\Youtube;
use Facades\App\Repository\YoutubeCache;
use Carbon\Carbon;
use Config;
use DB;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class UpdateYoutube extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'YoutubeVideos:Update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the database for the current number of youtube videos.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Start the client
        $client = new Client();

        // First get the uploads playlist ID
        $result = $client->request("GET", "https://www.googleapis.com/youtube/v3/channels?part=contentDetails&id=" . Config::get('app.youtube_channelId') . "&key=" . Config::get('app.youtube_api'));

        $uploadsId = json_decode($result->getBody())->items[0]->contentDetails->relatedPlaylists->uploads;

        // Now get the first 20 videos from the uploads section
        $result = $client->request("GET", "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet%2Cstatus&maxResults=10&playlistId=" . $uploadsId . "&key=" . Config::get('app.youtube_api'));

        $uploads = json_decode($result->getBody());

        // Delete all of the videos already in the database
        DB::table('youtube_videos')->truncate();

        // Add them to the database if they're public
        foreach($uploads->items as $u) {
            if($u->status->privacyStatus == 'public') {
                $vid = new Youtube();
                $vid->title = $u->snippet->title;
                $upload_date = new Carbon($u->snippet->publishedAt);
                $upload_date = $upload_date->format("M d, Y");
                $vid->upload_date = $upload_date;
                $vid->desc = explode("\n", $u->snippet->description)[0];
                $vid->video_id = $u->snippet->resourceId->videoId;
                $vid->save();
            }
        }

        // Update the cache
        YoutubeCache::cache();
    }
}
