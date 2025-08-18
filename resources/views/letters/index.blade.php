@extends('layouts.main')

@section('title', 'Layanan Surat')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            @if(auth()->user()->role === 'Sekretaris')
                <a href="{{ route('letters.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-2"></i> Buat Surat Baru
                </a>
            @endif
        </div>
    </div>
</div>

@if($letters->count() > 0)
    <div class="row">
        @foreach($letters as $letter)
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-start border-primary border-3">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $letter->nama_surat }}</h5>
                </div>
                <div class="card-body">                    
                    <div class="d-flex justify-content-between align-items-center">
                        @if(Auth::user()->role === 'Warga')
                            <a href="{{ route('letters.apply', $letter->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-paper-plane me-1"></i> Ajukan
                            </a>
                        @elseif(Auth::user()->role === 'Sekretaris')
                            <div class="btn-group" role="group">
                                <a href="{{ route('letters.edit', $letter->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit me-1"></i> Edit 
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="fas fa-envelope-open-text fa-4x text-muted mb-4"></i>
                    <h4 class="text-muted">Belum Ada Layanan Surat Tersedia</h4>
                    <p class="text-muted">Saat ini belum ada layanan surat yang dapat diajukan.</p>
                    @if(auth()->user()->role === 'sekretaris')
                        <a href="{{ route('letters.create') }}" class="btn btn-primary mt-3">
                            <i class="fas fa-plus-circle me-2"></i> Tambah Layanan Surat
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Modal untuk proses pengajuan -->
<div class="modal fade" id="applyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajukan Surat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="applyForm" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Jenis Surat</label>
                        <input type="text" class="form-control" id="letterName" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="purpose" class="form-label">Tujuan Pembuatan Surat <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="purpose" name="purpose" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dokumen Pendukung</label>
                        <input type="file" class="form-control" name="documents[]" multiple>
                        <small class="text-muted">Unggah dokumen pendukung (jika ada)</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="applyForm" class="btn btn-primary">Ajukan Surat</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Script untuk menangani modal pengajuan surat
    document.addEventListener('DOMContentLoaded', function() {
        const applyButtons = document.querySelectorAll('.apply-btn');
        
        applyButtons.forEach(button => {
            button.addEventListener('click', function() {
                const letterId = this.getAttribute('data-id');
                const letterName = this.getAttribute('data-name');
                
                document.getElementById('letterName').value = letterName;
                document.getElementById('applyForm').action = `/letters/${letterId}/apply`;
                
                const modal = new bootstrap.Modal(document.getElementById('applyModal'));
                modal.show();
            });
        });
    });
</script>
@endpush
@endsection