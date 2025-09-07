@extends('admin.layout')

@section('title', 'Edit Tag')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit Tag</h2>

    <form action="{{ route('admin.tags.update', $tag) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Tag Name</label>
            <input type="text" name="name" id="name" 
                   class="form-control @error('name') is-invalid @enderror" 
                   value="{{ old('name', $tag->name) }}" required>

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
