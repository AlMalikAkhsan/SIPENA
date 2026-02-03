@extends('layouts.app')

@section('content')
<div class="laporan-container">
    
    <!-- Hero Header -->
    <div class="hero-section mb-4">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h1 class="page-title mb-2">Data Laporan Warga</h1>
                <p class="page-subtitle mb-0">Kelola dan verifikasi semua laporan dari warga</p>
            </div>
            <div class="d-none d-md-block">
                <a href="{{ route('admin.laporan.export.pdf', request()->query()) }}" class="btn-export">
                    <svg width="18" height="18" fill="currentColor">
                        <path d="M19 12v7H5v-7H3v7c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-7h-2zm-6 .67l2.59-2.58L17 11.5l-5 5-5-5 1.41-1.41L11 12.67V3h2z"/>
                    </svg>
                    Export PDF
                </a>
            </div>
        </div>
    </div>

    <!-- Search & Filter Card -->
    <div class="filter-card mb-4">
        <form method="GET" action="{{ route('admin.laporan.index') }}">
            <div class="row g-3">
                <!-- Search Input -->
                <div class="col-12 col-md-5">
                    <label class="filter-label">🔍 Cari Laporan</label>
                    <div class="search-input-group">
                        <svg width="18" height="18" fill="currentColor" class="search-icon">
                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                        </svg>
                        <input type="text" 
                               name="search" 
                               class="search-input" 
                               placeholder="Cari berdasarkan judul, isi, atau nama warga..." 
                               value="{{ request('search') }}">
                    </div>
                </div>
                
                <!-- Status Filter -->
                <div class="col-6 col-md-3">
                    <label class="filter-label">📊 Status</label>
                    <select name="status" class="filter-select">
                        <option value="">Semua Status</option>
                        <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>⏱️ Menunggu</option>
                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>⚙️ Diproses</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                    </select>
                </div>

                <!-- Sort Filter -->
                <div class="col-6 col-md-2">
                    <label class="filter-label">🔄 Urutkan</label>
                    <select name="sort" class="filter-select">
                        <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </div>
                
                <!-- Action Buttons -->
                <div class="col-12 col-md-2">
                    <label class="filter-label d-none d-md-block">&nbsp;</label>
                    <div class="filter-actions">
                        <button type="submit" class="btn-filter">
                            <svg width="16" height="16" fill="currentColor">
                                <path d="M10 18h4v-2h-4v2zM3 6v2h18V6H3zm3 7h12v-2H6v2z"/>
                            </svg>
                            Terapkan
                        </button>
                        @if(request('search') || request('status') || request('sort'))
                        <a href="{{ route('admin.laporan.index') }}" class="btn-reset" title="Reset Filter">
                            <svg width="18" height="18" fill="currentColor">
                                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                            </svg>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid mb-4">
        <div class="stat-mini stat-mini-primary">
            <div class="stat-mini-icon">
                <svg width="24" height="24" fill="currentColor">
                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z"/>
                </svg>
            </div>
            <div class="stat-mini-content">
                <div class="stat-mini-value">{{ $laporan->total() }}</div>
                <div class="stat-mini-label">Total Laporan</div>
            </div>
        </div>

        <div class="stat-mini stat-mini-warning">
            <div class="stat-mini-icon">
                <svg width="24" height="24" fill="currentColor">
                    <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                </svg>
            </div>
            <div class="stat-mini-content">
                <div class="stat-mini-value">{{ \App\Models\Laporan::where('status', 'menunggu')->count() }}</div>
                <div class="stat-mini-label">Menunggu</div>
            </div>
        </div>

        <div class="stat-mini stat-mini-info">
            <div class="stat-mini-icon">
                <svg width="24" height="24" fill="currentColor">
                    <path d="M19.43 12.98c.04-.32.07-.64.07-.98s-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.3-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.23-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98s.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.23.09.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zM12 15.5c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5z"/>
                </svg>
            </div>
            <div class="stat-mini-content">
                <div class="stat-mini-value">{{ \App\Models\Laporan::where('status', 'diproses')->count() }}</div>
                <div class="stat-mini-label">Diproses</div>
            </div>
        </div>

        <div class="stat-mini stat-mini-success">
            <div class="stat-mini-icon">
                <svg width="24" height="24" fill="currentColor">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
            </div>
            <div class="stat-mini-content">
                <div class="stat-mini-value">{{ \App\Models\Laporan::where('status', 'selesai')->count() }}</div>
                <div class="stat-mini-label">Selesai</div>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="data-card">
        <!-- Card Header -->
        <div class="data-card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="data-card-title">
                    <svg width="22" height="22" fill="currentColor" class="me-2">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z"/>
                    </svg>
                    Daftar Laporan
                </h5>
                <span class="total-badge">
                    {{ $laporan->total() }} Laporan
                </span>
            </div>
        </div>
        
        <!-- Card Body -->
        <div class="data-card-body">
            @forelse($laporan as $item)
                <div class="laporan-item">
                    <!-- Number Badge -->
                    <div class="laporan-number">
                        {{ $laporan->firstItem() + $loop->index }}
                    </div>

                    <!-- Image -->
                    <div class="laporan-image">
                        @if($item->foto)
                            <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->judul }}">
                        @else
                            <div class="laporan-image-placeholder">
                                <svg width="28" height="28" fill="currentColor">
                                    <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="laporan-content">
                        <div class="laporan-header">
                            <h6 class="laporan-title">{{ Str::limit($item->judul, 60) }}</h6>
                            <span class="laporan-status status-{{ $item->status }}">
                                <span class="status-dot"></span>
                                {{ ucfirst($item->status) }}
                            </span>
                        </div>
                        <p class="laporan-description">{{ Str::limit($item->isi, 100) }}</p>
                        
                        <!-- Meta Info -->
                        <div class="laporan-meta">
                            <div class="meta-item">
                                <svg width="16" height="16" fill="currentColor">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                                <span>{{ $item->user->name ?? 'Anonim' }}</span>
                            </div>
                            <div class="meta-item">
                                <svg width="16" height="16" fill="currentColor">
                                    <path d="M9 11H7v2h2v-2zm4-8h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/>
                                </svg>
                                <span>{{ $item->created_at->format('d M Y, H:i') }} WIB</span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="laporan-actions">
                        <a href="{{ route('admin.laporan.show', $item->id) }}" class="btn-action btn-action-primary">
                            <svg width="16" height="16" fill="currentColor">
                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                            </svg>
                            Detail
                        </a>
                        
                        @if($item->status == 'menunggu')
                        <button type="button" 
                                class="btn-action btn-action-success"
                                data-bs-toggle="modal" 
                                data-bs-target="#updateStatusModal{{ $item->id }}">
                            <svg width="16" height="16" fill="currentColor">
                                <path d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.11 0 2-.9 2-2V7l-4-4zm-5 16c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-10H5V5h10v4z"/>
                            </svg>
                            Proses
                        </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <svg width="80" height="80" fill="currentColor" class="empty-icon">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z"/>
                    </svg>
                    <h5 class="empty-title">
                        @if(request('search') || request('status'))
                            Tidak Ada Hasil Ditemukan
                        @else
                            Belum Ada Laporan
                        @endif
                    </h5>
                    <p class="empty-text">
                        @if(request('search') || request('status'))
                            Tidak ada laporan yang sesuai dengan filter Anda. Coba ubah kriteria pencarian.
                        @else
                            Belum ada laporan yang masuk dari warga. Laporan akan muncul di sini.
                        @endif
                    </p>
                    @if(request('search') || request('status'))
                    <a href="{{ route('admin.laporan.index') }}" class="btn-reset-filter">
                        <svg width="18" height="18" fill="currentColor" class="me-2">
                            <path d="M12 5V1L7 6l5 5V7c3.31 0 6 2.69 6 6s-2.69 6-6 6-6-2.69-6-6H4c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8z"/>
                        </svg>
                        Reset Filter
                    </a>
                    @endif
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($laporan->hasPages())
            <div class="data-card-footer">
                <div class="pagination-info">
                    Menampilkan {{ $laporan->firstItem() }} - {{ $laporan->lastItem() }} dari {{ $laporan->total() }} laporan
                </div>
                <div class="pagination-links">
                    {{ $laporan->appends(request()->query())->links() }}
                </div>
            </div>
        @endif
    </div>

