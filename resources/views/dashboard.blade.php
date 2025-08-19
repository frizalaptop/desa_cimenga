@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <!-- Sambutan -->
    <div class="col-12">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="card-title">Selamat Datang di Sistem Administrasi Desa</h3>
                        <p class="card-text">Layanan pengurusan surat menyurat dan administrasi warga desa secara online</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="fas fa-landmark fa-4x opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Informasi Pengajuan Surat -->
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header bg-white border-bottom-0 py-3">
                <h5 class="mb-0"><i class="fas fa-file-alt me-2 text-primary"></i> Tata Cara Pengajuan Surat</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item border-0 px-0 py-2">
                        <div class="d-flex align-items-start">
                            <div class="me-3 text-primary">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">1. Registrasi Akun</h6>
                                <p class="small text-muted mb-0">Pastikan Anda sudah terdaftar sebagai warga desa</p>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item border-0 px-0 py-2">
                        <div class="d-flex align-items-start">
                            <div class="me-3 text-primary">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">2. Lengkapi Data Diri</h6>
                                <p class="small text-muted mb-0">Isi data penduduk Anda dengan lengkap dan valid</p>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item border-0 px-0 py-2">
                        <div class="d-flex align-items-start">
                            <div class="me-3 text-primary">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">3. Pilih Jenis Surat</h6>
                                <p class="small text-muted mb-0">Tentukan jenis surat yang Anda butuhkan</p>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item border-0 px-0 py-2">
                        <div class="d-flex align-items-start">
                            <div class="me-3 text-primary">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">4. Ajukan Permohonan</h6>
                                <p class="small text-muted mb-0">Kirim pengajuan surat secara online</p>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item border-0 px-0 py-2">
                        <div class="d-flex align-items-start">
                            <div class="me-3 text-primary">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">5. Tunggu Verifikasi</h6>
                                <p class="small text-muted mb-0">Petugas akan memverifikasi data Anda</p>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item border-0 px-0 py-2">
                        <div class="d-flex align-items-start">
                            <div class="me-3 text-primary">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">6. Ambil Surat</h6>
                                <p class="small text-muted mb-0">Surat dapat diambil di kantor desa setelah selesai</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jenis Surat -->
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header bg-white border-bottom-0 py-3">
                <h5 class="mb-0"><i class="fas fa-envelope me-2 text-primary"></i> Jenis Surat yang Tersedia</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="border p-3 rounded h-100">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-primary-light rounded-circle p-2 me-3">
                                    <i class="fas fa-file-signature text-primary"></i>
                                </div>
                                <h6 class="mb-0">Surat Keterangan</h6>
                            </div>
                            <p class="small text-muted mb-0">Untuk keperluan umum warga</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border p-3 rounded h-100">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-primary-light rounded-circle p-2 me-3">
                                    <i class="fas fa-id-card text-primary"></i>
                                </div>
                                <h6 class="mb-0">Surat Pengantar E-KTP</h6>
                            </div>
                            <p class="small text-muted mb-0">Pengantar pembuatan KTP elektronik</p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Informasi Penting -->
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header bg-white border-bottom-0 py-3">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2 text-primary"></i> Informasi Penting</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h6><i class="fas fa-clock me-2"></i> Jam Layanan</h6>
                    <p class="small mb-0">Senin-Jumat: 08.00 - 14.00 WIB<br>
                    Sabtu: 08.00 - 12.00 WIB</p>
                </div>
                <div class="alert alert-warning">
                    <h6><i class="fas fa-exclamation-triangle me-2"></i> Persyaratan Umum</h6>
                    <p class="small mb-0">Pastikan membawa fotokopi KTP dan KK saat pengambilan surat</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Kontak -->
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header bg-white border-bottom-0 py-3">
                <h5 class="mb-0"><i class="fas fa-phone-alt me-2 text-primary"></i> Kontak & Bantuan</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-start mb-3">
                    <div class="bg-primary-light rounded-circle p-2 me-3">
                        <i class="fas fa-map-marker-alt text-primary"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">Kantor Desa</h6>
                        <p class="small text-muted mb-0">Jl. Desa No. 123, Kecamatan, Kabupaten</p>
                    </div>
                </div>
                <div class="d-flex align-items-start mb-3">
                    <div class="bg-primary-light rounded-circle p-2 me-3">
                        <i class="fas fa-phone text-primary"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">Telepon</h6>
                        <p class="small text-muted mb-0">(021) 12345678</p>
                    </div>
                </div>
                <div class="d-flex align-items-start mb-3">
                    <div class="bg-primary-light rounded-circle p-2 me-3">
                        <i class="fas fa-envelope text-primary"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">Email</h6>
                        <p class="small text-muted mb-0">admin@desa.example</p>
                    </div>
                </div>
                <div class="d-flex align-items-start">
                    <div class="bg-primary-light rounded-circle p-2 me-3">
                        <i class="fas fa-question-circle text-primary"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">Bantuan</h6>
                        <p class="small text-muted mb-0">Hubungi admin jika mengalami kesulitan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection