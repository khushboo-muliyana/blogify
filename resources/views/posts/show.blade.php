@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="container my-5">
    <div class="card shadow-lg">
        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
        @endif
        <div class="card-body">
            <h1 class="card-title">{{ $post->title }}</h1>
            <p class="text-muted">
                By <strong>{{ $post->user->name }}</strong> 
                • {{ $post->created_at->format('F d, Y') }}
            </p>
            <p class="card-text fs-5">
                {{ $post->content }}
            </p>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">Back to Posts</a>
        </div>
    </div>
</div>
@endsection
