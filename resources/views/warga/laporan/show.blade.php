@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    
    <!-- Page Header -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center">
            <a href="{{ route('warga.laporan.index') }}" class="btn btn-light me-3" style="border-radius: 12px;">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="fw-bold mb-1" style="color: var(--secondary-color);">Detail Laporan</h2>
                <p class="text-muted mb-0">ID: #{{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="d-flex gap-2">
            <a href="{{ route('warga.laporan.edit', $laporan->id) }}" 
               class="btn btn-primary"
               style="border-radius: 12px;">
                <i class="fas fa-edit me-2"></i>
                Edit
            </a>
            
            <form action="{{ route('warga.laporan.destroy', $laporan->id) }}" 
                  method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus laporan ini?')"
                  class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" style="border-radius: 12px;">
                    <i class="fas fa-trash me-2"></i>
                    Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Main Content Card -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden;">
                
                <!-- Image Header -->
                @if($laporan->foto && file_exists(public_path('uploads/' . $laporan->foto)))
                <div class="position-relative">
                    <img src="{{ asset('uploads/' . $laporan->foto) }}" 
                         alt="Foto Laporan" 
                         class="w-100"
                         style="max-height: 450px; object-fit: cover;">
                    
                    <!-- Status Badge Overlay -->
                    <div class="position-absolute top-0 end-0 p-3">
                        <span class="badge rounded-pill px-4 py-2 fs-6
                            @if($laporan->status == 'menunggu') bg-warning
                            @elseif($laporan->status == 'diproses') bg-info
                            @else bg-success
                            @endif
                        " style="backdrop-filter: blur(10px);">
                            {{ ucfirst($laporan->status) }}
                        </span>
                    </div>
                </div>
                @endif

                <div class="card-body p-4">
                    
                    <!-- Status Badge (jika tidak ada foto) -->
                    @if(!$laporan->foto || !file_exists(public_path('uploads/' . $laporan->foto)))
                    <div class="mb-3">
                        <span class="badge rounded-pill px-4 py-2
                            @if($laporan->status == 'menunggu') bg-warning bg-opacity-10 text-warning
                            @elseif($laporan->status == 'diproses') bg-info bg-opacity-10 text-info
                            @else bg-success bg-opacity-10 text-success
                            @endif
                        " style="font-size: 0.95rem;">
                            {{ ucfirst($laporan->status) }}
                        </span>
                    </div>
                    @endif

                    <!-- Title -->
                    <h3 class="fw-bold mb-3" style="color: var(--secondary-color);">
                        {{ $laporan->judul }}
                    </h3>

                    <!-- Meta Info -->
                    <div class="d-flex flex-wrap gap-4 mb-4 pb-3 border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-calendar text-muted"></i>
                            <div>
                                <small class="text-muted d-block">Tanggal Laporan</small>
                                <span class="fw-semibold">{{ $laporan->created_at->format('d M Y, H:i') }}</span>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-user text-muted"></i>
                            <div>
                                <small class="text-muted d-block">Pelapor</small>
                                <span class="fw-semibold">{{ $laporan->user->name ?? 'Anonim' }}</span>
                            </div>
                        </div>

                        @if($laporan->lokasi)
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-map-marker-alt text-muted"></i>
                            <div>
                                <small class="text-muted d-block">Lokasi</small>
                                <span class="fw-semibold">{{ $laporan->lokasi }}</span>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3">
                            <i class="fas fa-align-left text-primary me-2"></i>
                            Detail Laporan
                        </h5>
                        <p style="white-space: pre-line; line-height: 1.8; color: #4B5563;">
                            {{ $laporan->isi }}
                        </p>
                    </div>

                    <!-- Tanggapan Admin -->
                    @if($laporan->tanggapan)
                    <div class="alert alert-info border-0" style="border-radius: 12px; background: linear-gradient(135deg, rgba(17, 138, 178, 0.1) 0%, rgba(17, 138, 178, 0.05) 100%);">
                        <h6 class="fw-bold mb-2">
                            <i class="fas fa-comment-dots me-2"></i>
                            Tanggapan Admin
                        </h6>
                        <p class="mb-0" style="white-space: pre-line;">{{ $laporan->tanggapan }}</p>
                        @if($laporan->tanggapan_at)
                        <small class="text-muted d-block mt-2">
                            <i class="fas fa-clock me-1"></i>
                            {{ $laporan->tanggapan_at->format('d M Y, H:i') }}
                        </small>
                        @endif
                    </div>
                    @endif

                    <!-- Timeline -->
                    <div class="mt-4 pt-3 border-top">
                        <h6 class="fw-bold mb-3">
                            <i class="fas fa-history text-primary me-2"></i>
                            Riwayat Aktivitas
                        </h6>
                        
                        <div class="timeline">
                            <div class="timeline-item mb-3">
                                <div class="d-flex gap-3">
                                    <div class="timeline-icon bg-success bg-opacity-10 text-success">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">Laporan Dibuat</div>
                                        <small class="text-muted">{{ $laporan->created_at->format('d M Y, H:i') }}</small>
                                    </div>
                                </div>
                            </div>

                            @if($laporan->updated_at != $laporan->created_at)
                            <div class="timeline-item mb-3">
                                <div class="d-flex gap-3">
                                    <div class="timeline-icon bg-info bg-opacity-10 text-info">
                                        <i class="fas fa-edit"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">Laporan Diperbarui</div>
                                        <small class="text-muted">{{ $laporan->updated_at->format('d M Y, H:i') }}</small>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($laporan->status == 'selesai')
                            <div class="timeline-item">
                                <div class="d-flex gap-3">
                                    <div class="timeline-icon bg-success bg-opacity-10 text-success">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">Laporan Selesai</div>
                                        <small class="text-muted">Ditangani oleh Admin</small>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Status Card -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        Status Laporan
                    </h6>
                    
                    <div class="text-center py-3 mb-3" style="background: var(--light-bg); border-radius: 12px;">
                        <div class="mb-2">
                            @if($laporan->status == 'menunggu')
                                <i class="fas fa-clock fa-3x text-warning"></i>
                            @elseif($laporan->status == 'diproses')
                                <i class="fas fa-spinner fa-3x text-info"></i>
                            @else
                                <i class="fas fa-check-circle fa-3x text-success"></i>
                            @endif
                        </div>
                        <h5 class="fw-bold mb-1">{{ ucfirst($laporan->status) }}</h5>
                        <small class="text-muted">
                            @if($laporan->status == 'menunggu')
                                Menunggu verifikasi admin
                            @elseif($laporan->status == 'diproses')
                                Sedang dalam penanganan
                            @else
                                Laporan telah selesai ditangani
                            @endif
                        </small>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="{{ route('warga.laporan.edit', $laporan->id) }}" 
                           class="btn btn-outline-primary"
                           style="border-radius: 12px;">
                            <i class="fas fa-edit me-2"></i>
                            Edit Laporan
                        </a>
                        
                        <button type="button" 
                                class="btn btn-outline-danger"
                                style="border-radius: 12px;"
                                onclick="confirmDelete()">
                            <i class="fas fa-trash me-2"></i>
                            Hapus Laporan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Share Card -->
            <div class="card border-0 shadow-sm" style="border-radius: 16px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body p-4 text-white">
                    <h6 class="fw-bold mb-3">
                        <i class="fas fa-share-alt me-2"></i>
                        Bagikan Laporan
                    </h6>
                    <p class="small mb-3 opacity-75">Bantu sebarkan laporan ini agar mendapat perhatian lebih</p>
                    <div class="d-grid gap-2">
                        <button class="btn btn-light btn-sm" style="border-radius: 8px;">
                            <i class="fab fa-whatsapp me-2"></i>
                            WhatsApp
                        </button>
                        <button class="btn btn-light btn-sm" style="border-radius: 8px;">
                            <i class="fab fa-twitter me-2"></i>
                            Twitter
                        </button>
                        <button class="btn btn-light btn-sm" style="border-radius: 8px;">
                            <i class="fas fa-link me-2"></i>
                            Salin Link
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.timeline-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.card {
    transition: all 0.3s ease;
}
</style>

<script>
function confirmDelete() {
    if (confirm('Yakin ingin menghapus laporan ini? Tindakan ini tidak dapat dibatalkan.')) {
        document.querySelector('form[action*="destroy"]').submit();
    }
}
</script>
@endsection