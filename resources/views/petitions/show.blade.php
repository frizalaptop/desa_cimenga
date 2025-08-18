@extends('layouts.main')

@section('title', 'Detail Pengajuan Surat')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Detail Pengajuan Surat</h5>
                <span class="badge bg-{{ [
                    'pending' => 'warning',
                    'disetujui' => 'primary',
                    'ditolak' => 'danger',
                    'selesai' => 'success'
                ][$petition->status] }}">
                    {{ ucfirst($petition->status) }}
                </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted">Informasi Pemohon</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <th width="120">Nama</th>
                                <td>{{ $petition->resident->nama }}</td>
                            </tr>
                            <tr>
                                <th>NIK</th>
                                <td>{{ $petition->resident->nik }}</td>
                            </tr>
                            <tr>
                                <th>TTL</th>
                                <td>{{ $petition->resident->tempat_lahir }}, {{ \Carbon\Carbon::parse($petition->resident->tanggal_lahir)->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th>TTL</th>
                                <td>{{ $petition->resident->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $petition->resident->alamat }}</td>
                            </tr>
                            <tr>
                                <th>Pekerjaan</th>
                                <td>{{ $petition->resident->pekerjaan }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Informasi Pengajuan</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <th width="120">Jenis Surat</th>
                                <td>{{ $petition->letter->nama_surat }}</td>
                            </tr>
                            <tr>
                                <th>Kode Surat</th>
                                <td>{{ $petition->letter->kode_surat }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Pengajuan</th>
                                <td>{{ $petition->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                            
                        </table>
                    </div>
                </div>

                <div class="mt-4">
                    <h6 class="text-muted">Keperluan Pembuatan Surat</h6>
                    <div class="border rounded p-3 bg-light">
                        {{ $petition->keperluan }}
                    </div>
                </div>

                @if($petition->status === 'ditolak' && $petition->alasan_penolakan)
                <div class="alert alert-danger mt-3">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Pengajuan ditolak:</strong> {{ $petition->alasan_penolakan }}
                </div>
                @endif
            </div>
            <!-- Tambahkan tombol aksi di bagian bawah card -->
            @if(auth()->user()->role === 'Sekretaris')
                <div class="card-footer bg-white">
                    @if($petition->status === 'pending')
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('petitions.approve', $petition->id) }}" method="POST" class="mb-3">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                </div>
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-check me-2"></i> Setujui
                                    </button>
                            </form>
                            
                            <form action="{{ route('petitions.reject', $petition->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-times me-2"></i> Tolak
                                    </button>
                            </form>
                                </div>
                        </div>
                    </div>
                    @elseif($petition->status === 'disetujui')
                    <form action="{{ route('petitions.complete', $petition->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check-circle me-2"></i> Selesai
                            </button>
                        </div>
                    </form>
                    @endif
                </div>
            @endif
        </div>
    </div>

    @if(auth()->user()->role === 'Sekretaris')
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Aksi Surat</h5>
            </div>
            <div class="card-body">
                @if($petition->letter->template_file)
                <div class="d-grid gap-2 mb-3">
                    <a href="{{ Storage::url($petition->letter->template_file) }}" 
                       class="btn btn-outline-primary" download>
                        <i class="fas fa-download me-2"></i> Unduh Template
                    </a>
                </div>
                @endif

                @if($petition->status === 'selesai')
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    Surat ini telah selesai diproses pada {{ $petition->updated_at->format('d-m-Y H:i') }}.
                </div>
                @endif
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header bg-white">
                <h5 class="mb-0">Riwayat Proses</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Diajukan</span>
                        <small class="text-muted">{{ $petition->created_at->format('d-m-Y H:i') }}</small>
                    </li>
                    @if($petition->approved_by)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Diproses oleh</span>
                        <small class="text-muted">{{ $petition->approver->name }}</small>
                    </li>
                    @endif
                    @if($petition->status === 'selesai')
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Diselesaikan</span>
                        <small class="text-muted">{{ $petition->updated_at->format('d-m-Y H:i') }}</small>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    @endif
</div>


@endsection