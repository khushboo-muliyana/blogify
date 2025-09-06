@extends('layouts.app')

@section('title', 'My Posts')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">My Posts</h2>

    @if($posts->count())
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" 
                                     class="card-img-top" alt="{{ $post->title }}">
                        @else
                                <img src="{{ asset('images/default.png') }}" 
                                    class="card-img-top" alt="Default Image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-primary btn-sm">View</a>
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this post?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $posts->links('pagination::bootstrap-5') }}
    @else
        <p class="text-muted">You haven’t created any posts yet.</p>
    @endif
</div>
@endsection
