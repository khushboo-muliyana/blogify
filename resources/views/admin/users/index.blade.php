@extends('admin.layout')

@section('title', 'Manage Users')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Users</h2>
        <form method="GET" class="d-flex" action="{{ route('admin.users.index') }}">
            <input type="text" name="q" value="{{ $q }}" class="form-control me-2" placeholder="Search name/email">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </form>
    </div>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th class="text-center">Role</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            <strong>{{ $user->name }}</strong><br>
                            <small class="text-muted">Joined {{ $user->created_at->format('M d, Y') }}</small>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center">
                            <form action="{{ route('admin.users.updateRole', $user) }}" method="POST" class="d-flex justify-content-center">
                                @csrf
                                @method('PATCH')
                                <select name="role" class="form-select form-select-sm w-auto me-2">
                                    <option value="user"   @selected($user->role === 'user')>user</option>
                                    <option value="writer" @selected($user->role === 'writer')>writer</option>
                                    <option value="admin"  @selected($user->role === 'admin')>admin</option>
                                </select>
                                <button class="btn btn-sm btn-primary">Update</button>
                            </form>
                        </td>
                        <td class="text-end">
                            {{-- Optional: add block/delete here later --}}
                            <a href="{{ route('admin.users.posts', $user->id) }}" class="btn btn-sm btn-outline-secondary">View Posts</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $users->links('pagination::bootstrap-5') }}
</div>
@endsection
