@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    
    {{-- Hero Header --}}
    <div class="hero-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="dashboard-title mb-2">Dashboard Admin</h1>
                <p class="dashboard-subtitle mb-0">
                    Selamat datang, <strong>{{ Auth::user()->name }}</strong>! 
                    <span class="text-muted">Kelola dan pantau semua laporan warga</span>
                </p>
            </div>
            <div class="d-none d-md-block">
                <div class="date-badge">
                    <svg width="18" height="18" fill="currentColor" class="me-2">
                        <path d="M9 11H7v2h2v-2zm4-8h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/>
                    </svg>
                    {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                </div>
            </div>
        </div>
    </div>

    {{-- Main Stats Cards --}}
    <div class="row g-3 mb-4">
        {{-- Total Laporan --}}
        <div class="col-6 col-md-3">
            <div class="stat-card stat-card-primary">
                <div class="stat-icon">
                    <svg width="28" height="28" fill="currentColor">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z"/>
                    </svg>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $total }}</div>
                    <div class="stat-label">Total Laporan</div>
                </div>
            </div>
        </div>

        {{-- Menunggu --}}
        <div class="col-6 col-md-3">
            <div class="stat-card stat-card-warning">
                <div class="stat-icon">
                    <svg width="28" height="28" fill="currentColor">
                        <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                    </svg>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $menunggu }}</div>
                    <div class="stat-label">Menunggu Verifikasi</div>
                    @if($menunggu > 0)
                    <span class="stat-badge badge-warning">Perlu Aksi</span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Diproses --}}
        <div class="col-6 col-md-3">
            <div class="stat-card stat-card-info">
                <div class="stat-icon">
                    <svg width="28" height="28" fill="currentColor">
                        <path d="M19.43 12.98c.04-.32.07-.64.07-.98s-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.3-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.23-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98s.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.23.09.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zM12 15.5c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5z"/>
                    </svg>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $diproses }}</div>
                    <div class="stat-label">Sedang Diproses</div>
                </div>
            </div>
        </div>

        {{-- Selesai --}}
        <div class="col-6 col-md-3">
            <div class="stat-card stat-card-success">
                <div class="stat-icon">
                    <svg width="28" height="28" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $selesai }}</div>
                    <div class="stat-label">Telah Selesai</div>
                </div>
            </div>
        </div>

        {{-- Ditolak (TAMBAHAN BARU) --}}
        <div class="col-6 col-md-3">
            <div class="stat-card stat-card-danger">
                <div class="stat-icon">
                    <svg width="28" height="28" fill="currentColor">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                    </svg>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $ditolak }}</div>
                    <div class="stat-label">Ditolak</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Time Period Stats --}}
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="period-stats-card">
                <h6 class="period-title">Statistik Periode</h6>
                <div class="row g-3">
                    <div class="col-4">
                        <div class="period-item">
                            <div class="period-value">{{ $todayReports }}</div>
                            <div class="period-label">Hari Ini</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="period-item">
                            <div class="period-value">{{ $weekReports }}</div>
                            <div class="period-label">Minggu Ini</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="period-item">
                            <div class="period-value">{{ $monthReports }}</div>
                            <div class="period-label">Bulan Ini</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CHARTS SECTION --}}
    <div class="row g-4 mb-4">
        {{-- Bar Chart: Tren Laporan Bulanan --}}
        <div class="col-12 col-lg-8">
            <div class="content-card">
                <div class="content-card-header">
                    <h5 class="content-card-title">
                        <svg width="20" height="20" fill="currentColor" class="me-2">
                            <path d="M3 17v2h6v-2H3zM3 5v2h10V5H3zm10 16v-2h8v-2h-8v-2h-2v6h2zM7 9v2H3v2h4v2h2V9H7zm14 4v-2H11v2h10zm-6-4h2V7h4V5h-4V3h-2v6z"/>
                        </svg>
                        Tren Laporan 6 Bulan Terakhir
                    </h5>
                </div>
                <div class="content-card-body p-4">
                    <canvas id="monthlyReportsChart" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        {{-- Donut Chart: Status Distribution --}}
        <div class="col-12 col-lg-4">
            <div class="content-card">
                <div class="content-card-header">
                    <h5 class="content-card-title">
                        <svg width="20" height="20" fill="currentColor" class="me-2">
                            <path d="M11 2v20c-5.07-.5-9-4.79-9-10s3.93-9.5 9-10zm2.03 0v8.99H22c-.47-4.74-4.24-8.52-8.97-8.99zm0 11.01V22c4.74-.47 8.5-4.25 8.97-8.99h-8.97z"/>
                        </svg>
                        Distribusi Status
                    </h5>
                </div>
                <div class="content-card-body p-4">
                    <canvas id="statusDonutChart" style="max-height: 280px;"></canvas>
                    <div class="chart-legend mt-3">
                        <div class="legend-item">
                            <span class="legend-dot" style="background: #ffc107;"></span>
                            <span class="legend-label">Menunggu</span>
                            <span class="legend-value">{{ $menunggu }}</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-dot" style="background: #0dcaf0;"></span>
                            <span class="legend-label">Diproses</span>
                            <span class="legend-value">{{ $diproses }}</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-dot" style="background: #198754;"></span>
                            <span class="legend-label">Selesai</span>
                            <span class="legend-value">{{ $selesai }}</span>
                        </div>
                        <!-- ✨ TAMBAHAN BARU -->
                        <div class="legend-item">
                            <span class="legend-dot" style="background: #dc3545;"></span>
                            <span class="legend-label">Ditolak</span>
                            <span class="legend-value">{{ $ditolak }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Latest Reports --}}
        <div class="col-12 col-lg-8">
            <div class="content-card">
                {{-- Card Header --}}
                <div class="content-card-header">
                    <h5 class="content-card-title">
                        <svg width="20" height="20" fill="currentColor" class="me-2">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z"/>
                        </svg>
                        Laporan Terbaru
                    </h5>
                    <a href="{{ route('admin.laporan.index') }}" class="btn-link">
                        Lihat Semua
                        <svg width="16" height="16" fill="currentColor" class="ms-1">
                            <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                        </svg>
                    </a>
                </div>

                {{-- Card Body --}}
                <div class="content-card-body">
                    @forelse($latest as $item)
                        <div class="report-item">
                            {{-- Report Image/Icon --}}
                            <div class="report-image">
                                @if($item->foto)
                                    <img 
                                        src="{{ Storage::url($item->foto) }}" 
                                        alt="{{ $item->judul }}"
                                    >
                                @else
                                    <div class="report-image-placeholder">
                                        <svg width="24" height="24" fill="currentColor">
                                            <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            {{-- Report Content --}}
                            <div class="report-content">
                                <div class="report-header">
                                    <h6 class="report-title">
                                        {{ Str::limit($item->judul, 60) }}
                                    </h6>
                                    <span class="report-status status-{{ $item->status }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </div>

                                <p class="report-description">
                                    {{ Str::limit($item->isi, 100) }}
                                </p>

                                <div class="report-meta">
                                    <span class="meta-item">
                                        <svg width="14" height="14" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        {{ $item->user->name ?? 'Anonim' }}
                                    </span>
                                    <span class="meta-item">
                                        <svg width="14" height="14" fill="currentColor">
                                            <path d="M9 11H7v2h2v-2zm4-8h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/>
                                        </svg>
                                        {{ $item->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>

                            {{-- Report Action --}}
                            <div class="report-action">
                                <a 
                                    href="{{ route('admin.laporan.show', $item->id) }}" 
                                    class="btn-detail"
                                >
                                    Detail
                                    <svg width="14" height="14" fill="currentColor" class="ms-1">
                                        <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        {{-- Empty State --}}
                        <div class="empty-state">
                            <svg width="64" height="64" fill="currentColor" class="empty-icon">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z"/>
                            </svg>
                            <p class="empty-text">Belum ada laporan</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-12 col-lg-4">
            {{-- Quick Actions Card --}}
            <div class="content-card mb-4">
                <div class="content-card-header">
                    <h5 class="content-card-title">
                        <svg width="20" height="20" fill="currentColor" class="me-2">
                            <path d="M3 17v2h6v-2H3zM3 5v2h10V5H3zm10 16v-2h8v-2h-8v-2h-2v6h2zM7 9v2H3v2h4v2h2V9H7zm14 4v-2H11v2h10zm-6-4h2V7h4V5h-4V3h-2v6z"/>
                        </svg>
                        Aksi Cepat
                    </h5>
                </div>

                <div class="content-card-body p-3">
                    <div class="action-buttons">
                        {{-- Kelola Laporan --}}
                        <a 
                            href="{{ route('admin.laporan.index') }}" 
                            class="action-btn action-btn-primary"
                        >
                            <svg width="18" height="18" fill="currentColor">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z"/>
                            </svg>
                            <span>Kelola Laporan</span>
                        </a>
                        
                        {{-- Verifikasi Laporan --}}
                        @if($menunggu > 0)
                            <a 
                                href="{{ route('admin.laporan.index', ['status' => 'menunggu']) }}" 
                                class="action-btn action-btn-warning"
                            >
                                <svg width="18" height="18" fill="currentColor">
                                    <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                                </svg>
                                <span>Verifikasi Laporan</span>
                                <span class="action-badge">{{ $menunggu }}</span>
                            </a>
                        @endif

                        {{-- Export Laporan --}}
                        <a 
                            href="{{ route('admin.laporan.export.pdf', request()->query()) }}" 
                            class="action-btn action-btn-outline"
                        >
                            <svg width="18" height="18" fill="currentColor">
                                <path d="M19 12v7H5v-7H3v7c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-7h-2zm-6 .67l2.59-2.58L17 11.5l-5 5-5-5 1.41-1.41L11 12.67V3h2z"/>
                            </svg>
                            <span>Export Laporan</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Status Progress Card --}}
            <div class="content-card">
                <div class="content-card-header">
                    <h5 class="content-card-title">
                        <svg width="20" height="20" fill="currentColor" class="me-2">
                            <path d="M3.5 18.49l6-6.01 4 4L22 6.92l-1.41-1.41-7.09 7.97-4-4L2 16.99z"/>
                        </svg>
                        Progres Status
                    </h5>
                </div>

                <div class="content-card-body p-3">
                    {{-- Progress: Menunggu --}}
                    <div class="progress-item">
                        <div class="progress-header">
                            <span class="progress-label">Menunggu</span>
                            <span class="progress-percentage">
                                {{ $total > 0 ? round(($menunggu / $total) * 100) : 0 }}%
                            </span>
                        </div>
                        <div class="progress-bar-wrapper">
                            <div 
                                class="progress-bar progress-warning" 
                                style="width: {{ $total > 0 ? ($menunggu / $total) * 100 : 0 }}%"
                            ></div>
                        </div>
                        <div class="progress-count">{{ $menunggu }} laporan</div>
                    </div>

                    {{-- Progress: Diproses --}}
                    <div class="progress-item">
                        <div class="progress-header">
                            <span class="progress-label">Diproses</span>
                            <span class="progress-percentage">
                                {{ $total > 0 ? round(($diproses / $total) * 100) : 0 }}%
                            </span>
                        </div>
                        <div class="progress-bar-wrapper">
                            <div 
                                class="progress-bar progress-info" 
                                style="width: {{ $total > 0 ? ($diproses / $total) * 100 : 0 }}%"
                            ></div>
                        </div>
                        <div class="progress-count">{{ $diproses }} laporan</div>
                    </div>

                    {{-- Progress: Selesai --}}
                    <div class="progress-item">
                        <div class="progress-header">
                            <span class="progress-label">Selesai</span>
                            <span class="progress-percentage">
                                {{ $total > 0 ? round(($selesai / $total) * 100) : 0 }}%
                            </span>
                        </div>
                        <div class="progress-bar-wrapper">
                            <div 
                                class="progress-bar progress-success" 
                                style="width: {{ $total > 0 ? ($selesai / $total) * 100 : 0 }}%"
                            ></div>
                        </div>
                        <div class="progress-count">{{ $selesai }} laporan</div>
                    </div>

                    {{-- Progress: Ditolak (TAMBAHAN BARU) --}}
                    <div class="progress-item">
                        <div class="progress-header">
                            <span class="progress-label">Ditolak</span>
                            <span class="progress-percentage">
                                {{ $total > 0 ? round(($ditolak / $total) * 100) : 0 }}%
                            </span>
                        </div>
                        <div class="progress-bar-wrapper">
                            <div 
                                class="progress-bar progress-danger" 
                                style="width: {{ $total > 0 ? ($ditolak / $total) * 100 : 0 }}%"
                            ></div>
                        </div>
                        <div class="progress-count">{{ $ditolak }} laporan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
