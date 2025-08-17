@extends('layouts.main')

@section('title', 'Data Diri Penduduk')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white border-bottom-0 py-3">
                <h5 class="mb-0">
                    <i class="fas fa-user-edit me-2 text-primary"></i>
                    {{ isset($resident) ? 'Edit' : 'Tambah' }} Data Diri
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('residents.store') }}">
                    @csrf

                    <div class="row g-3">
                        <!-- Kolom 1 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nik') is-invalid @enderror" 
                                       id="nik" name="nik" value="{{ old('nik', $resident->nik ?? '') }}" 
                                        maxlength="16">
                                @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">16 digit Nomor Induk Kependudukan</small>
                            </div>

                            <div class="mb-3">
                                <label for="kk" class="form-label">No. KK</label>
                                <input type="text" class="form-control @error('kk') is-invalid @enderror" 
                                       id="kk" name="kk" value="{{ old('kk', $resident->kk ?? '') }}" 
                                       maxlength="16">
                                @error('kk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">16 digit Nomor Kartu Keluarga</small>
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                       id="nama" name="nama" value="{{ old('nama', $resident->nama ?? '') }}" 
                                       >
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row g-2">
                                <div class="col-md-6 mb-3">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" 
                                           id="tempat_lahir" name="tempat_lahir" 
                                           value="{{ old('tempat_lahir', $resident->tempat_lahir ?? '') }}" >
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                           id="tanggal_lahir" name="tanggal_lahir" 
                                           value="{{ old('tanggal_lahir', $resident->tanggal_lahir ?? '') }}" >
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Kolom 2 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" 
                                               id="laki" value="L" 
                                               {{ (old('jenis_kelamin', $resident->jenis_kelamin ?? '') == 'L') ? 'checked' : '' }} >
                                        <label class="form-check-label" for="laki">Laki-laki</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" 
                                               id="perempuan" value="P" 
                                               {{ (old('jenis_kelamin', $resident->jenis_kelamin ?? '') == 'P') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="perempuan">Perempuan</label>
                                    </div>
                                </div>
                                @error('jenis_kelamin')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="agama" class="form-label">Agama <span class="text-danger">*</span></label>
                                <select class="form-select @error('agama') is-invalid @enderror" 
                                        id="agama" name="agama" >
                                    <option value="">Pilih Agama</option>
                                    @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                        <option value="{{ $agama }}" 
                                            {{ old('agama', $resident->agama ?? '') == $agama ? 'selected' : '' }}>
                                            {{ $agama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('agama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status_perkawinan" class="form-label">Status Perkawinan <span class="text-danger">*</span></label>
                                <select class="form-select @error('status_perkawinan') is-invalid @enderror" 
                                        id="status_perkawinan" name="status_perkawinan" >
                                    <option value="">Pilih Status</option>
                                    @foreach(['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'] as $status)
                                        <option value="{{ $status }}" 
                                            {{ old('status_perkawinan', $resident->status_perkawinan ?? '') == $status ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status_perkawinan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="pekerjaan" class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" 
                                       id="pekerjaan" name="pekerjaan" 
                                       value="{{ old('pekerjaan', $resident->pekerjaan ?? '') }}" >
                                @error('pekerjaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Kolom Full Width -->
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                          id="alamat" name="alamat" rows="3" >{{ old('alamat', $resident->alamat ?? '') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row g-2">
                                <div class="col-md-2 mb-3">
                                    <label for="rt" class="form-label">RT <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('rt') is-invalid @enderror" 
                                           id="rt" name="rt" 
                                           value="{{ old('rt', $resident->rt ?? '') }}"  maxlength="3">
                                    @error('rt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="rw" class="form-label">RW <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('rw') is-invalid @enderror" 
                                           id="rw" name="rw" 
                                           value="{{ old('rw', $resident->rw ?? '') }}"  maxlength="3">
                                    @error('rw')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label for="kewarganegaraan" class="form-label">Kewarganegaraan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('kewarganegaraan') is-invalid @enderror" 
                                           id="kewarganegaraan" name="kewarganegaraan" 
                                           value="{{ old('kewarganegaraan', $resident->kewarganegaraan ?? 'WNI') }}" >
                                    @error('kewarganegaraan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection