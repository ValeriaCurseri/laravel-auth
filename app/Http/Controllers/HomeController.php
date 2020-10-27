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

    public function show(Post $post){
        $users = User::all();
        // dd($users);
        dd($post);
        $id = $post->user_id;
        // dd($id);
        $user = $users->find($id);
        // dd($user);
        $nomeUtente = $user->name;
        return view('show', compact('post','nomeUtente'));
    }
}
