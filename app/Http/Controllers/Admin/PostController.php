<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\User;

class PostController extends Controller
{
    public function index(){
        $posts = Post::where('user_id',Auth::id())->orderBy('created_at','desc')->get();
        return view('admin.posts.index', compact('posts'));
    }
    
    public function create(){
        $users = User::all();
        return view('admin.posts.create', compact('users'));
    }

    public function store(Request $request){
        $data = $request->all();

        $request->validate([
            'user_id' => 'required',
            'titolo' => 'required|unique:posts',
            'articolo' => 'required|unique:posts'
        ]);

        $newPost = new Post;
        $newPost->fill($data);
        $salvato = $newPost->save();
        // dd($salvato);
        if($salvato){
            return redirect()->route('admin.posts.index')->with('status', 'Articolo inserito correttamente');
        };
    }
}
