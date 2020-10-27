<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        dd(Auth::user());
        if(Auth::user()->role->name == 'editor'){
            $posts = Post::where('user_id', Auth::id())->orderBy('id','desc')->paginate(5);
        } else if(Auth::user()->role->name == 'admin'){
            $posts = Post::paginate(5);
        }
        return view('admin.home', compact('posts'));
    }
}
