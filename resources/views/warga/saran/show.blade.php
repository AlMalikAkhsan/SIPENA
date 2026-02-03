@extends('layouts.app')

@section('content')
<div class="container py-4">
    
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('warga.saran.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>
            Kembali ke Daftar Saran
        </a>
    </div>

    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Saran Card -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
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

                    <!-- Meta Info -->
                    <div class="d-flex align-items-center gap-3 py-3 border-bottom">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-calendar fa-lg text-primary"></i>
                        </div>
                        <div>
                            <div class="fw-semibold">Dikirim pada</div>
                            <div class="text-muted small">
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
                        Detail Saran
                    </h5>
                    <div class="text-muted lh-lg" style="text-align: justify; white-space: pre-line;">{{ $saran->isi }}</div>
                </div>
            </div>

            <!-- Tanggapan Admin -->
            @if($saran->tanggapan_admin)
                <div class="card border-0 shadow-sm" style="border-radius: 16px; border-left: 4px solid #198754;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-reply fa-lg text-success"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-0">Tanggapan Admin</h5>
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>
                                    {{ $saran->tanggapan_at->format('d F Y, H:i') }}
                                </small>
                            </div>
                        </div>

                        <div class="bg-light rounded-3 p-4">
                            <p class="mb-0 lh-lg" style="white-space: pre-line;">{{ $saran->tanggapan_admin }}</p>
                        </div>

                        <!-- Status Info -->
                        <div class="mt-3 pt-3 border-top">
                            <div class="d-flex align-items-center gap-2">
                                <span class="fw-semibold">Status Saran:</span>
                                <span class="badge
                                    @if($saran->status == 'ditinjau') bg-purple
                                    @elseif($saran->status == 'diterapkan') bg-success
                                    @else bg-danger
                                    @endif">
                                    {{ ucfirst($saran->status) }}
                                </span>
                            </div>
                            
                            @if($saran->status == 'diterapkan')
                                <div class="alert alert-success border-0 mt-3 mb-0" style="background: rgba(25, 135, 84, 0.1);">
                                    <i class="fas fa-check-circle me-2"></i>
                                    <strong>Selamat!</strong> Saran Anda akan diterapkan atau sudah diterapkan oleh pemerintah.
                                </div>
                            @elseif($saran->status == 'ditinjau')
                                <div class="alert alert-info border-0 mt-3 mb-0" style="background: rgba(111, 66, 193, 0.1);">
                                    <i class="fas fa-hourglass-half me-2"></i>
                                    Saran Anda sedang dalam proses peninjauan lebih lanjut.
                                </div>
                            @elseif($saran->status == 'ditolak')
                                <div class="alert alert-warning border-0 mt-3 mb-0" style="background: rgba(220, 53, 69, 0.1);">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Mohon maaf, saran Anda tidak dapat diterapkan saat ini. Terima kasih atas partisipasi Anda.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                    <div class="card-body text-center py-5">
                        <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex p-4 mb-3">
                            <i class="fas fa-hourglass-half fa-2x text-warning"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Menunggu Tanggapan</h5>
                        <p class="text-muted mb-0">Saran Anda sedang ditinjau oleh admin. Anda akan mendapat notifikasi jika ada tanggapan.</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Info Card -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
                <div class="card-header bg-primary bg-opacity-10 border-0 p-3">
                    <h6 class="fw-bold mb-0 text-primary">
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
                            <span class="badge bg-success">
                                <i class="fas fa-check-circle me-1"></i>
                                Sudah Ditanggapi
                            </span>
                        @else
                            <span class="badge bg-warning">
                                <i class="fas fa-hourglass-half me-1"></i>
                                Belum Ditanggapi
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Action Card -->
            @if(!$saran->tanggapan_admin)
                <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                    <div class="card-header bg-success bg-opacity-10 border-0 p-3">
                        <h6 class="fw-bold mb-0 text-success">
                            <i class="fas fa-cog me-2"></i>
                            Aksi
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-muted small mb-3">Anda masih dapat mengedit atau menghapus saran ini karena belum ada tanggapan dari admin.</p>
                        
                        <div class="d-grid gap-2">
                            <a href="{{ route('warga.saran.edit', $saran->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-2"></i>
                                Edit Saran
                            </a>
                            
                            <form action="{{ route('warga.saran.destroy', $saran->id) }}" 
                                  method="POST"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus saran ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100">
                                    <i class="fas fa-trash me-2"></i>
                                    Hapus Saran
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                    <div class="card-body p-4 text-center">
                        <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                            <i class="fas fa-lock fa-lg text-info"></i>
                        </div>
                        <h6 class="fw-bold mb-2">Saran Terkunci</h6>
                        <p class="text-muted small mb-0">Saran yang sudah ditanggapi tidak dapat diedit atau dihapus.</p>
                    </div>
                </div>
            @endif

            <!-- Help Card -->
            <div class="card border-0 shadow-sm mt-4" style="border-radius: 16px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body p-4 text-white">
                    <h6 class="fw-bold mb-3">
                        <i class="fas fa-question-circle me-2"></i>
                        Butuh Bantuan?
                    </h6>
                    <p class="small mb-0">Jika Anda memiliki pertanyaan atau butuh klarifikasi tentang tanggapan, silakan hubungi admin melalui menu kontak.</p>
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
    border-radius: 16px;
}

.btn {
    border-radius: 8px;
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-1px);
}
</style>
@endsection