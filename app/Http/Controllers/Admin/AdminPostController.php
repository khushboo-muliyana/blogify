<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }
}
