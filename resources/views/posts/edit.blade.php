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

        <button type="submit" class="btn btn-dark">Update Post</button>
        <a href="{{ route('posts.myPosts') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
