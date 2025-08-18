@extends('layouts.main')
@section('title', 'Manajemen Pengguna')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Pengguna Terdaftar</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="usersTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Tanggal Daftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @php
                                        $badgeClass = [
                                            'Warga' => 'bg-secondary',
                                            'Sekretaris' => 'bg-primary',
                                            'Admin' => 'bg-success'
                                        ][$user->role] ?? 'bg-info';
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ $user->role }}</span>
                                </td>
                                <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    @if(auth()->user()->role === 'Sekretaris' && auth()->id() !== $user->id)
                                        @if($user->role === 'Warga')
                                            <button class="btn btn-sm btn-success" 
                                                    onclick="confirmPromote('{{ $user->id }}', 'Admin')">
                                                <i class="fas fa-user-plus me-1"></i> Jadikan Admin
                                            </button>
                                        @elseif($user->role === 'Sekretaris')
                                            <button class="btn btn-sm btn-warning" 
                                                    onclick="confirmDemote('{{ $user->id }}', 'Warga')">
                                                <i class="fas fa-user-minus me-1"></i> Batalkan Admin
                                            </button>
                                        @endif
                                    @else
                                        <span class="text-muted">Tidak ada aksi</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data pengguna.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Promosi -->
<div class="modal fade" id="promoteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="promoteForm" method="POST">
                @method('PUT')
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Konfirmasi Promosi</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Anda akan mengubah role pengguna menjadi <span id="newRole" class="fw-bold"></span>.</p>
                    <p>Apakah Anda yakin ingin melanjutkan?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Demosi -->
<div class="modal fade" id="demoteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="demoteForm" method="POST">
                @method('PUT')
                @csrf
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">Konfirmasi Demosi</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Anda akan mengubah role pengguna menjadi <span id="demoteRole" class="fw-bold"></span>.</p>
                    <p>Apakah Anda yakin ingin melanjutkan?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function confirmPromote(userId, newRole) {
        const form = document.getElementById('promoteForm');
        form.action = `/users/${userId}/promote`;
        document.getElementById('newRole').textContent = newRole;
        
        const modal = new bootstrap.Modal(document.getElementById('promoteModal'));
        modal.show();
    }

    function confirmDemote(userId, newRole) {
        const form = document.getElementById('demoteForm');
        form.action = `/users/${userId}/demote`;
        document.getElementById('demoteRole').textContent = newRole;
        
        const modal = new bootstrap.Modal(document.getElementById('demoteModal'));
        modal.show();
    }
</script>
@endpush

@endsection