/* Reset & Base */
.dashboard-container {
    padding: 1.5rem;
    background: #f5f7fa;
    min-height: 100vh;
}

/* Hero Header */
.hero-header {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    color: white;
    padding: 2rem;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(13, 110, 253, 0.15);
}

.dashboard-title {
    font-size: 1.75rem;
    font-weight: 700;
    margin: 0;
}

.dashboard-subtitle {
    font-size: 0.95rem;
    opacity: 0.95;
}

.date-badge {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    font-weight: 500;
}

/* Stat Cards */
.stat-card {
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

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: currentColor;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
}

.stat-card-primary { color: #0d6efd; }
.stat-card-warning { color: #ffc107; }
.stat-card-info { color: #0dcaf0; }
.stat-card-success { color: #198754; }
.stat-card-danger { color: #dc3545; }  /* TAMBAHAN BARU */

.stat-icon {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: currentColor;
    color: white;
    opacity: 0.95;
    flex-shrink: 0;
}

.stat-content {
    flex: 1;
    position: relative;
}

.stat-value {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1a1a1a;
    line-height: 1;
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.8rem;
    color: #6c757d;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-badge {
    position: absolute;
    top: -8px;
    right: 0;
    font-size: 0.7rem;
    padding: 0.25rem 0.5rem;
    border-radius: 20px;
    font-weight: 600;
}

.badge-warning {
    background: #fff3cd;
    color: #997404;
}

/* Period Stats */
.period-stats-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
}

.period-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: #495057;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 1rem;
}

.period-item {
    text-align: center;
    padding: 1rem;
    border-radius: 8px;
    background: #f8f9fa;
    transition: all 0.2s ease;
}

.period-item:hover {
    background: #e9ecef;
}

.period-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: #0d6efd;
    margin-bottom: 0.25rem;
}

.period-label {
    font-size: 0.8rem;
    color: #6c757d;
    font-weight: 500;
}

/* Content Card */
.content-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    overflow: hidden;
}

.content-card-header {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.content-card-title {
    font-size: 1rem;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0;
    display: flex;
    align-items: center;
}

.btn-link {
    color: #0d6efd;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    transition: all 0.2s ease;
}

.btn-link:hover {
    color: #0a58ca;
    gap: 0.5rem;
}

.content-card-body {
    padding: 0;
}

/* Chart Legend */
.chart-legend {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 0.85rem;
}

.legend-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    flex-shrink: 0;
}

.legend-label {
    flex: 1;
    color: #495057;
    font-weight: 500;
}

.legend-value {
    font-weight: 700;
    color: #1a1a1a;
}

/* Report Item */
.report-item {
    display: flex;
    gap: 1rem;
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid #f1f3f5;
    transition: all 0.2s ease;
}

.report-item:last-child {
    border-bottom: none;
}

.report-item:hover {
    background: #f8f9fa;
}

.report-image {
    flex-shrink: 0;
    width: 72px;
    height: 72px;
    border-radius: 10px;
    overflow: hidden;
}

.report-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.report-image-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
}

