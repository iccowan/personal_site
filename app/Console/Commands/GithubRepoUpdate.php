<?php

namespace App\Console\Commands;

use App\GithubRepo;
use Facades\App\Repository\GithubRepoCache;
use Carbon\Carbon;
use Config;
use DB;
use Illuminate\Console\Command;
use GuzzleHttp\Client;

class GithubRepoUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GithubRepo:Update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the GitHub Repositories';

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
        // Gets the current time
        $time_now = Carbon::now()->subMonths(1)->toIso8601String();

        // Start the client and get the repos
        $client = new Client();
        $res = $client->request("GET", "https://api.github.com/user/repos", [
        "headers" => [
            "Authorization" => "token " . Config::get("app.github_secret")
            ]
        ]);
        $repos = json_decode($res->getBody());

        // Loop through the repos and add non-archived repos to the database
        DB::table("github_repos")->truncate();
        foreach($repos as $r) {
            if(!$r->archived && $r->language != null) {
                $repo = new GithubRepo();
                $repo->name = $r->name;
                if($r->language != null) {
                    $repo->lang = $r->language;
                } else {
                    $repo->lang = "Unknown";
                }
                if($r->description != null) {
                    $repo->desc = $r->description;
                } else {
                    $repo->desc = "N/A";
                }
                $repo_recent_commit = new Carbon($r->pushed_at);
                $recent = $repo_recent_commit->format("m/d/Y");
                $repo->most_recent_commit = $recent;

                $repo->url = $r->html_url;

                // Get the number of commits
                $commit_total = 0;
                $res = $client->request("GET", substr($r->commits_url, 0, -6) . "?since=" . $time_now, [
                "headers" => [
                    "Authorization" => "token " . Config::get("app.github_secret")
                    ]
                ]);
                $commits = json_decode($res->getBody());

                foreach($commits as $c) {
                    $commit_total++;
                }

                $repo->commits = $commit_total;
                $repo->save();
            }
        }

        // Cache the results
        GithubRepoCache::cache();
    }
}
