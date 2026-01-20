<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <span class="bg-primary text-white rounded-3 p-2 me-2"><i class="fas fa-book-open"></i></span>
                <span class="fw-bold text-primary">Perpustakaan</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="mainNav">
                <ul class="navbar-nav align-items-center">
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item ms-2">
                            <a class="btn btn-primary rounded-pill" href="{{ route('register') }}">Daftar Sekarang</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <header class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-4 fw-bold mb-3">Perpustakaan untuk Semua <span class="text-primary">Dalam Genggaman.</span></h1>
                    <p class="lead text-muted mb-4">Akses ribuan koleksi buku, jurnal, dan literatur digital secara gratis. Tingkatkan literasi dan temukan inspirasi kapan saja, di mana saja.</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg rounded-3">Mulai Membaca</a>
                    </div>
                </div>
                <div class="col-md-6 text-center mt-4 mt-md-0">
                </div>
            </div>
        </div>
    </header>

    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="text-center fw-bold mb-4">Kenapa Memilih Perpustakaan?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body">
                            <div class="rounded-circle bg-primary-subtle d-inline-flex align-items-center justify-content-center mb-3" style="width:64px;height:64px;">
                                <i class="fas fa-bolt text-primary"></i>
                            </div>
                            <h5 class="card-title">Akses Cepat</h5>
                            <p class="card-text text-muted">Cari dan temukan buku favoritmu hanya dalam hitungan detik dengan fitur pencarian pintar.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body">
                            <div class="rounded-circle bg-primary-subtle d-inline-flex align-items-center justify-content-center mb-3" style="width:64px;height:64px;">
                                <i class="fas fa-mobile-alt text-primary"></i>
                            </div>
                            <h5 class="card-title">Multi Perangkat</h5>
                            <p class="card-text text-muted">Baca melalui smartphone, tablet, atau laptop. Progress membaca akan tersinkronisasi otomatis.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body">
                            <div class="rounded-circle bg-primary-subtle d-inline-flex align-items-center justify-content-center mb-3" style="width:64px;height:64px;">
                                <i class="fas fa-infinity text-primary"></i>
                            </div>
                            <h5 class="card-title">Tanpa Batas</h5>
                            <p class="card-text text-muted">Nikmati koleksi buku terbaru setiap minggunya tanpa ada batasan peminjaman bagi member premium.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <footer class="bg-primary text-muted py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; 2026 Perpustakaan Digital. Dibuat dengan <i class="fas fa-heart text-danger"></i> untuk Literasi Indonesia.</p>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </footer>
