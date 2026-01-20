@extends('admin.layout')
@section('title', 'Users')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Pengguna</h4>
        <span class="text-muted">Total: {{ $users->total() }}</span>
    </div>
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $i => $u)
                        <tr>
                            <td>{{ $users->firstItem() + $i }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td><span class="badge bg-{{ $u->role === 'admin' ? 'primary' : 'secondary' }}">{{ $u->role }}</span></td>
                            <td>{{ $u->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-body">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
