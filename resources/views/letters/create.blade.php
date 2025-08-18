@extends('layouts.main')

@section('title', 'Buat Surat Baru')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('letters.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white border-bottom-0 py-3">
                <h5 class="mb-0">Form Tambah Surat</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('letters.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <!-- Kolom 1 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_surat" class="form-label">Nama Surat <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_surat') is-invalid @enderror" 
                                       id="nama_surat" name="nama_surat" value="{{ old('nama_surat') }}" >
                                @error('nama_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Contoh: Surat Keterangan Domisili</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kode_surat" class="form-label">Kode Surat <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kode_surat') is-invalid @enderror" 
                                       id="kode_surat" name="kode_surat" value="{{ old('kode_surat') }}" >
                                @error('kode_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Contoh: SKD-001 (unik)</small>
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
                                <small class="text-muted">Format: .doc atau .docx (maks. 2MB)</small>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex justify-content-end mt-4">
                                <button type="reset" class="btn btn-outline-secondary me-3">
                                    <i class="fas fa-undo me-2"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i> Simpan Surat
                                </button>
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
                <h5 class="mb-0"><i class="fas fa-info-circle me-2 text-primary"></i> Petunjuk</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h6><i class="fas fa-lightbulb me-2"></i> Tips Membuat Surat Baru</h6>
                    <ul class="small mb-0">
                        <li>Gunakan nama surat yang jelas dan mudah dipahami</li>
                        <li>Kode surat harus unik dan tidak boleh sama</li>
                        <li>Template surat harus sesuai format standar desa</li>
                        <li>Pastikan template sudah mencantumkan bagian yang perlu diisi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection