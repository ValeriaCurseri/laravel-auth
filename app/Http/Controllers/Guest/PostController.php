<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\User;

class PostController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('guest.home', compact('posts'));
    }

}
