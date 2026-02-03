@extends('layouts.app')

@section('content')
<div class="container py-4">
    
    <!-- Header -->
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <div>
                <h2 class="fw-bold mb-1">Semua Laporan Warga</h2>
                <p class="text-muted mb-0">Lihat dan pantau laporan dari seluruh warga</p>
            </div>
            <a href="{{ route('warga.laporan.index') }}" class="btn btn-outline-primary px-4">
                <svg width="18" height="18" fill="currentColor" class="me-2" style="vertical-align: text-bottom;">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                </svg>
                Laporan Saya
            </a>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('warga.laporan.semua') }}">
                <div class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label small fw-semibold text-muted">Cari Laporan</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <svg width="16" height="16" fill="currentColor">
                                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                                </svg>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0" 
                                   placeholder="Cari berdasarkan judul atau isi laporan..." 
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-muted">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small fw-semibold text-muted">Urutkan</label>
                        <select name="sort" class="form-select">
                            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                            <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                        </select>
                    </div>
                    
                    <div class="col-md-2 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary flex-fill">
                            <svg width="16" height="16" fill="currentColor" class="me-1">
                                <path d="M10 18h4v-2h-4v2zM3 6v2h18V6H3zm3 7h12v-2H6v2z"/>
                            </svg>
                            Filter
                        </button>
                        @if(request('search') || request('status') || request('sort'))
                        <a href="{{ route('warga.laporan.semua') }}" class="btn btn-outline-secondary" title="Reset Filter">
                            <svg width="16" height="16" fill="currentColor">
                                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                            </svg>
                        </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Stats Summary -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 bg-primary bg-opacity-10 h-100">
                <div class="card-body text-center py-3">
                    <h4 class="fw-bold text-primary mb-0">{{ $total }}</h4>
                    <small class="text-muted">Total Laporan</small>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 bg-warning bg-opacity-10 h-100">
                <div class="card-body text-center py-3">
                    <h4 class="fw-bold text-warning mb-0">{{ $menunggu }}</h4>
                    <small class="text-muted">Menunggu</small>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 bg-info bg-opacity-10 h-100">
                <div class="card-body text-center py-3">
                    <h4 class="fw-bold text-info mb-0">{{ $diproses }}</h4>
                    <small class="text-muted">Diproses</small>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 bg-success bg-opacity-10 h-100">
                <div class="card-body text-center py-3">
                    <h4 class="fw-bold text-success mb-0">{{ $selesai }}</h4>
                    <small class="text-muted">Selesai</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Laporan Cards -->
    <div class="row g-3 g-lg-4">
        @forelse($laporan as $item)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    
                    <!-- Image -->
                    @if($item->foto)
                        <div class="position-relative overflow-hidden" style="height: 200px;">
                            <img src="{{ Storage::url($item->foto) }}" 
                                 class="w-100 h-100" 
                                 style="object-fit: cover;"
                                 alt="{{ $item->judul }}">
                            
                            <!-- Status Badge Overlay -->
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge rounded-pill px-3 py-2 shadow-sm
                                    @if($item->status == 'menunggu') bg-warning
                                    @elseif($item->status == 'diproses') bg-info
                                    @else bg-success @endif
                                ">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>
                        </div>
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <svg width="64" height="64" fill="currentColor" class="text-muted">
                                <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                            </svg>
                        </div>
                    @endif

                    <!-- Card Body -->
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="fw-bold mb-0 flex-grow-1">{{ Str::limit($item->judul, 40) }}</h6>
                            @if(!$item->foto)
                                <span class="badge rounded-pill px-3 py-2 ms-2
                                    @if($item->status == 'menunggu') bg-warning bg-opacity-10 text-warning
                                    @elseif($item->status == 'diproses') bg-info bg-opacity-10 text-info
                                    @else bg-success bg-opacity-10 text-success @endif
                                ">
                                    <span class="status-dot me-2
                                        @if($item->status == 'menunggu') bg-warning
                                        @elseif($item->status == 'diproses') bg-info
                                        @else bg-success @endif
                                    "></span>
                                    {{ ucfirst($item->status) }}
                                </span>
                            @endif
                        </div>
                        
                        <p class="text-muted small mb-3">
                            {{ Str::limit($item->isi, 90) }}
                        </p>

                        <!-- User Info -->
                        <div class="d-flex align-items-center gap-2 mb-3 pb-3 border-bottom">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                                <svg width="16" height="16" fill="currentColor" class="text-primary">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>
                            <div class="flex-grow-1">
                                <div class="small fw-semibold">{{ $item->user->name ?? 'Anonim' }}</div>
                                <div class="text-muted" style="font-size: 0.75rem;">
                                    {{ $item->created_at->format('d M Y, H:i') }}
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2 text-muted small">
                                <svg width="14" height="14" fill="currentColor">
                                    <path d="M9 11H7v2h2v-2zm4-8h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/>
                                </svg>
                                <span>{{ $item->created_at->diffForHumans() }}</span>
                            </div>
                            
                            <a href="{{ route('warga.laporan.show', $item->id) }}" 
                               class="btn btn-sm btn-outline-primary">
                                Detail
                                <svg width="14" height="14" fill="currentColor" class="ms-1">
                                    <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card border-0 bg-light">
                    <div class="card-body text-center py-5">
                        <svg width="64" height="64" fill="currentColor" class="text-muted mb-3">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z"/>
                        </svg>
                        <h5 class="fw-semibold mb-2">
                            @if(request('search') || request('status'))
                                Tidak Ada Hasil
                            @else
                                Belum Ada Laporan
                            @endif
                        </h5>
                        <p class="text-muted mb-4">
                            @if(request('search') || request('status'))
                                Tidak ada laporan yang sesuai dengan pencarian Anda. Coba gunakan kata kunci lain.
                            @else
                                Belum ada laporan dari warga. Jadilah yang pertama membuat laporan!
                            @endif
                        </p>
                        @if(request('search') || request('status'))
                            <a href="{{ route('warga.laporan.semua') }}" class="btn btn-outline-primary me-2">
                                <svg width="16" height="16" fill="currentColor" class="me-1">
                                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                                </svg>
                                Reset Filter
                            </a>
                        @endif
                        <a href="{{ route('warga.laporan.create') }}" class="btn btn-primary">
                            <svg width="18" height="18" fill="currentColor" class="me-2" style="vertical-align: text-bottom;">
                                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                            </svg>
                            Buat Laporan Baru
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($laporan->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $laporan->appends(request()->query())->links() }}
        </div>
    @endif

</div>

<style>
.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-4px);
    box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1) !important;
}

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
    font-size: 0.75rem;
}

.status-dot {
    display: inline-block;
    width: 6px;
    height: 6px;
    border-radius: 50%;
}

.form-select, .form-control {
    border-radius: 8px;
    border-color: #dee2e6;
}

.input-group-text {
    border-radius: 8px 0 0 8px;
}

.form-control:focus, .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
}

.btn-outline-primary:hover,
.btn-outline-secondary:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

/* Pagination Style */
.pagination {
    gap: 0.25rem;
}

.page-link {
    border-radius: 8px;
    border: 1px solid #dee2e6;
    color: #0d6efd;
    margin: 0 2px;
}

.page-link:hover {
    background-color: #e7f1ff;
    border-color: #0d6efd;
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    border-color: #0d6efd;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .hover-lift:hover {
        transform: none;
    }
    
    .btn {
        font-size: 0.875rem;
    }
}
</style>
@endsection