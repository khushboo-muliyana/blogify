@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <section class="py-5 text-center bg-light border-bottom">
        <div class="container">
            <h1 class="display-4 fw-bold">Welcome to My Blog</h1>
            <p class="lead">Read the latest posts from our awesome writers</p>
            <a href="{{ route('register') }}" class="btn btn-dark btn-lg">Get Started</a>
        </div>
    </section>

    <!-- Latest Posts Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="mb-4 text-center">Latest Posts</h2>
            <div class="row">
                @forelse ($posts as $post)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" 
                                     class="card-img-top" alt="{{ $post->title }}">
                           @else
                                <img src="{{ asset('images/default.png') }}" 
                                    class="card-img-top" alt="Default Image">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ Str::limit($post->title, 40) }}</h5>
                                <p class="card-text text-muted">
                                    {{ Str::limit($post->content, 100) }}
                                </p>
                                <small class="text-secondary">
                                    By {{ $post->user->name ?? 'Unknown' }}
                                    • {{ $post->created_at->diffForHumans() }}
                                </small>
                            </div>
                            <div class="card-footer bg-white">
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-dark btn-sm">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">No posts available yet.</p>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $posts->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
@endsection
