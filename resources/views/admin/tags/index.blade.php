@extends('admin.layout')

@section('title', 'Manage Tags')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>All Tags</h2>
        <a href="{{ route('admin.tags.create') }}" class="btn btn-dark">Create Tag</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Created</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tags as $index => $tag)
                    <tr>
                        <td>{{ $tags->firstItem() + $index }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->slug }}</td>
                        <td>{{ $tag->created_at->format('M d, Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.tags.edit', $tag) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this tag?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted">No tags found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $tags->links('pagination::bootstrap-5') }}
</div>
@endsection
