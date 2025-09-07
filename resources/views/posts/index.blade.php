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
                    @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" 
                                                    class="card-img-top" alt="{{ $post->title }}">
                        @else
                    <img src="{{ asset('images/default.png') }}" 
                                                    class="card-img-top" alt="Default Image">
                        @endif

                    {{-- Post Content --}}
                    <div class="card-body flex-grow-1 d-flex flex-column">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        
                        {{-- Category --}}
                        @if($post->category)
                            <p class="mb-1"><strong>Category:</strong> {{ $post->category->name }}</p>
                        @endif

                        {{-- Tags --}}
                        @if($post->tags->count())
                            <p class="mb-2">
                                <strong>Tags:</strong>
                                @foreach($post->tags as $tag)
                                    <span class="badge bg-secondary">{{ $tag->name }}</span>
                                @endforeach
                            </p>
                        @endif
                        <p class="card-text flex-grow-1">{{ Str::limit($post->content, 100) }}</p>
                        <p class="text-muted mb-0">By {{ $post->user->name }}</p>
                    </div>

                    {{-- Post Actions --}}
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <a href="{{ route('posts.show', $post->id) }}" 
                           class="btn btn-sm btn-secondary">Read More</a>
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
