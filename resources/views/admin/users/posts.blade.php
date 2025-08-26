@extends('admin.layout')

@section('title', $user->name . "'s Posts")

@section('content')
    <h2>Posts by {{ $user->name }}</h2>

    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr>
                    <td>{{ $posts->firstItem() + $loop->index }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No posts found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination links --}}
    <div class="mt-3">
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>
@endsection
