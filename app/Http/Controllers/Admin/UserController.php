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
use Illuminate\Support\Facades\Hash;

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
        
        $data['password'] = Hash::make($data['password']);

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
    
    public function edit(User $user){
        // SOLO L'UTENTE STESSO PUO MODIFICARE IL SUO PROFILO - L'ADMIN PUO SOLO CREARE E ELIMINARE UTENTI
        // $roles = Role::all();
        // return view('admin.users.create', compact('user','roles'));
    }
    
    public function update(Request $request, User $user){
        // SOLO L'UTENTE STESSO PUO MODIFICARE IL SUO PROFILO - L'ADMIN PUO SOLO CREARE E ELIMINARE UTENTI
        // $data = $request->all();
        
        // $request->validate([
        //     'name' => 'required',
        //     'role_id' => 'required',
        //     'email'=> [
        //         'required',
        //         Rule::unique('users')->ignore($user),
        //     ],
        //     'password'=> 'required'
        // ]);
        // $data['password'] = Hash::make($data['password']);
        
        // $user->update($data);
        
        // return redirect()->route('admin.users.index')->with('status','Utente modificato correttamente');
    }
}