</div>

<!-- Modal Update Status -->
@foreach($laporan as $item)
    @if($item->status == 'menunggu')
        <div class="modal fade" id="updateStatusModal{{ $item->id }}" tabindex="-1" aria-labelledby="updateStatusModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-modern">
                    <!-- Header -->
                    <div class="modal-header-modern">
                        <div class="modal-icon-wrapper">
                            <svg width="32" height="32" fill="currentColor">
                                <path d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.11 0 2-.9 2-2V7l-4-4zm-5 16c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-10H5V5h10v4z"/>
                            </svg>
                        </div>
                        <div class="modal-title-wrapper">
                            <h5 class="modal-title-modern" id="updateStatusModalLabel{{ $item->id }}">Update Status Laporan</h5>
                            <p class="modal-subtitle">Ubah status laporan menjadi diproses atau selesai</p>
                        </div>
                        <button type="button" class="btn-close-modern" data-bs-dismiss="modal" aria-label="Close">
                            <svg width="24" height="24" fill="currentColor">
                                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Body -->
                    <div class="modal-body-modern">
                        <!-- Laporan Info -->
                        <div class="info-box">
                            <div class="info-row">
                                <span class="info-label">Judul Laporan</span>
                                <span class="info-value">{{ $item->judul }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Pelapor</span>
                                <span class="info-value">{{ $item->user->name ?? 'Anonim' }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Tanggal Laporan</span>
                                <span class="info-value">{{ $item->created_at->format('d M Y, H:i') }} WIB</span>
                            </div>
                        </div>

                        <form action="{{ route('admin.laporan.status', $item->id) }}" method="POST">
                            @csrf
                            <div class="form-group-modern">
                                <label class="form-label-modern">Pilih Status Baru</label>
                                <select name="status" class="form-select-modern" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="diproses">⚙️ Diproses</option>
                                    <option value="selesai">✅ Selesai</option>
                                </select>
                            </div>

                            <div class="alert-info-box">
                                <svg width="20" height="20" fill="currentColor" class="alert-icon">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                                </svg>
                                <div class="alert-text">
                                    <strong>Informasi:</strong> Warga akan menerima notifikasi tentang perubahan status laporan ini.
                                </div>
                            </div>

                            <div class="modal-actions">
                                <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">
                                    Batal
                                </button>
                                <button type="submit" class="btn-modal-submit">
                                    <svg width="18" height="18" fill="currentColor" class="me-2">
                                        <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/>
                                    </svg>
                                    Update Status
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach

<style>
/* Container */
.laporan-container {
    padding: 1.5rem;
    background: #f5f7fa;
    min-height: 100vh;
}

/* Hero Section */
.hero-section {
    padding: 2rem;
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    border-radius: 16px;
    color: white;
    box-shadow: 0 4px 20px rgba(13, 110, 253, 0.15);
}

.page-title {
    font-size: 1.75rem;
    font-weight: 700;
    margin: 0;
}

.page-subtitle {
    font-size: 0.95rem;
    opacity: 0.95;
}

.btn-export {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    color: white;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9rem;
    transition: all 0.2s ease;
}

.btn-export:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
    color: white;
}

/* Filter Card */
.filter-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
}

