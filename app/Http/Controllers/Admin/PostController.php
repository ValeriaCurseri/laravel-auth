<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\User;

class PostController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('admin.posts.index', config('posts')); // view sbagliata
    }
    
    public function create(){
        $users = User::all();
        return view('admin.posts.create', compact('users'));
    }

    public function store(Request $request){
        $data = $request->all();

        $newPost = new Post;
        $newPost->fill($data);
        $salvato = $newPost->save();
        dd($salvato);
        // if($salvato){
        //     return redirect()->route('posts.index');
        // };
    }
}
