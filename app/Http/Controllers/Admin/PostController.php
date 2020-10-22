<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(){
        $posts = Post::where('user_id',Auth::id())->orderBy('created_at','desc')->get();
        return view('admin.home', compact('posts'));
    }
    
    public function create(){
        $users = User::all();
        return view('admin.posts.create', compact('users'));
    }

    public function store(Request $request){
        $data = $request->all();

        $request->validate([
            // 'user_id' => 'required',
            'titolo' => 'required|unique:posts',
            'articolo' => 'required|unique:posts',
            // 'slug'=> 'required|unique:posts'
        ]);
        
        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['titolo'], '-');
        $newPost = new Post;
        $newPost->fill($data);
        $salvato = $newPost->save();
        // dd($salvato);
        if($salvato){
            return redirect()->route('admin.posts.index')->with('status', 'Articolo inserito correttamente');
        };
    }

    public function show(Post $post){
        $users = User::all();
        $id = $post['id'];
        $user = $users->find($id);
        $nomeUtente = $user['name'];
        return view('admin.posts.show', compact('post', 'nomeUtente'));
    }
}
