<?php

namespace App\Repository;

use App\Youtube;
use Cache;
use Exception;

class YoutubeCache
{
    CONST CACHE_KEY = 'YOUTUBE';

    public function cache() {
        // Generate the key
        $key = self::CACHE_KEY . '.VIDEOS';

        // Get all of the videos
        $videos = Youtube::orderBy("created_at")->get();

        // Update the cache
        Cache::forget($key);
        Cache::forever($key, $videos);
    }

    public function getByKey($key) {
        $key = self::CACHE_KEY . '.' . strtoupper($key);

        a:
        $response = Cache::get($key);

        if($response == null) {
            if(strtoupper($key) == 'VIDEOS') {
                // Get the videos
                $videos = Youtube::orderBy("created_at")->get();

                // Cache the videos
                Cache::forget($key);
                Cache::forever($key, $videos);

                // Go back and make sure something cached
                goto a;
            } else {
                // Throw an exception if the key doesn't exist
                throw new Expection("The Youtube Cache Key Does Not Exist");
            }
        }

        return $response;
    }
}
