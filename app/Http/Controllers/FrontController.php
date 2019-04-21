<?php

namespace App\Http\Controllers;

use Facades\App\Repository\YoutubeCache;
use Facades\App\Repository\GithubRepoCache;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    // Show the home page
    public function showHome() {
        return view("home");
    }

    // Show GitHub Repos
    public function showGithub() {
        // Get all of the repos for the page
        $all_repos = GithubRepoCache::getByKey('REPOS');
        return view("github")->with('all_repos', $all_repos);
    }

    // Show YouTube
    public function showYouTube() {
        // Get the Youtube videos
        $videos = YoutubeCache::getByKey('VIDEOS');
        return view("youtube")->with('videos', $videos);
    }
}
