@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container text-center py-5">
    <h1 class="display-4">Welcome to Blogify</h1>
    <p class="lead">Your simple and powerful blogging platform built with Laravel & Bootstrap.</p>

    <div class="mt-4">
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-success me-2">Go to Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary me-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
        @endauth
    </div>
</div>
@endsection
