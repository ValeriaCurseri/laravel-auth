<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
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
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd(Auth::user());
        // dd(Auth::user()->role);
        if(Auth::user()->role->nome == 'editor'){
            $posts = Post::where('user_id', Auth::id())->orderBy('id','desc')->paginate(5);
        } else if(Auth::user()->role->nome == 'admin'){
            $posts = Post::orderBy('id','desc')->paginate(5);
            // $posts = Post::paginate(5)->sortByDesc('id');
        }
        return view('admin.home', compact('posts'));
        // return view('admin.posts.index', compact('posts'));
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
            'img'=> 'image'
        ]);
        
        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['titolo'], '-');
        $newPost = new Post;
        if(!empty($data['img'])){
            $data['img'] = Storage::disk('public')->put('images',$data['img']);
        }
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
            ],
            'img'=> 'image'
        ]);
        
        $data['slug'] = Str::slug($data['titolo'], '-');

        if(empty($data['tags'])){                   // SE l'array dei tags è vuoto
            $post->tags()->detach();                    // elimino tutti i tags salvati
        } else {                                    // ALTRIMENTI se l'array dei tags non è vuoto e ci sono modifiche
            $post->tags()->sync($data['tags']);         // con sync aggiorno i tags salvati
        }
        
        if(!empty($data['img'])){                   // SE da form è stata inserita una nuova immagine
            if(!empty($post['img'])){               // E SE era già stata caricata un'immagine per questo articolo
                Storage::disk('public')->delete('images',$post['img']); // all'interno della cartella public > storage > images cancello l'immagine memorizzata in precedenza
            }
            $data['img'] = Storage::disk('public')->put('images',$data['img']); // all'interno della stessa cartella memorizzo il nuovo file
        }

        $post->update($data);
        
        return redirect()->route('admin.posts.index')->with('status','Articolo modificato correttamente');
    }
}
