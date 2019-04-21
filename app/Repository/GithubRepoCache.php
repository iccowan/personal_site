<?php

namespace App\Repository;

use App\GithubRepo;
use Cache;
use Exception;

class GithubRepoCache
{
    CONST CACHE_KEY = 'GIT';

    public function cache() {
        // Generate the key
        $key = self::CACHE_KEY . '.REPOS';

        // Get all of the repos
        $repos = GithubRepo::orderBy("commits", "DESC")->paginate(20);

        // Update the cache
        Cache::forget($key);
        Cache::forever($key, $repos);
    }

    public function getByKey($key) {
        $key = self::CACHE_KEY . '.' . strtoupper($key);

        a:
        $response = Cache::get($key);

        if($response == null) {
            if(strtoupper($key) == 'REPOS') {
                // Get the repos
                $repos = GithubRepo::orderBy("commits", "DESC")->paginate(20);

                // Cache the repos
                Cache::forget($key);
                Cache::forever($key, $repos);

                // Go back and make sure something cached
                goto a;
            } else {
                // Throw an exception if the key doesn't exist
                throw new Expection("The GitHub Cache Key Does Not Exist");
            }
        }

        return $response;
    }
}
