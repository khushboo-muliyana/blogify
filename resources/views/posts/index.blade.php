@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>All Posts</h2>

        {{-- Create button: only Admins or Writers --}}
        @auth
            @if(Auth::user()->isAdmin() || Auth::user()->isWriter())
                <a href="{{ route('posts.create') }}" class="btn btn-dark">Create New Post</a>
            @endif
        @endauth
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card h-100 d-flex flex-column shadow-sm">
                    
                    {{-- Post Image --}}
                    @if($post->image)
                        <div class="card-img-container">
                            <img src="{{ asset('storage/'.$post->image) }}" 
                                 class="card-img-top" 
                                 alt="{{ $post->title }}">
                        </div>
                    @else
                        <div class="card-img-container bg-light d-flex align-items-center justify-content-center text-muted">
                            <span>No Image</span>
                        </div>
                    @endif

                    {{-- Post Content --}}
                    <div class="card-body flex-grow-1 d-flex flex-column">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text flex-grow-1">{{ Str::limit($post->content, 100) }}</p>
                        <p class="text-muted mb-0">By {{ $post->user->name }}</p>
                    </div>

                    {{-- Post Actions --}}
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <a href="{{ route('posts.show', $post->id) }}" 
                           class="btn btn-sm btn-secondary">Read More</a>

                        @auth
                            {{-- Show Edit/Delete if owner OR Admin --}}
                            @if(Auth::id() === $post->user_id || Auth::user()->isAdmin())
                                <div class="d-flex gap-2">
                                    <a href="{{ route('posts.edit', $post->id) }}" 
                                       class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('posts.destroy', $post->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Are you sure you want to delete this post?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <p>No posts available.</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
