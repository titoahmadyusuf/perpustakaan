<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <span class="navbar-brand">Perpustakaan</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-light btn-sm">Keluar</button>
            </form>
        </div>
    </nav>
    <div class="container py-4">
        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <h1 class="h4 mb-4">Selamat datang, {{ auth()->user()->name }}</h1>
        <div class="row g-4">
            @forelse($books as $b)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        @if($b->cover_path)
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($b->cover_path) }}" class="card-img-top" alt="{{ $b->title }}" style="height: 180px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                                <span class="text-muted">Tidak ada foto</span>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title mb-1">{{ $b->title }}</h5>
                            <p class="card-subtitle text-muted mb-2">{{ $b->author }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-secondary">Stok: {{ $b->stock }}</span>
                                <span class="text-muted small">{{ $b->published_at ? $b->published_at->format('Y') : '-' }}</span>
                            </div>
                            <div class="mt-3">
                                <form method="POST" action="{{ route('books.borrow', $b) }}">
                                    @csrf
                                    <button class="btn btn-primary w-100" {{ $b->stock <= 0 ? 'disabled' : '' }}>Pinjam</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-light border">Belum ada buku tersedia.</div>
                </div>
            @endforelse
        </div>
        <div class="mt-4">
            {{ $books->links('pagination::bootstrap-5') }}
        </div>
        <div class="mt-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Pinjaman Saya</h5>
                    @if($borrows->isEmpty())
                        <div class="text-muted">Belum ada pinjaman aktif.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Judul</th>
                                        <th>Penulis</th>
                                        <th>Status</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($borrows as $i => $br)
                                        <tr>
                                            <td>{{ $borrows->firstItem() + $i }}</td>
                                            <td>{{ $br->book->title }}</td>
                                            <td>{{ $br->book->author }}</td>
                                            <td>
                                                <span class="badge bg-{{ $br->status === 'borrowed' ? 'warning' : 'success' }}">
                                                    {{ $br->status }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($br->status === 'borrowed' && !$br->returned_at)
                                                    <span class="text-muted">Menunggu pengembalian oleh admin</span>
                                                @else
                                                    <span class="text-muted">Selesai</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            {{ $borrows->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
