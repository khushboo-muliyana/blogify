<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'posts' => Post::count(),
            'writers' => User::where('role', 'writer')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
