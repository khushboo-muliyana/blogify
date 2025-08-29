@extends('admin.layout')

@section('title', 'Manage Posts')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>All Posts</h2>
        <a href="{{ route('posts.create') }}" class="btn btn-dark">Create Post</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Created</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $index => $post)
                    <tr>
                        {{-- Serial number with pagination support --}}
                        <td>{{ $posts->firstItem() + $index }}</td>

                        {{-- Title as plain text, no link --}}
                        <td>{{ \Illuminate\Support\Str::limit($post->title, 60) }}</td>

                        <td>{{ $post->user?->name ?? '—' }}</td>
                        <td>{{ $post->created_at->format('M d, Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this post?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted">No posts found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $posts->links('pagination::bootstrap-5') }}
</div>
@endsection
