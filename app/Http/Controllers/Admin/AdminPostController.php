<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Storage;  

use App\Models\Post;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function edit(Post $post)
{
    return view('admin.posts.edit', compact('post'));
}

 public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'   => 'required|max:255',
            'content' => 'required',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('title', 'content');

        // ✅ If a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($post->image && Storage::exists($post->image)) {
                Storage::delete($post->image);
            }

            // Store new image
            $path = $request->file('image')->store('posts', 'public');
            $data['image'] = $path;
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
    }


    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully.');
    }
}