.report-content {
    flex: 1;
    min-width: 0;
}

.report-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    gap: 0.75rem;
    margin-bottom: 0.5rem;
}

.report-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0;
    line-height: 1.4;
}

.report-status {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    white-space: nowrap;
    flex-shrink: 0;
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

.report-description {
    font-size: 0.85rem;
    color: #6c757d;
    margin-bottom: 0.75rem;
    line-height: 1.5;
}

.report-meta {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.meta-item {
    font-size: 0.8rem;
    color: #868e96;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.report-action {
    flex-shrink: 0;
    display: flex;
    align-items: center;
}

.btn-detail {
    padding: 0.5rem 1rem;
    background: #0d6efd;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    transition: all 0.2s ease;
}

.btn-detail:hover {
    background: #0a58ca;
    transform: translateX(2px);
    color: white;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 3rem 1.5rem;
}

.empty-icon {
    color: #dee2e6;
    margin-bottom: 1rem;
}

.empty-text {
    color: #6c757d;
    font-size: 0.95rem;
    margin: 0;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.action-btn {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.875rem 1rem;
    border-radius: 10px;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.2s ease;
    position: relative;
}

.action-btn span:first-of-type {
    flex: 1;
}

.action-btn-primary {
    background: #0d6efd;
    color: white;
}

.action-btn-primary:hover {
    background: #0a58ca;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    color: white;
}

.action-btn-warning {
    background: #ffc107;
    color: white;
}

.action-btn-warning:hover {
    background: #ffb300;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
    color: white;
}

.action-btn-outline {
    background: white;
    color: #dc3545;
    border: 1.5px solid #dc3545;
}

.action-btn-outline:hover {
    background: #dc3545;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);
}

.action-badge {
    background: rgba(255, 255, 255, 0.3);
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

/* Progress */
.progress-item {
    margin-bottom: 1.5rem;
}

.progress-item:last-child {
    margin-bottom: 0;
}

.progress-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
}

.progress-label {
    font-size: 0.85rem;
    font-weight: 600;
    color: #495057;
}

.progress-percentage {
    font-size: 0.85rem;
    font-weight: 700;
    color: #0d6efd;
}

.progress-bar-wrapper {
    height: 8px;
    background: #e9ecef;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 0.5rem;
}

.progress-bar {
    height: 100%;
    border-radius: 10px;
    transition: width 0.6s ease;
}

.progress-warning {
    background: #ffc107;
}

.progress-info {
    background: #0dcaf0;
}

.progress-success {
    background: #198754;
}

.progress-count {
    font-size: 0.75rem;
    color: #868e96;
}

/* Responsive */
@media (max-width: 768px) {
    .dashboard-container {
        padding: 1rem;
    }

    .hero-header {
        padding: 1.5rem;
    }

    .dashboard-title {
        font-size: 1.5rem;
    }

    .stat-card {
        padding: 1rem;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
    }

    .stat-value {
        font-size: 1.5rem;
    }

    .report-item {
        flex-direction: column;
    }

    .report-action {
        align-self: stretch;
    }

    .btn-detail {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .stat-card {
        gap: 0.75rem;
    }

    .stat-icon {
        width: 40px;
        height: 40px;
    }

    .stat-icon svg {
        width: 20px;
        height: 20px;
    }

    .stat-value {
        font-size: 1.25rem;
    }

    .stat-label {
        font-size: 0.7rem;
    }
}
</style>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // ========================================
    // BAR CHART: Tren Laporan 6 Bulan Terakhir
    // ========================================
    const monthlyCtx = document.getElementById('monthlyReportsChart');
    if (monthlyCtx) {
        
        // Data dari controller (PHP ke JavaScript)
        const monthlyData = {
            labels: @json($monthlyChartData['labels']),
            datasets: [
            {
                label: 'Menunggu',
                data: @json($monthlyChartData['menunggu']),
                backgroundColor: 'rgba(255, 193, 7, 0.8)',
                borderColor: 'rgba(255, 193, 7, 1)',
                borderWidth: 2,
                borderRadius: 8,
            },
            {
                label: 'Diproses',
                data: @json($monthlyChartData['diproses']),
                backgroundColor: 'rgba(13, 202, 240, 0.8)',
                borderColor: 'rgba(13, 202, 240, 1)',
                borderWidth: 2,
                borderRadius: 8,
            },
            {
                label: 'Selesai',
                data: @json($monthlyChartData['selesai']),
                backgroundColor: 'rgba(25, 135, 84, 0.8)',
                borderColor: 'rgba(25, 135, 84, 1)',
                borderWidth: 2,
                borderRadius: 8,
            },
            // ✨ TAMBAHAN BARU
            {
                label: 'Ditolak',
                data: @json($monthlyChartData['ditolak']),
                backgroundColor: 'rgba(220, 53, 69, 0.8)',
                borderColor: 'rgba(220, 53, 69, 1)',
                borderWidth: 2,
                borderRadius: 8,
            }
        ]
        };

        new Chart(monthlyCtx, {
            type: 'bar',
            data: monthlyData,
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            padding: 15,
                            font: {
                                size: 12,
                                weight: '600'
                            },
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        cornerRadius: 8,
                        titleFont: {
                            size: 13,
                            weight: '600'
                        },
                        bodyFont: {
                            size: 12
                        },
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y + ' laporan';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11,
                                weight: '500'
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            },
                            stepSize: 5,
                            callback: function(value) {
                                if (Number.isInteger(value)) {
                                    return value;
                                }
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    }

    // ========================================
    // DONUT CHART: Status Distribution
    // ========================================
    const donutCtx = document.getElementById('statusDonutChart');
    if (donutCtx) {
        
        const statusData = {
            labels: ['Menunggu', 'Diproses', 'Selesai', 'Ditolak'], // TAMBAH 'Ditolak'
            datasets: [{
                data: [
                    {{ $statusChartData['menunggu'] }}, 
                    {{ $statusChartData['diproses'] }}, 
                    {{ $statusChartData['selesai'] }},
                    {{ $statusChartData['ditolak'] }}  // TAMBAHAN BARU
                ],
                backgroundColor: [
                    'rgba(255, 193, 7, 0.9)',
                    'rgba(13, 202, 240, 0.9)',
                    'rgba(25, 135, 84, 0.9)',
                    'rgba(220, 53, 69, 0.9)'  // TAMBAHAN BARU - Warna Merah
                ],
                borderColor: [
                    'rgba(255, 193, 7, 1)',
                    'rgba(13, 202, 240, 1)',
                    'rgba(25, 135, 84, 1)',
                    'rgba(220, 53, 69, 1)'  // TAMBAHAN BARU
                ],
                borderWidth: 2,
                hoverOffset: 10
            }]
        };

        new Chart(donutCtx, {
            type: 'doughnut',
            data: statusData,
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false // Kita pakai custom legend
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        cornerRadius: 8,
                        titleFont: {
                            size: 13,
                            weight: '600'
                        },
                        bodyFont: {
                            size: 12
                        },
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(1) : 0;
                                return context.label + ': ' + context.parsed + ' (' + percentage + '%)';
                            }
                        }
                    }
                },
                cutout: '65%',
                animation: {
                    animateRotate: true,
                    animateScale: true,
                    duration: 1000,
                    easing: 'easeInOutQuart'
                }
            }
        });
    }
});
</script>

@endsection