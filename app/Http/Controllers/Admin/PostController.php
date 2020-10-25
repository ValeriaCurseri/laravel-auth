<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(){
        $posts = Post::where('user_id',Auth::id())->orderBy('id','desc')->get();
        $posts = DB::table('posts')->paginate(5);
        return view('admin.home', compact('posts'));
    }
    
    public function create(){
        $tags = Tag::all();
        return view('admin.posts.create', compact('tags'));
    }

    public function store(Request $request){
        $data = $request->all();

        $request->validate([
            'titolo' => 'required|unique:posts',
            'articolo' => 'required|unique:posts',
        ]);
        
        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['titolo'], '-');
        $newPost = new Post;
        $newPost->fill($data);
        $salvato = $newPost->save();
        // dd($data['tags']); // vedo i dati
        $newPost->tags()->attach($data['tags']); // inserisco i dati
        $newPost->tags()->sync($data['tags']);
        if($salvato){
            return redirect()->route('admin.posts.index')->with('status', 'Articolo inserito correttamente');
        };
    }
    
    public function show(Post $post){
        $users = User::all();
        $id = $post['user_id'];
        $user = $users->find($id);
        $nomeUtente = $user['name'];
        $tags = $post['tags'];
        return view('admin.posts.show', compact('post', 'nomeUtente','tags'));
    }
    
    public function destroy(Post $post){
        $post->delete();
        return redirect()->route('admin.posts.index')->with('status','Articolo cancellato correttamente');
    }
    
    public function edit(Post $post){
        $tags = Tag::all();
        return view('admin.posts.create', compact('post','tags'));
    }
    
    public function update(Request $request, Post $post){
        $data = $request->all();
        
        $request->validate([
            // 'titolo' => 'required|unique:posts',
            // 'articolo' => 'required|unique:posts',
            'titolo' => [
                'required',
                Rule::unique('posts')->ignore($post), // regola che permette di non controllare rispetto all'unicità anche il titolo che sto modidficando. NECESSARIO INSERIRE use Illuminate\Validation\Rule;
            ],
            'articolo' => [
                'required',
                Rule::unique('posts')->ignore($post),
            ]
        ]);
        
        $data['slug'] = Str::slug($data['titolo'], '-');

        if(empty($data['tags'])){                   // SE l'array dei tags è vuoto
            $post->tags()->detach();   // elimino tutti i tags salvati
        } else {                                        // ALTRIMENTI se l'array dei tags non è vuoto e ci sono modifiche
            $post->tags()->sync($data['tags']);     // con sync aggiorno i tags salvati
        }
        
        $post->update($data);
        
        return redirect()->route('admin.posts.index')->with('status','Articolo modificato correttamente');
    }
}
