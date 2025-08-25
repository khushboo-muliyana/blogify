<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // Only authenticated users can access these routes
   public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    // Display all posts
    public function index()
    {
        $posts = Post::latest()->with('user')->paginate(6);
        return view('posts.index', compact('posts'));
    }

    // Show form to create a post
    public function create()
    {
        return view('posts.create');
    }

    // Store a new post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
        }

        Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'image' => $path
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    // Show form to edit a post
    public function edit(Post $post)
    {
        // Ensure only the post owner can edit
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        return view('posts.edit', compact('post'));
    }

    // Update a post
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('uploads', 'public');
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    // Delete a post
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }


    public function show(Post $post)
{
    return view('posts.show', compact('post'));
}

}
