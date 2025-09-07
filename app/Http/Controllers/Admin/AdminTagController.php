<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminTagController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('name')->paginate(40);
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:tags,name|max:100']);
        Tag::create(['name'=>$request->name, 'slug'=>Str::slug($request->name)]);
        return redirect()->route('admin.tags.index')->with('success','Tag created.');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate(['name'=>'required|max:100|unique:tags,name,'.$tag->id]);
        $tag->update(['name'=>$request->name, 'slug'=>Str::slug($request->name)]);
        return back()->with('success','Tag updated.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return back()->with('success','Tag deleted.');
    }
}
