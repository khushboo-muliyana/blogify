<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;

class AdminController extends Controller
{
    public function index()
   {
        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalPosts' => Post::count(),
            'totalWriters' => User::where('role', 'writer')->count(),
            'totalAdmins' => User::where('role', 'admin')->count(),
        ]);
    }
}
