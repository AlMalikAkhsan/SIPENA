@extends('layouts.user')

@section('title', 'Semua Laporan Warga - Lapor Aja!')

@push('styles')
<style>
    :root {
        --primary: #3b82f6;
        --primary-dark: #1d4ed8;
        --primary-light: #60a5fa;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --text: #111827;
        --text-muted: #6b7280;
        --border: #e5e7eb;
        --bg: #f9fafb;
        --surface: #ffffff;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
        --shadow-md: 0 4px 12px rgba(0,0,0,0.08);
        --shadow-lg: 0 10px 30px rgba(0,0,0,0.1);
        --radius: 16px;
    }

    body {
        background: var(--bg);
    }

    .laporan-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 1.5rem 1rem 6rem;
    }

    /* Header */
    .page-header {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .header-content h1 {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text);
        margin: 0 0 0.5rem;
    }

    .header-content p {
        color: var(--text-muted);
        margin: 0;
        font-size: 1rem;
    }

    .btn-my-reports {
        padding: 0.75rem 1.75rem;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(59,130,246,0.2);
    }

    .btn-my-reports:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59,130,246,0.3);
        color: white;
    }

    /* Stats Section */
    .stats-section {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.75rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.25rem;
    }

    .stat-item {
        text-align: center;
        padding: 1.25rem;
        background: var(--bg);
        border-radius: 12px;
        border: 1px solid var(--border);
        transition: all 0.3s ease;
    }

    .stat-item:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        margin: 0 auto 1rem;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
    }

    .stat-icon.blue { background: rgba(59,130,246,0.1); color: var(--primary); }
    .stat-icon.orange { background: rgba(245,158,11,0.1); color: var(--warning); }
    .stat-icon.green { background: rgba(16,185,129,0.1); color: var(--success); }
    .stat-icon.red { background: rgba(239,68,68,0.1); color: var(--danger); }

    .stat-value {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text);
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.9rem;
        color: var(--text-muted);
        font-weight: 500;
    }

    /* Filter Section */
    .filter-section {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.75rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
    }

    .filter-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text);
        margin: 0 0 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .filter-title i {
        color: var(--primary);
    }

    .form-control,
    .form-select {
        border-radius: 10px;
        border: 1px solid var(--border);
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.25rem rgba(59,130,246,0.1);
    }

    .input-group-text {
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 10px 0 0 10px;
        color: var(--text-muted);
    }

    .input-group .form-control {
        border-radius: 0 10px 10px 0;
    }

    .btn-filter {
        padding: 0.75rem 1.5rem;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-filter:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59,130,246,0.3);
    }

    .btn-reset {
        padding: 0.75rem 1rem;
        background: var(--bg);
        color: var(--text-muted);
        border: 1px solid var(--border);
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-reset:hover {
        background: var(--danger);
        color: white;
        border-color: var(--danger);
    }

    /* Results Info */
    .results-info {
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 1rem 1.5rem;
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .results-text {
        color: var(--text);
        font-weight: 600;
    }

    .active-filters {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .filter-badge {
        padding: 0.4rem 0.9rem;
        background: var(--primary);
        color: white;
        border-radius: 999px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .filter-badge i {
        cursor: pointer;
        opacity: 0.8;
    }

    .filter-badge i:hover {
        opacity: 1;
    }

    /* Laporan Grid */
    .laporan-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.75rem;
        margin-bottom: 2rem;
    }

    /* Laporan Card */
    .laporan-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .laporan-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-light);
    }

    .card-image {
        height: 200px;
        position: relative;
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        overflow: hidden;
    }

    .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .laporan-card:hover .card-image img {
        transform: scale(1.1);
    }

    .image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #9ca3af;
    }

    .image-placeholder i {
        font-size: 4rem;
        opacity: 0.5;
        margin-bottom: 0.5rem;
    }

    /* Status Badge on Card */
    .card-status-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        padding: 0.5rem 1rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .status-menunggu {
        background: rgba(245,158,11,0.95);
        color: white;
    }

    .status-diproses {
        background: rgba(59,130,246,0.95);
        color: white;
    }

    .status-selesai {
        background: rgba(16,185,129,0.95);
        color: white;
    }

    .status-ditolak {
        background: rgba(239,68,68,0.95);
        color: white;
    }

    .card-body {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .card-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--text);
        margin: 0 0 0.75rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-description {
        font-size: 0.92rem;
        color: var(--text-muted);
        line-height: 1.6;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex-grow: 1;
    }

    /* User Info in Card */
    .card-user {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.9rem;
        background: var(--bg);
        border-radius: 10px;
        margin-bottom: 1rem;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-light), var(--primary));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        font-weight: 700;
        flex-shrink: 0;
    }

    .user-details {
        flex: 1;
        min-width: 0;
    }

    .user-name {
        font-weight: 600;
        color: var(--text);
        font-size: 0.9rem;
        margin-bottom: 0.2rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .user-date {
        font-size: 0.8rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .card-footer-custom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid var(--border);
        margin-top: auto;
    }

    .card-meta {
        font-size: 0.85rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-detail {
        padding: 0.55rem 1.25rem;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.88rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-detail:hover {
        background: var(--primary-dark);
        transform: translateX(3px);
        color: white;
    }

    /* Empty State */
    .empty-state {
        background: var(--surface);
        border: 2px dashed var(--border);
        border-radius: var(--radius);
        padding: 5rem 2rem;
        text-align: center;
    }

    .empty-icon {
        font-size: 5rem;
        color: #d1d5db;
        margin-bottom: 1.5rem;
    }

    .empty-state h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 0.75rem;
    }

    .empty-state p {
        font-size: 1.05rem;
        color: var(--text-muted);
        margin-bottom: 2rem;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .btn-primary-action {
        padding: 0.9rem 2rem;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(59,130,246,0.2);
    }

    .btn-primary-action:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(59,130,246,0.3);
        color: white;
    }

    /* Pagination */
    .pagination {
        justify-content: center;
        gap: 0.5rem;
    }

    .pagination .page-link {
        border-radius: 8px;
        border: 1px solid var(--border);
        color: var(--text);
        padding: 0.6rem 1rem;
        font-weight: 600;
    }

    .pagination .page-link:hover {
        background: var(--primary-light);
        border-color: var(--primary-light);
        color: white;
    }

    .pagination .page-item.active .page-link {
        background: var(--primary);
        border-color: var(--primary);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            padding: 1.5rem;
        }

        .header-content h1 {
            font-size: 1.5rem;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .laporan-grid {
            grid-template-columns: 1fr;
        }

        .card-image {
            height: 180px;
        }

        .filter-section {
            padding: 1.25rem;
        }

        .results-info {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="laporan-container">

    <!-- Page Header -->
    <div class="page-header">
        <div class="header-content">
            <h1>Semua Laporan Warga</h1>
            <p>Lihat dan pantau laporan dari seluruh warga RW 05</p>
        </div>
        <a href="{{ route('warga.laporan.index') }}" class="btn-my-reports">
            <i class="fas fa-user"></i>
            Laporan Saya
        </a>
    </div>

    <!-- Stats Section -->
    <div class="stats-section">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-icon blue"><i class="fas fa-file-alt"></i></div>
                <div class="stat-value">{{ $laporan->total() }}</div>
                <div class="stat-label">Total Laporan</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon orange"><i class="fas fa-clock"></i></div>
                <div class="stat-value">{{ $laporan->where('status', 'menunggu')->count() }}</div>
                <div class="stat-label">Menunggu</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon blue"><i class="fas fa-tasks"></i></div>
                <div class="stat-value">{{ $laporan->where('status', 'diproses')->count() }}</div>
                <div class="stat-label">Diproses</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon green"><i class="fas fa-check-circle"></i></div>
                <div class="stat-value">{{ $laporan->where('status', 'selesai')->count() }}</div>
                <div class="stat-label">Selesai</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon red"><i class="fas fa-times-circle"></i></div>
                <div class="stats-value text-danger">{{ $laporan->where('status', 'ditolak')->count() }}</div>
                <div class="stats-label">Ditolak</div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <h3 class="filter-title">
            <i class="fas fa-filter"></i>
            Filter & Pencarian
        </h3>
        
        <form method="GET" action="{{ route('warga.laporan.semua') }}">
            <div class="row g-3">
                <div class="col-md-5">
                    <label class="form-label small fw-semibold text-muted mb-2">Cari Laporan</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" 
                               name="search" 
                               class="form-control"
                               placeholder="Cari judul atau isi laporan..." 
                               value="{{ request('search') }}">
                    </div>
                </div>
                
                <div class="col-md-3">
                    <label class="form-label small fw-semibold text-muted mb-2">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <label class="form-label small fw-semibold text-muted mb-2">Urutkan</label>
                    <select name="sort" class="form-select">
                        <option value="terbaru" {{ request('sort') == 'terbaru' || !request('sort') ? 'selected' : '' }}>Terbaru</option>
                        <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <label class="form-label small fw-semibold text-muted mb-2">&nbsp;</label>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-filter flex-fill">
                            <i class="fas fa-search me-1"></i> Cari
                        </button>
                        @if(request('search') || request('status') || request('sort'))
                            <a href="{{ route('warga.laporan.semua') }}" class="btn btn-reset" title="Reset Filter">
                                <i class="fas fa-redo"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Results Info -->
    @if(request('search') || request('status') || request('sort'))
        <div class="results-info">
            <div class="results-text">
                <i class="fas fa-info-circle me-2"></i>
                Menampilkan {{ $laporan->count() }} dari {{ $laporan->total() }} laporan
            </div>
            <div class="active-filters">
                @if(request('search'))
                    <span class="filter-badge">
                        <i class="fas fa-search"></i>
                        "{{ request('search') }}"
                        <i class="fas fa-times" onclick="removeFilter('search')"></i>
                    </span>
                @endif
                @if(request('status'))
                    <span class="filter-badge">
                        Status: {{ ucfirst(request('status')) }}
                        <i class="fas fa-times" onclick="removeFilter('status')"></i>
                    </span>
                @endif
                @if(request('sort'))
                    <span class="filter-badge">
                        {{ ucfirst(request('sort')) }}
                        <i class="fas fa-times" onclick="removeFilter('sort')"></i>
                    </span>
                @endif
            </div>
        </div>
    @endif

    <!-- Laporan Grid -->
    @if($laporan->count() > 0)
        <div class="laporan-grid">
            @foreach($laporan as $item)
                <div class="laporan-card">
                    <!-- Card Image -->
                    @if($item->fotos && $item->fotos->count() > 0)
                        <div class="card-image">
                            <img src="{{ asset('storage/' . $item->fotos->first()->foto_path) }}" alt="{{ $item->judul }}">
                            <span class="card-status-badge status-{{ $item->status }}">
                                @if($item->status == 'menunggu')
                                    <i class="fas fa-clock"></i>
                                @elseif($item->status == 'diproses')
                                    <i class="fas fa-spinner"></i>
                                @elseif($item->status == 'selesai')
                                    <i class="fas fa-check-circle"></i>
                                @else
                                    <i class="fas fa-times-circle"></i>
                                @endif
                                {{ ucfirst($item->status) }}
                            </span>
                        </div>
                    @else
                        <div class="card-image">
                            <div class="image-placeholder">
                                <i class="far fa-image"></i>
                                <span style="font-size: 0.9rem; margin-top: 0.5rem;">Tidak ada foto</span>
                            </div>
                            <span class="card-status-badge status-{{ $item->status }}">
                                @if($item->status == 'menunggu')
                                    <i class="fas fa-clock"></i>
                                @elseif($item->status == 'diproses')
                                    <i class="fas fa-spinner"></i>
                                @elseif($item->status == 'selesai')
                                    <i class="fas fa-check-circle"></i>
                                @else
                                    <i class="fas fa-times-circle"></i>
                                @endif
                                {{ ucfirst($item->status) }}
                            </span>
                        </div>
                    @endif

                    <!-- Card Body -->
                    <div class="card-body">
                        <h3 class="card-title">{{ $item->judul }}</h3>
                        <p class="card-description">{{ $item->isi }}</p>

                        <!-- User Info -->
                        <div class="card-user">
                            <div class="user-avatar">
                                {{ strtoupper(substr($item->user->name ?? 'A', 0, 1)) }}
                            </div>
                            <div class="user-details">
                                <div class="user-name">{{ $item->user->name ?? 'Anonim' }}</div>
                                <div class="user-date">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $item->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="card-footer-custom">
                            <div class="card-meta">
                                <i class="fas fa-clock"></i>
                                {{ $item->created_at->diffForHumans() }}
                            </div>
                            <a href="{{ route('warga.laporan.detail_umum', $item->id) }}" class="btn-detail">
                                Detail
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($laporan->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $laporan->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-icon">
                <i class="far fa-folder-open"></i>
            </div>
            <h3>
                @if(request('search') || request('status'))
                    Tidak Ada Hasil yang Ditemukan
                @else
                    Belum Ada Laporan dari Warga
                @endif
            </h3>
            <p>
                @if(request('search') || request('status'))
                    Coba ubah kata kunci pencarian atau filter yang Anda gunakan.
                @else
                    Saat ini belum ada laporan dari warga. Jadilah yang pertama berkontribusi!
                @endif
            </p>
            
            <div class="d-flex gap-3 justify-content-center">
                @if(request('search') || request('status'))
                    <a href="{{ route('warga.laporan.semua') }}" class="btn-primary-action" style="background: var(--text-muted);">
                        <i class="fas fa-redo"></i>
                        Reset Filter
                    </a>
                @endif
                <a href="{{ route('warga.laporan.create') }}" class="btn-primary-action">
                    <i class="fas fa-plus-circle"></i>
                    Buat Laporan Baru
                </a>
            </div>
        </div>
    @endif

</div>
@endsection

@push('scripts')
<script>
// Remove individual filter
function removeFilter(filterName) {
    const url = new URL(window.location.href);
    url.searchParams.delete(filterName);
    window.location.href = url.toString();
}
</script>
@endpush