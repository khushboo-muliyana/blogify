<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Storage;  

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

     public function update(Request $request, Post $post)
    {
       $request->validate([
        'title'       => 'required|max:255',
        'content'     => 'required',
        'category_id' => 'nullable|exists:categories,id',
        'tags'        => 'nullable|array',
        'tags.*'      => 'exists:tags,id',
        'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->only('title', 'content', 'category_id');

    // ✅ If a new image is uploaded
    if ($request->hasFile('image')) {
        if ($post->image && Storage::exists($post->image)) {
            Storage::delete($post->image);
        }
        $path = $request->file('image')->store('posts', 'public');
        $data['image'] = $path;
    }

    // Update post
    $post->update($data);

    // ✅ Sync tags (many-to-many)
    $post->tags()->sync($request->tags ?? []);

    return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
    }


    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully.');
    }
}