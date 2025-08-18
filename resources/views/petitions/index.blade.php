@extends('layouts.main')
@section('title', 'Laporan Pengajuan Surat')
@section('content')

<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-end align-items-center">
            @if(auth()->user()->role === 'Sekretaris' && $petitions->count() > 0)
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#resetAllModal">
                <i class="fas fa-trash-alt me-2"></i> Hapus Semua
            </button>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="petitionsTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pemohon</th>
                                <th>Jenis Surat</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($petitions as $index => $petition)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $petition->resident->nama ?? '-' }}</td>
                                <td>{{ $petition->letter->nama_surat }}</td>
                                <td>{{ $petition->created_at->format('d/m/Y') }}</td>
                                <td>
                                    @php
                                        $badgeClass = [
                                            'pending' => 'bg-warning',
                                            'disetujui' => 'bg-primary',
                                            'ditolak' => 'bg-danger',
                                            'selesai' => 'bg-success'
                                        ][$petition->status];
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ ucfirst($petition->status) }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('petitions.show', $petition->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data pengajuan surat.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($petitions as $petition)
    @if(auth()->user()->role === 'Sekretaris' && $petition->status === 'pending')
        <!-- Modal Approve -->
        <div class="modal fade" id="approveModal{{ $petition->id }}" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel{{ $petition->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('petitions.approve', $petition->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="approveModalLabel{{ $petition->id }}">Setujui Pengajuan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menyetujui pengajuan surat ini?</p>
                            <div class="mb-3">
                                <label for="nomor_surat" class="form-label">Nomor Surat</label>
                                <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Setujui</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Reject -->
        <div class="modal fade" id="rejectModal{{ $petition->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel{{ $petition->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('petitions.reject', $petition->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="rejectModalLabel{{ $petition->id }}">Tolak Pengajuan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menolak pengajuan surat ini?</p>
                            <div class="mb-3">
                                <label for="alasan_penolakan" class="form-label">Alasan Penolakan</label>
                                <textarea class="form-control" id="alasan_penolakan" name="alasan_penolakan" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Tolak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

<div class="modal fade" id="resetAllModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('petitions.reset') }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Konfirmasi Reset</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Anda akan menghapus SEMUA data pengajuan surat. Tindakan ini tidak dapat dibatalkan!</p>
                    <p class="fw-bold">Total data yang akan dihapus: {{ $petitions->count() }}</p>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" id="confirmationCheck" name="confirmationCheck">
                        <label class="form-check-label" for="confirmationCheck">
                            Saya mengerti dan ingin melanjutkan
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus Semua</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endforeach
@endsection