.filter-label {
    display: block;
    font-size: 0.85rem;
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
}

/* Search Input */
.search-input-group {
    position: relative;
}

.search-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
    pointer-events: none;
}

.search-input {
    width: 100%;
    padding: 0.75rem 1rem 0.75rem 3rem;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    font-size: 0.9rem;
    transition: all 0.2s ease;
}

.search-input:focus {
    outline: none;
    border-color: #0d6efd;
    box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
}

.search-input::placeholder {
    color: #adb5bd;
}

/* Filter Select */
.filter-select {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    font-size: 0.9rem;
    background: white;
    cursor: pointer;
    transition: all 0.2s ease;
}

.filter-select:focus {
    outline: none;
    border-color: #0d6efd;
    box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
}

/* Filter Actions */
.filter-actions {
    display: flex;
    gap: 0.5rem;
}

.btn-filter {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    color: white;
    border: none;
    border-radius: 10px;
    font-weight: 500;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-filter:hover {
    background: linear-gradient(135deg, #0a58ca 0%, #084298 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
}

.btn-reset {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    color: #6c757d;
    text-decoration: none;
    transition: all 0.2s ease;
}

.btn-reset:hover {
    background: #e9ecef;
    border-color: #dc3545;
    color: #dc3545;
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.stat-mini {
    background: white;
    border-radius: 12px;
    padding: 1.25rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-mini::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: currentColor;
}

.stat-mini:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
}

.stat-mini-primary { color: #0d6efd; }
.stat-mini-warning { color: #ffc107; }
.stat-mini-info { color: #0dcaf0; }
.stat-mini-success { color: #198754; }

.stat-mini-icon {
    width: 52px;
    height: 52px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: currentColor;
    color: white;
    flex-shrink: 0;
}

.stat-mini-content {
    flex: 1;
}

.stat-mini-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a1a1a;
    line-height: 1;
}

.stat-mini-label {
    font-size: 0.8rem;
    color: #6c757d;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-top: 0.25rem;
}

/* Data Card */
.data-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    overflow: hidden;
}

.data-card-header {
    padding: 1.5rem;
    border-bottom: 1px solid #f1f3f5;
}

.data-card-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0;
    display: flex;
    align-items: center;
}

.total-badge {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

.data-card-body {
    padding: 0;
}

/* Laporan Item */
.laporan-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid #f1f3f5;
    transition: all 0.2s ease;
}

.laporan-item:last-child {
    border-bottom: none;
}

.laporan-item:hover {
    background: #f8f9fa;
}

.laporan-number {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    color: #495057;
    font-size: 0.9rem;
    flex-shrink: 0;
}

.laporan-image {
    width: 80px;
    height: 80px;
    border-radius: 12px;
    overflow: hidden;
    flex-shrink: 0;
}

.laporan-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.laporan-image-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
}

.laporan-content {
    flex: 1;
    min-width: 0;
}

.laporan-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    gap: 1rem;
    margin-bottom: 0.5rem;
}

.laporan-title {
    font-size: 1rem;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0;
    line-height: 1.4;
}

.laporan-status {
    padding: 0.375rem 0.875rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    white-space: nowrap;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    gap: 0.375rem;
}

.status-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: currentColor;
}

