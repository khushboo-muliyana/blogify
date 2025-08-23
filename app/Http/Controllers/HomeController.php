<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->with('user')->paginate(6);
        return view('home', compact('posts'));
    }
}
