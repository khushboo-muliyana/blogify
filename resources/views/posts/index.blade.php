@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>All Posts</h2>
        <a href="{{ route('posts.create') }}" class="btn btn-dark">Create New Post</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($post->image)
                        <img src="{{ asset('storage/'.$post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                        <p class="text-muted mb-1">By {{ $post->user->name }}</p>
                        <div class="d-flex justify-content-between">
                            @if(Auth::id() === $post->user_id)
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>No posts available.</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $posts->links() }} <!-- Pagination -->
    </div>
</div>
@endsection
