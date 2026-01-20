<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container min-vh-100 d-flex align-items-center justify-content-center py-5">
        <div class="card shadow-sm" style="max-width: 480px; width: 100%;">
            <div class="card-body p-4 p-md-5">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="bg-primary text-white rounded-3 p-2"><i class="fas fa-user-shield"></i></span>
                    <h1 class="h4 fw-bold text-primary mb-0">Admin Perpustakaan</h1>
                </div>
                <h2 class="h5 fw-semibold mb-2">Masuk Admin</h2>
                <p class="text-muted mb-4">Masuk untuk mengelola koleksi dan pengguna.</p>
                <form method="POST" action="{{ route('admin.login.store') }}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="admin@email.com" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi" required>
                        <label for="password">Kata Sandi</label>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Masuk Admin</button>
                </form>
                <p class="text-center mt-3 mb-0">
                    <a href="{{ url('/') }}" class="text-muted text-decoration-none">Kembali ke Beranda</a>
                </p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
