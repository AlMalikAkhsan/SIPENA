@extends('layouts.app')

@section('content')
<div class="container py-4">
    
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('laporan.semua') }}" class="btn btn-outline-secondary">
            <svg width="16" height="16" fill="currentColor" class="me-2">
                <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
            </svg>
            Kembali ke Semua Laporan
        </a>
    </div>

    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <!-- Header -->
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h3 class="fw-bold mb-0">{{ $laporan->judul }}</h3>
                        <span class="badge rounded-pill px-3 py-2
                            @if($laporan->status == 'menunggu') bg-warning
                            @elseif($laporan->status == 'diproses') bg-info
                            @else bg-success @endif
                        ">
                            {{ ucfirst($laporan->status) }}
                        </span>
                    </div>

                    <!-- User Info -->
                    <div class="d-flex align-items-center gap-3 py-3 border-bottom">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <svg width="24" height="24" fill="currentColor" class="text-primary">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="fw-semibold">{{ $laporan->user->name ?? 'Anonim' }}</div>
                            <div class="text-muted small">
                                <svg width="14" height="14" fill="currentColor" class="me-1">
                                    <path d="M9 11H7v2h2v-2zm4-8h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/>
                                </svg>
                                {{ $laporan->created_at->format('d F Y, H:i') }}
                                <span class="text-muted mx-2">•</span>
                                {{ $laporan->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image (if exists) -->
                @if($laporan->foto)
                    <div class="position-relative overflow-hidden">
                        <img src="{{ Storage::url($laporan->foto) }}" 
                             class="w-100" 
                             style="max-height: 500px; object-fit: cover;"
                             alt="{{ $laporan->judul }}">
                    </div>
                @endif

                <!-- Content -->
                <div class="card-body p-4">
                    <h5 class="fw-semibold mb-3">Isi Laporan</h5>
                    <div class="text-muted lh-lg" style="text-align: justify; white-space: pre-line;">{{ $laporan->isi }}</div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Info Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary bg-opacity-10 border-0 p-3">
                    <h6 class="fw-bold mb-0 text-primary">
                        <svg width="18" height="18" fill="currentColor" class="me-2">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                        Informasi Laporan
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-muted d-block mb-1">ID Laporan</small>
                        <span class="fw-semibold">#{{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>

                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-muted d-block mb-1">Status</small>
                        <span class="badge 
                            @if($laporan->status == 'menunggu') bg-warning
                            @elseif($laporan->status == 'diproses') bg-info
                            @else bg-success @endif
                        ">
                            {{ ucfirst($laporan->status) }}
                        </span>
                    </div>

                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-muted d-block mb-1">Dilaporkan Oleh</small>
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                                <svg width="16" height="16" fill="currentColor" class="text-primary">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>
                            <span class="fw-semibold">{{ $laporan->user->name ?? 'Anonim' }}</span>
                        </div>
                    </div>

                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-muted d-block mb-1">Tanggal Dibuat</small>
                        <span class="fw-semibold">{{ $laporan->created_at->format('d F Y') }}</span>
                        <div class="text-muted small mt-1">{{ $laporan->created_at->format('H:i') }} WIB</div>
                    </div>

                    <div>
                        <small class="text-muted d-block mb-1">Terakhir Diupdate</small>
                        <span class="fw-semibold">{{ $laporan->updated_at->format('d F Y') }}</span>
                        <div class="text-muted small mt-1">{{ $laporan->updated_at->diffForHumans() }}</div>
                    </div>
                </div>
            </div>

            <!-- Action Card (if owner) -->
            @if(Auth::id() == $laporan->user_id)
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-success bg-opacity-10 border-0 p-3">
                        <h6 class="fw-bold mb-0 text-success">
                            <svg width="18" height="18" fill="currentColor" class="me-2">
                                <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                            </svg>
                            Laporan Anda
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-muted small mb-3">Ini adalah laporan yang Anda buat. Anda dapat mengelolanya.</p>
                        <div class="d-grid gap-2">
                            <a href="{{ route('warga.laporan.show', $laporan->id) }}" class="btn btn-primary">
                                <svg width="16" height="16" fill="currentColor" class="me-2">
                                    <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                </svg>
                                Lihat Detail Lengkap
                            </a>
                            @if($laporan->status == 'menunggu')
                                <a href="{{ route('warga.laporan.edit', $laporan->id) }}" class="btn btn-outline-secondary">
                                    <svg width="16" height="16" fill="currentColor" class="me-2">
                                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                    </svg>
                                    Edit Laporan
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Share Card -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body p-4">
                    <h6 class="fw-semibold mb-3">Bagikan Laporan</h6>
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary btn-sm" onclick="copyLink()">
                            <svg width="16" height="16" fill="currentColor" class="me-2">
                                <path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z"/>
                            </svg>
                            Salin Link
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
.card {
    border-radius: 12px;
    overflow: hidden;
}

.btn {
    border-radius: 8px;
    transition: all 0.2s ease;
}

.badge {
    font-weight: 500;
    font-size: 0.875rem;
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

.btn-outline-primary:hover,
.btn-outline-secondary:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
</style>

<script>
function copyLink() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(() => {
        alert('Link berhasil disalin!');
    }).catch(() => {
        alert('Gagal menyalin link');
    });
}
</script>
@endsection