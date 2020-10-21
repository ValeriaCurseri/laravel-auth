<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('admin.posts.index', config('posts'));
    }
    
    public function create(){
        return view('admin.posts.create');
    }

    public function store(Request $request){
        $data = $request->all();

        $newPost = new Post;
        $newPost->fill($data);
        $salvato = $newPost->save();
        dd($salvato);
    }
}
