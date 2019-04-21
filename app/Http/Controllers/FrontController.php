<?php

namespace App\Http\Controllers;

use App\GithubRepo;
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
        $all_repos = GithubRepo::orderBy("commits", "DESC")->paginate(20);
        return view("github")->with('all_repos', $all_repos);
    }
}
