<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\User;

class HomeController extends Controller
{
    public function index(){
        $posts = Post::all()->sortByDesc('created_at');
        return view('index', compact('posts'));
    }

    public function show($id){
        $users = User::all();
        $post = Post::find($id);
        // dd($post->tags);
        $id = $post->user_id;
        $user = $users->find($id);
        $nomeUtente = $user->name;
        return view('show', compact('post','nomeUtente'));
    }
}