.status-menunggu {
    background: #fff3cd;
    color: #997404;
}

.status-diproses {
    background: #cff4fc;
    color: #055160;
}

.status-selesai {
    background: #d1e7dd;
    color: #0a3622;
}

.laporan-description {
    font-size: 0.875rem;
    color: #6c757d;
    margin-bottom: 0.75rem;
    line-height: 1.5;
}

.laporan-meta {
    display: flex;
    gap: 1.25rem;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    font-size: 0.8rem;
    color: #868e96;
}

.meta-item svg {
    flex-shrink: 0;
}

.laporan-actions {
    display: flex;
    gap: 0.5rem;
    flex-shrink: 0;
}

.btn-action {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.625rem 1rem;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 500;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-action-primary {
    background: #0d6efd;
    color: white;
}

.btn-action-primary:hover {
    background: #0a58ca;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    color: white;
}

.btn-action-success {
    background: #198754;
    color: white;
}

.btn-action-success:hover {
    background: #146c43;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(25, 135, 84, 0.3);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
}

.empty-icon {
    color: #dee2e6;
    margin-bottom: 1.5rem;
}

.empty-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
}

.empty-text {
    font-size: 0.95rem;
    color: #6c757d;
    margin-bottom: 1.5rem;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

.btn-reset-filter {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: #0d6efd;
    color: white;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-reset-filter:hover {
    background: #0a58ca;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    color: white;
}

/* Pagination */
.data-card-footer {
    padding: 1.25rem 1.5rem;
    border-top: 1px solid #f1f3f5;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.pagination-info {
    font-size: 0.875rem;
    color: #6c757d;
}

.pagination-links {
    display: flex;
}

/* Modal Modern */
.modal-modern {
    border: none;
    border-radius: 16px;
    overflow: hidden;
}

.modal-header-modern {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    color: white;
    padding: 2rem;
    display: flex;
    align-items: start;
    gap: 1rem;
    position: relative;
}

.modal-icon-wrapper {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.modal-title-wrapper {
    flex: 1;
}

.modal-title-modern {
    font-size: 1.25rem;
    font-weight: 700;
    margin: 0;
}

.modal-subtitle {
    font-size: 0.875rem;
    opacity: 0.9;
    margin: 0.25rem 0 0 0;
}

.btn-close-modern {
    width: 36px;
    height: 36px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border: none;
    border-radius: 8px;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    flex-shrink: 0;
}

.btn-close-modern:hover {
    background: rgba(255, 255, 255, 0.3);
}

.modal-body-modern {
    padding: 2rem;
}

/* Info Box */
.info-box {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 1.25rem;
    margin-bottom: 1.5rem;
}

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: start;
    gap: 1rem;
    padding: 0.5rem 0;
}

.info-row:not(:last-child) {
    border-bottom: 1px solid #e9ecef;
}

.info-label {
    font-size: 0.875rem;
    color: #6c757d;
    font-weight: 500;
}

.info-value {
    font-size: 0.875rem;
    color: #1a1a1a;
    font-weight: 600;
    text-align: right;
}

/* Form Modern */
.form-group-modern {
    margin-bottom: 1.5rem;
}

.form-label-modern {
    display: block;
    font-size: 0.9rem;
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
}

.form-select-modern {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    font-size: 0.9rem;
    background: white;
    cursor: pointer;
    transition: all 0.2s ease;
}

.form-select-modern:focus {
    outline: none;
    border-color: #0d6efd;
    box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
}

/* Alert Info Box */
.alert-info-box {
    display: flex;
    gap: 0.75rem;
    padding: 1rem;
    background: rgba(13, 202, 240, 0.1);
    border-left: 4px solid #0dcaf0;
    border-radius: 8px;
    margin-bottom: 1.5rem;
}

.alert-icon {
    color: #0dcaf0;
    flex-shrink: 0;
}

.alert-text {
    font-size: 0.875rem;
    color: #495057;
    line-height: 1.5;
}

/* Modal Actions */
.modal-actions {
    display: flex;
    gap: 0.75rem;
}

.btn-modal-cancel {
    flex: 1;
    padding: 0.875rem 1.5rem;
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    color: #495057;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-modal-cancel:hover {
    background: #e9ecef;
}

.btn-modal-submit {
    flex: 1;
    padding: 0.875rem 1.5rem;
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    border: none;
    border-radius: 10px;
    color: white;
    font-weight: 500;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    transition: all 0.2s ease;
}

.btn-modal-submit:hover {
    background: linear-gradient(135deg, #0a58ca 0%, #084298 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
}

/* Responsive */
@media (max-width: 992px) {
    .laporan-actions {
        flex-direction: column;
        width: 100%;
    }

    .btn-action {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .laporan-container {
        padding: 1rem;
    }

    .hero-section {
        padding: 1.5rem;
    }

    .page-title {
        font-size: 1.5rem;
    }

    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .laporan-item {
        flex-direction: column;
        align-items: stretch;
        gap: 1rem;
    }

    .laporan-number {
        align-self: flex-start;
    }

    .laporan-header {
        flex-direction: column;
        align-items: stretch;
    }

    .laporan-status {
        align-self: flex-start;
    }

    .data-card-footer {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }

    .pagination-links {
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }

    .filter-actions {
        flex-direction: column;
    }

    .btn-reset {
        width: 100%;
    }
}
</style>
@endsection