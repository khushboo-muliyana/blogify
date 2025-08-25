@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <span>Dashboard</span>
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                       class="btn btn-danger btn-sm">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>

                <div class="card-body text-center">
                    <h4 class="mb-3">Welcome, {{ Auth::user()->name }} 🎉</h4>
                    <p class="text-muted">You are logged in as <strong>{{ Auth::user()->email }}</strong></p>

                    <div class="mt-4">
                        <a href="{{ route('home') }}" class="btn btn-primary me-2">Home Page</a>
                        <a href="{{ route('posts.myPosts') }}" class="btn btn-success me-2">Manage Posts</a>
                        <a href="{{ route('posts.create') }}" class="btn btn-warning">Create Post</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
