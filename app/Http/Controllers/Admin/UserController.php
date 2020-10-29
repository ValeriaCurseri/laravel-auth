<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Role;
use App\User;
use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
        $users = User::paginate(5);
        
        return view('admin.users.home', compact('users'));
    }
    
    public function create(){
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request){
        $data = $request->all();

        $request->validate([
            'name' => 'required',
            'role_id' => 'required',
            'email'=> 'required|unique:users',
            'password'=> 'required'
        ]);
        
        $newUser = new User;
        $newUser->fill($data);
        $salvato = $newUser->save();
        if($salvato){
            return redirect()->route('admin.users.index')->with('status', 'Utente inserito correttamente');
        };
    }
    
    public function show(User $user){
        // NON SERVE
    }
    
    public function destroy(User $user){
        $user->delete();
        return redirect()->route('admin.users.index')->with('status','Utente cancellato correttamente');
    }
    
    public function edit(Post $post){
        // $tags = Tag::all();
        // return view('admin.posts.create', compact('post','tags'));
    }
    
    public function update(Request $request, Post $post){
        // $data = $request->all();
        
        // $request->validate([
        //     // 'titolo' => 'required|unique:posts',
        //     // 'articolo' => 'required|unique:posts',
        //     'titolo' => [
        //         'required',
        //         Rule::unique('posts')->ignore($post), // regola che permette di non controllare rispetto all'unicità anche il titolo che sto modidficando. NECESSARIO INSERIRE use Illuminate\Validation\Rule;
        //     ],
        //     'articolo' => [
        //         'required',
        //         Rule::unique('posts')->ignore($post),
        //     ],
        //     'img'=> 'image'
        // ]);
        
        // $data['slug'] = Str::slug($data['titolo'], '-');

        // if(empty($data['tags'])){                   // SE l'array dei tags è vuoto
        //     $post->tags()->detach();                    // elimino tutti i tags salvati
        // } else {                                    // ALTRIMENTI se l'array dei tags non è vuoto e ci sono modifiche
        //     $post->tags()->sync($data['tags']);         // con sync aggiorno i tags salvati
        // }
        
        // if(!empty($data['img'])){                   // SE da form è stata inserita una nuova immagine
        //     if(!empty($post['img'])){               // E SE era già stata caricata un'immagine per questo articolo
        //         Storage::disk('public')->delete('images',$post['img']); // all'interno della cartella public > storage > images cancello l'immagine memorizzata in precedenza
        //     }
        //     $data['img'] = Storage::disk('public')->put('images',$data['img']); // all'interno della stessa cartella memorizzo il nuovo file
        // }

        // $post->update($data);
        
        // return redirect()->route('admin.posts.index')->with('status','Articolo modificato correttamente');
    }
}
