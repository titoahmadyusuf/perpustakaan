@extends('admin.layout')
@section('title', 'Peminjaman')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Peminjaman</h4>
        @if (session('status'))
            <span class="badge bg-primary">{{ session('status') }}</span>
        @endif
        @if (session('error'))
            <span class="badge bg-danger">{{ session('error') }}</span>
        @endif
    </div>
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Pengguna</th>
                        <th>Judul Buku</th>
                        <th>Status</th>
                        <th>Kondisi</th>
                        <th>Jatuh Tempo</th>
                        <th>Dipinjam</th>
                        <th>Dikembalikan</th>
                        <th>Denda</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($borrows as $i => $br)
                        <tr>
                            <td>{{ $borrows->firstItem() + $i }}</td>
                            <td>{{ $br->user->name }} <span class="text-muted">({{ $br->user->email }})</span></td>
                            <td>{{ $br->book->title }}</td>
                            <td>
                                <span class="badge bg-{{ $br->status === 'borrowed' ? 'warning' : 'success' }}">{{ $br->status }}</span>
                            </td>
                            <td>
                                @if($br->condition)
                                    <span class="badge bg-secondary">{{ $br->condition }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $br->due_date ? $br->due_date->format('d M Y') : '-' }}</td>
                            <td>{{ $br->created_at->format('d M Y H:i') }}</td>
                            <td>{{ $br->returned_at ? $br->returned_at->format('d M Y H:i') : '-' }}</td>
                            <td>
                                @if($br->returned_at)
                                    <span>Rp {{ number_format($br->fine_amount, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($br->status === 'borrowed' && !$br->returned_at)
                                    <button class="btn btn-primary btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#returnModal"
                                            data-action="{{ route('borrows.return', $br) }}"
                                            data-title="{{ $br->book->title }}">
                                        Kembalikan
                                    </button>
                                @else
                                    <span class="text-muted">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-body">
            {{ $borrows->links('pagination::bootstrap-5') }}
        </div>
    </div>
    <div class="modal fade" id="returnModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Pengembalian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="returnForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" class="form-control" id="returnTitle" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kondisi Buku</label>
                            <select name="condition" id="returnCondition" class="form-select" required>
                                <option value="good">Baik</option>
                                <option value="damaged">Rusak</option>
                                <option value="lost">Hilang</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Denda Berdasarkan Kondisi (Rp)</label>
                            <input type="number" name="condition_fine" id="returnConditionFine" class="form-control" min="0" value="0">
                            <div class="form-text">Denda keterlambatan akan otomatis ditambahkan.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Proses Pengembalian</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const returnModal = document.getElementById('returnModal');
        returnModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const action = button.getAttribute('data-action');
            const title = button.getAttribute('data-title');
            const form = document.getElementById('returnForm');
            const titleInput = document.getElementById('returnTitle');
            const conditionSelect = document.getElementById('returnCondition');
            const fineInput = document.getElementById('returnConditionFine');
            form.setAttribute('action', action);
            titleInput.value = title;
            const presetFine = {
                good: 0,
                damaged: 5000,
                lost: 20000,
            };
            conditionSelect.addEventListener('change', () => {
                fineInput.value = presetFine[conditionSelect.value] ?? 0;
            });
            fineInput.value = presetFine[conditionSelect.value] ?? 0;
        });
    </script>
@endsection
