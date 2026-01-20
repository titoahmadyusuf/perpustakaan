@extends('admin.layout')
@section('title', 'Dashboard Admin')
@section('content')
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small">Total Pengguna</div>
                            <div class="h4 fw-bold">{{ \App\Models\User::count() }}</div>
                        </div>
                        <span class="bg-primary-subtle rounded-3 p-3"><i class="fas fa-users text-primary"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small">Admin</div>
                            <div class="h4 fw-bold">{{ \App\Models\User::where('role','admin')->count() }}</div>
                        </div>
                        <span class="bg-primary-subtle rounded-3 p-3"><i class="fas fa-user-shield text-primary"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small">Pengguna Baru</div>
                            <div class="h4 fw-bold">{{ \App\Models\User::where('created_at','>=', now()->subDays(7))->count() }}</div>
                        </div>
                        <span class="bg-primary-subtle rounded-3 p-3"><i class="fas fa-user-plus text-primary"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">Aktivitas Terbaru</h5>
            @php($recent = \App\Models\User::latest()->limit(5)->get())
            @if($recent->isEmpty())
                <div class="text-center text-muted py-4">
                    Belum ada aktivitas pengguna. Mulai dengan membuat akun atau melakukan perubahan.
                </div>
            @else
                <ul class="list-group list-group-flush">
                    @foreach($recent as $u)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $u->name }} <span class="text-muted">({{ $u->email }})</span></span>
                            <span class="badge bg-light text-dark">{{ $u->role }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    <div class="alert alert-light border mt-4">
        Selamat datang, <strong>{{ auth()->user()->name }}</strong>. Gunakan menu di kiri untuk mengelola pengguna dan fitur yang akan datang.
    </div>
@endsection
