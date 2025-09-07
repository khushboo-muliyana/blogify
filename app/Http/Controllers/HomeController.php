<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
    $posts = Post::with(['user','category','tags'])->latest()->paginate(6);
        return view('home', compact('posts'));
    }
}
