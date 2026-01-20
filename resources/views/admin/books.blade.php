@extends('admin.layout')
@section('title', 'Buku')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Kelola Buku</h4>
        @if (session('status'))
            <span class="badge bg-primary">{{ session('status') }}</span>
        @endif
    </div>
    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Tambah Buku</h5>
                    <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Judul Buku" value="{{ old('title') }}" required>
                            <label for="title">Judul Buku</label>
                            @error('title') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="author" name="author" placeholder="Penulis" value="{{ old('author') }}" required>
                            <label for="author">Penulis</label>
                            @error('author') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN" value="{{ old('isbn') }}">
                            <label for="isbn">ISBN</label>
                            @error('isbn') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="published_at" name="published_at" placeholder="Tanggal Terbit" value="{{ old('published_at') }}">
                            <label for="published_at">Tanggal Terbit</label>
                            @error('published_at') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" min="0" class="form-control" id="stock" name="stock" placeholder="Stok" value="{{ old('stock', 0) }}" required>
                            <label for="stock">Stok</label>
                            @error('stock') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Deskripsi singkat">{{ old('description') }}</textarea>
                            @error('description') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="cover" class="form-label">Foto Sampul (jpg, png, webp, maks 2MB)</label>
                            <input class="form-control" type="file" id="cover" name="cover" accept="image/*">
                            @error('cover') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Buku</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Buku Terbaru</h5>
                    @if ($books->isEmpty())
                        <div class="text-muted">Belum ada buku. Tambahkan buku melalui formulir di kiri.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Judul</th>
                                        <th>Penulis</th>
                                        <th>ISBN</th>
                                        <th>Stok</th>
                                        <th>Terbit</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($books as $i => $b)
                                        <tr>
                                            <td>{{ $books->firstItem() + $i }}</td>
                                            <td>{{ $b->title }}</td>
                                            <td>{{ $b->author }}</td>
                                            <td>{{ $b->isbn ?? '-' }}</td>
                                            <td>{{ $b->stock }}</td>
                                            <td>{{ $b->published_at ? $b->published_at->format('d M Y') : '-' }}</td>
                                            <td>
                                                @if($b->cover_path)
                                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($b->cover_path) }}" alt="Cover" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td class="text-nowrap">
                                                <button class="btn btn-sm btn-outline-primary me-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editBookModal"
                                                        data-action="{{ route('admin.books.update', $b) }}"
                                                        data-title="{{ $b->title }}"
                                                        data-author="{{ $b->author }}"
                                                        data-isbn="{{ $b->isbn }}"
                                                        data-published="{{ $b->published_at ? $b->published_at->format('Y-m-d') : '' }}"
                                                        data-stock="{{ $b->stock }}"
                                                        data-description="{{ $b->description }}">
                                                    Edit
                                                </button>
                                                <form method="POST" action="{{ route('admin.books.destroy', $b) }}" class="d-inline" onsubmit="return confirm('Hapus buku ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $books->links('pagination::bootstrap-5') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editBookModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editBookForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="edit_title" name="title" placeholder="Judul Buku" required>
                                    <label for="edit_title">Judul Buku</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="edit_author" name="author" placeholder="Penulis" required>
                                    <label for="edit_author">Penulis</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="edit_isbn" name="isbn" placeholder="ISBN">
                                    <label for="edit_isbn">ISBN</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="edit_published_at" name="published_at" placeholder="Tanggal Terbit">
                                    <label for="edit_published_at">Tanggal Terbit</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" min="0" class="form-control" id="edit_stock" name="stock" placeholder="Stok" required>
                                    <label for="edit_stock">Stok</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="edit_description" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="edit_description" name="description" rows="3" placeholder="Deskripsi singkat"></textarea>
                            </div>
                            <div class="col-12">
                                <label for="edit_cover" class="form-label">Foto Sampul (opsional)</label>
                                <input class="form-control" type="file" id="edit_cover" name="cover" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const editModal = document.getElementById('editBookModal');
        editModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const action = button.getAttribute('data-action');
            const form = document.getElementById('editBookForm');
            form.setAttribute('action', action);
            document.getElementById('edit_title').value = button.getAttribute('data-title') || '';
            document.getElementById('edit_author').value = button.getAttribute('data-author') || '';
            document.getElementById('edit_isbn').value = button.getAttribute('data-isbn') || '';
            document.getElementById('edit_published_at').value = button.getAttribute('data-published') || '';
            document.getElementById('edit_stock').value = button.getAttribute('data-stock') || 0;
            document.getElementById('edit_description').value = button.getAttribute('data-description') || '';
            document.getElementById('edit_cover').value = '';
        });
    </script>
@endsection
