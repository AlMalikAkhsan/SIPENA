@extends('layouts.app')

@section('content')
<div class="container py-4">
    
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('admin.saran.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>
            Kembali ke Daftar Saran
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Saran Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h3 class="fw-bold mb-0">{{ $saran->judul }}</h3>
                        <span class="badge rounded-pill px-3 py-2
                            @if($saran->status == 'menunggu') bg-warning
                            @elseif($saran->status == 'dibaca') bg-info
                            @elseif($saran->status == 'ditinjau') bg-purple
                            @elseif($saran->status == 'diterapkan') bg-success
                            @else bg-danger
                            @endif">
                            {{ ucfirst($saran->status) }}
                        </span>
                    </div>

                    <!-- User Info -->
                    <div class="d-flex align-items-center gap-3 py-3 border-bottom">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-user fa-lg text-primary"></i>
                        </div>
                        <div>
                            <div class="fw-semibold">{{ $saran->user->name ?? 'Anonim' }}</div>
                            <div class="text-muted small">
                                <i class="fas fa-envelope me-1"></i>
                                {{ $saran->user->email ?? '-' }}
                            </div>
                            <div class="text-muted small">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $saran->created_at->format('d F Y, H:i') }}
                                <span class="mx-2">•</span>
                                {{ $saran->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="card-body p-4">
                    <h5 class="fw-semibold mb-3">
                        <i class="fas fa-lightbulb text-warning me-2"></i>
                        Isi Saran
                    </h5>
                    <div class="text-muted lh-lg" style="text-align: justify; white-space: pre-line;">{{ $saran->isi }}</div>
                </div>
            </div>

            <!-- Tanggapan Admin -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 p-4">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-comment-dots text-primary me-2"></i>
                        Tanggapan Admin
                    </h5>
                </div>
                <div class="card-body p-4">
                    @if($saran->tanggapan_admin)
                        <!-- Tanggapan Existing -->
                        <div class="alert alert-success border-0 mb-4">
                            <div class="d-flex align-items-start gap-3">
                                <i class="fas fa-check-circle fa-lg mt-1"></i>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-2">Tanggapan Anda</h6>
                                    <p class="mb-2" style="white-space: pre-line;">{{ $saran->tanggapan_admin }}</p>
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        Ditanggapi pada: {{ $saran->tanggapan_at->format('d F Y, H:i') }}
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Form Edit Tanggapan -->
                        <button class="btn btn-outline-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#editTanggapan">
                            <i class="fas fa-edit me-2"></i>
                            Edit Tanggapan
                        </button>

                        <div class="collapse" id="editTanggapan">
                            <form action="{{ route('admin.saran.tanggapi', $saran->id) }}" method="POST">
                                @csrf
                                
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Update Tanggapan</label>
                                    <textarea name="tanggapan_admin" 
                                              class="form-control @error('tanggapan_admin') is-invalid @enderror" 
                                              rows="4" 
                                              required>{{ old('tanggapan_admin', $saran->tanggapan_admin) }}</textarea>
                                    @error('tanggapan_admin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Update Status</label>
                                    <select name="status" class="form-select" required>
                                        <option value="ditinjau" {{ $saran->status == 'ditinjau' ? 'selected' : '' }}>Ditinjau</option>
                                        <option value="diterapkan" {{ $saran->status == 'diterapkan' ? 'selected' : '' }}>Diterapkan</option>
                                        <option value="ditolak" {{ $saran->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>
                                    Update Tanggapan
                                </button>
                            </form>
                        </div>
                    @else
                        <!-- Form Tanggapan Baru -->
                        <form action="{{ route('admin.saran.tanggapi', $saran->id) }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Tanggapan <span class="text-danger">*</span></label>
                                <textarea name="tanggapan_admin" 
                                          class="form-control @error('tanggapan_admin') is-invalid @enderror" 
                                          rows="5" 
                                          placeholder="Tulis tanggapan Anda terhadap saran ini..."
                                          required>{{ old('tanggapan_admin') }}</textarea>
                                @error('tanggapan_admin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Minimal 10 karakter. Berikan tanggapan yang konstruktif.</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Status Setelah Ditanggapi <span class="text-danger">*</span></label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="ditinjau">Ditinjau - Saran akan dikaji lebih lanjut</option>
                                    <option value="diterapkan">Diterapkan - Saran akan/sudah diterapkan</option>
                                    <option value="ditolak">Ditolak - Saran tidak dapat diterapkan</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="alert alert-info border-0 mb-3" style="background: rgba(13, 202, 240, 0.1);">
                                <small class="text-dark">
                                    <i class="fas fa-info-circle me-1"></i>
                                    User akan menerima notifikasi tentang tanggapan Anda.
                                </small>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>
                                Kirim Tanggapan
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Update Status Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary bg-opacity-10 border-0 p-3">
                    <h6 class="fw-bold mb-0 text-primary">
                        <i class="fas fa-tasks me-2"></i>
                        Update Status Cepat
                    </h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.saran.status', $saran->id) }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status Saat Ini</label>
                            <div>
                                <span class="badge
                                    @if($saran->status == 'menunggu') bg-warning
                                    @elseif($saran->status == 'dibaca') bg-info
                                    @elseif($saran->status == 'ditinjau') bg-purple
                                    @elseif($saran->status == 'diterapkan') bg-success
                                    @else bg-danger
                                    @endif">
                                    {{ ucfirst($saran->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ubah Status</label>
                            <select name="status" class="form-select" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="menunggu" {{ $saran->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="dibaca" {{ $saran->status == 'dibaca' ? 'selected' : '' }}>Dibaca</option>
                                <option value="ditinjau" {{ $saran->status == 'ditinjau' ? 'selected' : '' }}>Ditinjau</option>
                                <option value="diterapkan" {{ $saran->status == 'diterapkan' ? 'selected' : '' }}>Diterapkan</option>
                                <option value="ditolak" {{ $saran->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-sync me-2"></i>
                            Update Status
                        </button>
                    </form>
                </div>
            </div>

            <!-- Info Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-success bg-opacity-10 border-0 p-3">
                    <h6 class="fw-bold mb-0 text-success">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Saran
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-muted d-block mb-1">ID Saran</small>
                        <span class="fw-semibold">#{{ str_pad($saran->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>

                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-muted d-block mb-1">Status</small>
                        <span class="badge
                            @if($saran->status == 'menunggu') bg-warning
                            @elseif($saran->status == 'dibaca') bg-info
                            @elseif($saran->status == 'ditinjau') bg-purple
                            @elseif($saran->status == 'diterapkan') bg-success
                            @else bg-danger
                            @endif">
                            {{ ucfirst($saran->status) }}
                        </span>
                    </div>

                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-muted d-block mb-1">Pemberi Saran</small>
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                                <i class="fas fa-user text-primary"></i>
                            </div>
                            <div>
                                <div class="fw-semibold">{{ $saran->user->name ?? 'Anonim' }}</div>
                                <div class="text-muted small">{{ $saran->user->email ?? '-' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-muted d-block mb-1">Tanggal Dibuat</small>
                        <span class="fw-semibold">{{ $saran->created_at->format('d F Y') }}</span>
                        <div class="text-muted small mt-1">{{ $saran->created_at->format('H:i') }} WIB</div>
                    </div>

                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-muted d-block mb-1">Terakhir Diupdate</small>
                        <span class="fw-semibold">{{ $saran->updated_at->format('d F Y') }}</span>
                        <div class="text-muted small mt-1">{{ $saran->updated_at->diffForHumans() }}</div>
                    </div>

                    <div>
                        <small class="text-muted d-block mb-1">Status Tanggapan</small>
                        @if($saran->tanggapan_admin)
                            <span class="badge bg-success">Sudah Ditanggapi</span>
                        @else
                            <span class="badge bg-warning">Belum Ditanggapi</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Delete Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-danger bg-opacity-10 border-0 p-3">
                    <h6 class="fw-bold mb-0 text-danger">
                        <i class="fas fa-trash me-2"></i>
                        Zona Bahaya
                    </h6>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted small mb-3">Tindakan ini tidak dapat dibatalkan. Pastikan Anda yakin sebelum menghapus saran.</p>
                    
                    <form action="{{ route('admin.saran.destroy', $saran->id) }}" 
                          method="POST" 
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus saran ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash me-2"></i>
                            Hapus Saran
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-purple {
    background-color: #6f42c1 !important;
}

.card {
    border-radius: 12px;
}

.btn {
    border-radius: 8px;
    transition: all 0.2s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    border: none;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0a58ca 0%, #084298 100%);
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(13, 110, 253, 0.3);
}

.btn-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    border: none;
}

.btn-danger:hover {
    background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
}
</style>
@endsection