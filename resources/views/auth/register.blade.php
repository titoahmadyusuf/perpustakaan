<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container min-vh-100 d-flex align-items-center justify-content-center py-5">
        <div class="card shadow-sm" style="max-width: 520px; width: 100%;">
            <div class="card-body p-4 p-md-5">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="bg-primary text-white rounded-3 p-2"><i class="fas fa-book-open"></i></span>
                    <h1 class="h4 fw-bold text-primary mb-0">Perpustakaan</h1>
                </div>
                <h2 class="h5 fw-semibold mb-2">Buat Akun Baru</h2>
                <p class="text-muted mb-4">Daftar untuk mulai meminjam dan membaca buku.</p>
                <form method="POST" action="{{ route('register.store') }}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" required>
                        <label for="name">Nama Lengkap</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="nama@email.com" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi" required>
                        <label for="password">Kata Sandi</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required>
                        <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Daftar</button>
                </form>
                <p class="text-center text-muted mt-3 mb-0">
                    Sudah punya akun?
                    <a href="{{ Route::has('login') ? route('login') : url('/login') }}" class="fw-semibold text-decoration-none">Masuk</a>
                </p>
                <p class="text-center mt-3 mb-0">
                    <a href="{{ url('/') }}" class="text-muted text-decoration-none">Kembali ke Beranda</a>
                </p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
