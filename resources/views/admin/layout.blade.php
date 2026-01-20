<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Perpustakaan')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">Admin Perpustakaan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNav" aria-controls="topNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="topNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-gauge-high me-1"></i>Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users') }}"><i class="fas fa-users me-1"></i>Users</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="ms-2">
                            @csrf
                            <button class="btn btn-light btn-sm">Keluar</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <aside class="col-md-2 col-lg-2 d-none d-md-block bg-light border-end min-vh-100">
                <div class="p-3">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span class="bg-primary text-white rounded-3 p-2"><i class="fas fa-user-shield"></i></span>
                        <div>
                            <div class="fw-semibold">{{ auth()->user()->name }}</div>
                            <div class="text-muted small">Admin</div>
                        </div>
                    </div>
                    <nav class="nav flex-column">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
                        <a href="{{ route('admin.users') }}" class="nav-link">Users</a>
                        <a href="{{ route('admin.books') }}" class="nav-link">Buku</a>
                        <a href="{{ route('admin.borrows') }}" class="nav-link">Peminjaman</a>
                    </nav>
                </div>
            </aside>
            <main class="col-md-10 col-lg-10 p-4">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
