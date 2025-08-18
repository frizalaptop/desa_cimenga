@extends('layouts.main')

@section('title', 'Edit Surat')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-0">
                <i class="fas fa-edit me-2 text-primary"></i>
                Edit Surat
            </h2>
            <a href="{{ route('letters.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
        <p class="text-muted mb-0">Perbarui informasi surat administrasi desa</p>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white border-bottom-0 py-3">
                <h5 class="mb-0">Form Edit Surat</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('letters.update', $letter->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <!-- Kolom 1 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_surat" class="form-label">Nama Surat <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_surat') is-invalid @enderror" 
                                       id="nama_surat" name="nama_surat" 
                                       value="{{ old('nama_surat', $letter->nama_surat) }}" required>
                                @error('nama_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kode_surat" class="form-label">Kode Surat <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kode_surat') is-invalid @enderror" 
                                       id="kode_surat" name="kode_surat" 
                                       value="{{ old('kode_surat', $letter->kode_surat) }}" required>
                                @error('kode_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Kolom Full Width -->
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="template_file" class="form-label">Template Surat</label>
                                <input type="file" class="form-control @error('template_file') is-invalid @enderror" 
                                       id="template_file" name="template_file" accept=".doc,.docx,.pdf">
                                @error('template_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah template</small>
                                
                                @if($letter->template_file)
                                <div class="mt-2">
                                    <span class="badge bg-primary-light text-primary">
                                        <i class="fas fa-file me-1"></i>
                                        Template saat ini: {{ basename("storage/".$letter->template_file) }}
                                    </span>
                                    <a href="{{ Storage::url($letter->template_file) }}" target="_blank" 
                                       class="ms-2 text-primary small" data-bs-toggle="tooltip" title="Lihat Template">
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex justify-content-between mt-4">
                                <div>
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="fas fa-save me-2"></i> Simpan Perubahan
                                    </button>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <i class="fas fa-trash-alt me-2"></i> Hapus Surat
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Informasi Tambahan -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-white border-bottom-0 py-3">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2 text-primary"></i> Informasi Surat</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h6><i class="fas fa-file-alt me-2"></i> Detail Surat</h6>
                    <ul class="small mb-0">
                        <li><strong>Dibuat:</strong> {{ $letter->created_at->format('d M Y') }}</li>
                        <li><strong>Diperbarui:</strong> {{ $letter->updated_at->format('d M Y') }}</li>
                        @if($letter->template_file)
                            <li><strong>Ukuran Template:</strong> {{ round(Storage::disk('public')->size($letter->template_file) / 1024, 2) }} KB</li>
                        @endif
                    </ul>
                </div>

                <div class="alert alert-warning small">
                    <h6><i class="fas fa-exclamation-triangle me-2"></i> Perhatian</h6>
                    <p class="mb-0">Perubahan pada template surat akan mempengaruhi semua pengajuan surat yang akan datang.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i> Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus surat ini?</p>
                <p class="fw-bold">"{{ $letter->nama_surat }}" ({{ $letter->kode_surat }})</p>
                <p class="text-danger small">Aksi ini tidak dapat dibatalkan dan semua data terkait surat ini akan dihapus.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i> Batal
                </button>
                <form action="{{ route('letters.destroy', $letter->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt me-2"></i> Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Inisialisasi tooltip
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endpush