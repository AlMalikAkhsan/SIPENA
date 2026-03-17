@extends('layouts.user')

@section('title', 'Laporan Saya - Lapor Aja!')

@push('styles')
<style>
    :root {
        --primary: #4fc3f7;
        --primary-dark: #0288d1;
        --primary-soft: #81d4fa;
        --text-dark: #1e293b;
        --text-muted: #64748b;
        --card-bg: rgba(255, 255, 255, 0.95);
        --shadow-soft: 0 8px 32px rgba(79, 195, 247, 0.12);
        --shadow-hover: 0 12px 40px rgba(79, 195, 247, 0.22);
        --radius-lg: 20px;
        --radius-md: 16px;
    }

    body {
        background: linear-gradient(135deg, #e3f2fd 0%, #f1f8fe 100%);
        min-height: 100vh;
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border-radius: var(--radius-lg);
        padding: 2rem;
        color: white;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-soft);
    }

    .page-header h2 {
        color: white;
        margin-bottom: 0.5rem;
    }

    .search-filter-card {
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(129, 212, 250, 0.2);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-soft);
    }

    .report-card {
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(129, 212, 250, 0.2);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-soft);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .report-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-hover);
        border-color: rgba(129, 212, 250, 0.4);
    }

    .report-image {
        height: 200px;
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
    }

    .report-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .report-card:hover .report-image img {
        transform: scale(1.08);
    }

    .report-placeholder {
        height: 200px;
        background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-size: 3.5rem;
    }

    .status-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        backdrop-filter: blur(8px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        border: 1px solid rgba(255,255,255,0.3);
    }

    .status-menunggu { 
        background: rgba(249, 115, 22, 0.95);
        color: white;
    }
    .status-diproses { 
        background: rgba(59, 130, 246, 0.95);
        color: white;
    }
    .status-selesai { 
        background: rgba(34, 197, 94, 0.95);
        color: white;
    }
    .status-ditolak { 
        background: rgba(239, 68, 68, 0.95);
        color: white;
    }

    .status-dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-right: 6px;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.6; }
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stats-card {
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(129, 212, 250, 0.2);
        border-radius: var(--radius-md);
        padding: 1.5rem;
        text-align: center;
        box-shadow: var(--shadow-soft);
        transition: all 0.3s;
    }

    .stats-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-hover);
    }

    .stats-value {
        font-size: 2.25rem;
        font-weight: 800;
        color: var(--text-dark);
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stats-label {
        font-size: 0.875rem;
        color: var(--text-muted);
        font-weight: 500;
    }

    .card-body-content {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .report-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }

    .report-description {
        color: var(--text-muted);
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 1rem;
        flex: 1;
    }

    .report-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid rgba(129, 212, 250, 0.2);
    }

    .report-date {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-muted);
        font-size: 0.85rem;
    }

    .card-footer-actions {
        background: transparent;
        border-top: 1px solid rgba(129, 212, 250, 0.2);
        padding: 1rem 1.5rem;
    }

    .btn-filter-reset {
        white-space: nowrap;
    }

    .btn-outline-primary:hover {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 6rem 2rem;
        background: var(--card-bg);
        border-radius: var(--radius-lg);
        border: 2px dashed rgba(129, 212, 250, 0.4);
    }

    .empty-icon {
        font-size: 5rem;
        color: #cbd5e1;
        margin-bottom: 1.5rem;
    }

    .pagination {
        margin-top: 2rem;
    }

    .pagination .page-link {
        border-radius: 8px;
        color: var(--primary);
        border: 1px solid rgba(129, 212, 250, 0.3);
        margin: 0 4px;
        padding: 0.5rem 0.75rem;
    }

    .pagination .page-item.active .page-link {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
        box-shadow: 0 4px 12px rgba(79, 195, 247, 0.3);
    }

    .pagination .page-link:hover {
        background: var(--primary-soft);
        border-color: var(--primary-soft);
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(79, 195, 247, 0.25);
    }

    .modal-content {
        border: none;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }

    .badge-status {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    @media (max-width: 768px) {
        .report-image, .report-placeholder { 
            height: 180px; 
        }
        .stats-value { 
            font-size: 1.75rem; 
        }
        .page-header {
            padding: 1.5rem;
        }
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .report-card {
            margin-bottom: 1rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container py-4">

    <!-- Header -->
    <div class="page-header">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h2 class="fw-bold mb-2">📋 Laporan Saya</h2>
                <p class="mb-0 opacity-90">Pantau dan kelola semua laporan yang kamu buat</p>
            </div>
            <a href="{{ route('warga.laporan.create') }}" class="btn btn-light btn-lg shadow-sm">
                <i class="fas fa-plus-circle me-2"></i> Buat Laporan Baru
            </a>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="search-filter-card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <form method="GET" action="{{ route('warga.laporan.index') }}" class="row g-3">
                <div class="col-md-5">
                    <label class="form-label small text-muted fw-semibold mb-2">
                        <i class="fas fa-search me-1"></i> Pencarian
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0" 
                               placeholder="Cari judul atau isi laporan..." 
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label small text-muted fw-semibold mb-2">
                        <i class="fas fa-filter me-1"></i> Status
                    </label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small text-muted fw-semibold mb-2 opacity-0 d-none d-md-block">Action</label>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-fill">
                            <i class="fas fa-filter me-2"></i> Terapkan Filter
                        </button>
                        @if(request('search') || request('status'))
                            <a href="{{ route('warga.laporan.index') }}" class="btn btn-outline-secondary btn-filter-reset" title="Reset Filter">
                                <i class="fas fa-redo"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Stats Summary -->
    <div class="stats-grid">
        <div class="stats-card">
            <div class="stats-value text-primary">{{ $stats['total'] }}</div>
            <div class="stats-label">Total Laporan</div>
        </div>
        <div class="stats-card">
            <div class="stats-value text-warning">{{ $stats['menunggu'] }}</div>
            <div class="stats-label">Menunggu</div>
        </div>
        <div class="stats-card">
            <div class="stats-value text-info">{{ $stats['diproses'] }}</div>
            <div class="stats-label">Diproses</div>
        </div>
        <div class="stats-card">
            <div class="stats-value text-success">{{ $stats['selesai'] }}</div>
            <div class="stats-label">Selesai</div>
        </div>
        <div class="stats-card">
            <div class="stats-value text-danger">{{ $stats['ditolak'] }}</div>
            <div class="stats-label">Ditolak</div>
        </div>
    </div>

    <!-- Laporan List -->
    <div class="row g-4">
        @forelse($laporan as $item)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="report-card">
                    {{-- Foto atau Placeholder --}}
                    @if($item->fotos && $item->fotos->count() > 0)
                        <div class="report-image">
                            <img src="{{ asset('storage/' . $item->fotos->first()->foto_path) }}" 
                                 alt="{{ $item->judul }}"
                                 loading="lazy">
                            <span class="status-badge status-{{ $item->status }}">
                                <span class="status-dot bg-white"></span>
                                {{ ucfirst($item->status) }}
                            </span>
                        </div>
                    @else
                        <div class="report-placeholder">
                            <i class="far fa-image"></i>
                            <span class="status-badge status-{{ $item->status }}">
                                <span class="status-dot bg-white"></span>
                                {{ ucfirst($item->status) }}
                            </span>
                        </div>
                    @endif

                    {{-- Card Body --}}
                    <div class="card-body-content">
                        <h5 class="report-title">{{ Str::limit($item->judul, 50) }}</h5>
                        
                        <p class="report-description">
                            {{ Str::limit($item->isi, 100) }}
                        </p>

                        {{-- Meta Info --}}
                        <div class="report-meta">
                            <div class="report-date">
                                <i class="fas fa-calendar-alt"></i>
                                <span>{{ $item->created_at->format('d M Y') }}</span>
                            </div>
                            <a href="{{ route('warga.laporan.show', $item->id) }}" 
                               class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    @if($item->status == 'menunggu')
                        <div class="card-footer-actions d-flex gap-2">
                            <a href="{{ route('warga.laporan.edit', $item->id) }}" 
                               class="btn btn-sm btn-outline-secondary flex-fill">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-danger flex-fill"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                                <i class="fas fa-trash-alt me-1"></i> Hapus
                            </button>
                        </div>
                    @endif

                    @if($item->status == 'selesai')
                        <div class="card-footer-actions">
                            <form action="{{ route('warga.laporan.archive', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-secondary w-100">
                                    <i class="fas fa-archive me-1"></i> Arsipkan Laporan
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <div class="empty-icon">
                        @if(request('search') || request('status'))
                            <i class="fas fa-search"></i>
                        @else
                            <i class="far fa-folder-open"></i>
                        @endif
                    </div>
                    <h4 class="fw-bold mb-3 text-dark">
                        @if(request('search') || request('status'))
                            Tidak Ada Hasil Pencarian
                        @else
                            Belum Ada Laporan
                        @endif
                    </h4>
                    <p class="text-muted mb-4 lead">
                        @if(request('search') || request('status'))
                            Coba ubah kata kunci atau hapus filter untuk melihat semua laporan.
                        @else
                            Mulai buat laporan pertama kamu untuk membantu meningkatkan lingkungan RW 05!
                        @endif
                    </p>
                    <div class="d-flex gap-2 justify-content-center flex-wrap">
                        <a href="{{ route('warga.laporan.create') }}" class="btn btn-primary btn-lg px-4">
                            <i class="fas fa-plus-circle me-2"></i> Buat Laporan Baru
                        </a>
                        @if(request('search') || request('status'))
                            <a href="{{ route('warga.laporan.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                                <i class="fas fa-redo me-2"></i> Reset Filter
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($laporan->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $laporan->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    @endif

</div>

<!-- Delete Modals -->
@foreach($laporan as $item)
    @if($item->status == 'menunggu')
        <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 border-0 shadow-lg">
                    <div class="modal-header bg-danger text-white border-0 rounded-top-4">
                        <h5 class="modal-title fw-bold">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Konfirmasi Hapus
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-trash-alt text-danger" style="font-size: 4rem; opacity: 0.3;"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Yakin hapus laporan ini?</h5>
                        <div class="alert alert-light border mb-3">
                            <strong class="d-block text-start">{{ Str::limit($item->judul, 80) }}</strong>
                        </div>
                        <p class="small text-danger fw-semibold mb-0">
                            <i class="fas fa-info-circle me-1"></i>
                            Tindakan ini permanen dan tidak bisa dibatalkan
                        </p>
                    </div>
                    <div class="modal-footer border-0 justify-content-center pb-4">
                        <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Batal
                        </button>
                        <form action="{{ route('warga.laporan.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger px-4">
                                <i class="fas fa-trash-alt me-1"></i> Ya, Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
@endsection