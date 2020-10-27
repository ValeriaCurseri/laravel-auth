<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class HomeController extends Controller
{
    public function index(){
        $posts = Post::all()->sortByDesc('created_at');
        return view('index', compact('posts'));
    }
}
