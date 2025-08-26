<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        $users = User::when($q, function ($query) use ($q) {
                $query->where('name', 'like', "%$q%")
                      ->orWhere('email', 'like', "%$q%");
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users', 'q'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,writer,admin',
        ]);

        // Optional: prevent self-demotion to avoid locking yourself out
        if ($user->id === auth()->id() && $request->role !== 'admin') {
            return back()->with('error', "You can't change your own role from admin.");
        }

        $user->role = $request->role;
        $user->save();

        return back()->with('success', "Role updated for {$user->name} to {$user->role}.");
    }


        public function posts(User $user)
    {
        $posts = $user->posts()->latest() ->paginate(10);; // assuming relation user->posts()
        return view('admin.users.posts', compact('user', 'posts'));
    }

}
