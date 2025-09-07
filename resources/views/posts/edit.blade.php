@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="container py-5">
    <h2>Edit Post</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $post->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" rows="5" class="form-control" required>{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image (optional)</label>
            @if($post->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$post->image) }}" alt="Post Image" class="img-thumbnail" style="max-height:150px;">
                </div>
            @endif
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select name="category_id" id="category" class="form-select">
                <option value="">-- Select category --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" 
                        @selected(old('category_id', $post->category_id ?? '') == $cat->id)>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <select name="tags[]" id="tags" class="form-select" multiple>
                @foreach($tags as $t)
                    <option value="{{ $t->id }}"
                        @if(in_array($t->id, old('tags', isset($post) ? $post->tags->pluck('id')->toArray() : []))) selected @endif>
                        {{ $t->name }}
                    </option>
                @endforeach
            </select>
            <small class="text-muted">Hold Ctrl/Cmd to select multiple</small>
        </div>
        
        <button type="submit" class="btn btn-dark">Update Post</button>
        <a href="{{ route('posts.myPosts') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
