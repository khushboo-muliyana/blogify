@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <h2>Admin Dashboard</h2>
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text fs-4">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Posts</h5>
                    <p class="card-text fs-4">{{ $totalPosts }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Writers</h5>
                    <p class="card-text fs-4">{{ $totalWriters }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Admins</h5>
                    <p class="card-text fs-4">{{ $totalAdmins }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
