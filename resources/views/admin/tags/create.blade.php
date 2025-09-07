@extends('admin.layout')

@section('title', 'Create Tag')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Create Tag</h2>

    <form action="{{ route('admin.tags.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Tag Name</label>
            <input type="text" name="name" id="name" 
                   class="form-control @error('name') is-invalid @enderror" 
                   value="{{ old('name') }}" required>

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-dark">Save</button>
        <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
