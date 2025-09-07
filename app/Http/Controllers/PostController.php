<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Tag;

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
    $posts = Post::with(['user','category','tags'])->latest()->paginate(6);
        return view('posts.index', compact('posts'));
    }

    // Show form to create a post
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        return view('posts.create', compact('categories', 'tags'));
    }

    // Store a new post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
        }

        // create post with category_id
        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'image' => $path,
            'category_id' => $request->category_id,
        ]);

        // attach tags
        $post->tags()->sync($request->tags ?? []);

        if (auth()->user()->role === 'admin') {
         return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
        } else {
            return redirect()->route('posts.myPosts')->with('success', 'Post created successfully.');
        }

    }

    // Show form to edit a post
    public function edit(Post $post)
    {
        // Ensure only the post owner can edit
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
          $categories = Category::orderBy('name')->get();
            $tags = Tag::orderBy('name')->get();
             return view('posts.edit', compact('post', 'categories', 'tags'));
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('uploads', 'public');
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->save();

        // sync tags
        $post->tags()->sync($request->tags ?? []);

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
        $post->load(['category', 'tags', 'user']);

        return view('posts.show', compact('post'));
    }

public function myPosts()
{
    // Only fetch posts created by the logged-in user
    $posts = Post::where('user_id', Auth::id())->latest()->paginate(6);

    return view('posts.my-posts', compact('posts'));
}


}
