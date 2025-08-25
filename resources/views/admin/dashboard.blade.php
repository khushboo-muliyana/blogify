@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Admin Dashboard</h2>
        <div>
            <a href="{{ route('admin.users.index') }}" class="btn btn-dark me-2">Manage Users</a>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Manage Posts</a>
        </div>
    </div>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Users</h5>
                    <p class="display-6">{{ $stats['users'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Posts</h5>
                    <p class="display-6">{{ $stats['posts'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Writers</h5>
                    <p class="display-6">{{ $stats['writers'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
