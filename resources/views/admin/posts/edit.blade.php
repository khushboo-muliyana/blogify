@extends('admin.layout')

@section('title', 'Edit Post')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Edit Post</h4>
        </div>
        <div class="card-body">
            
            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Edit Form --}}
            <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Title --}}
                <div class="mb-3">
                    <label for="title" class="form-label fw-bold">Title</label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           class="form-control" 
                           value="{{ old('title', $post->title) }}" 
                           required>
                </div>

                {{-- Content --}}
                <div class="mb-3">
                    <label for="content" class="form-label fw-bold">Content</label>
                    <textarea name="content" id="content" rows="5" class="form-control" required>{{ old('content', $post->content) }}</textarea>
                </div>


                {{-- Category --}}
                <div class="mb-3">
                    <label for="category_id" class="form-label fw-bold">Category</label>
                    <select name="category_id" id="category_id" class="form-select">
                        <option value="">— No Category —</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tags --}}
                <div class="mb-3">
                    <label for="tags" class="form-label fw-bold">Tags</label>
                    <select name="tags[]" id="tags" class="form-select" multiple>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}"
                                {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Hold Ctrl (Windows) / Cmd (Mac) to select multiple</small>
                </div>

                {{-- Image --}}
                <div class="mb-3">
                    <label for="image" class="form-label fw-bold">Image (optional)</label>
                    @if($post->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/'.$post->image) }}" 
                                 alt="Post Image" 
                                 class="img-thumbnail" 
                                 style="max-height:150px;">
                        </div>
                    @endif
                    <input type="file" name="image" id="image" class="form-control">
                </div>

                {{-- Buttons --}}
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-dark">
                        <i class="bi bi-save"></i> Update Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
