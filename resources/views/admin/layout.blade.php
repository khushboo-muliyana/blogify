<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="bg-dark text-white p-3 vh-100" style="width: 220px;">
        <h4 class="mb-4">Admin Panel</h4>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">Dashboard</a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('admin.users.index') }}" class="nav-link text-white">Users</a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('admin.posts.index') }}" class="nav-link text-white">Posts</a>
            </li>
        </ul>
    </div>

    <!-- Main content -->
    <div class="flex-grow-1 p-4">
        @yield('content')
    </div>
</div>
</body>
</html>
