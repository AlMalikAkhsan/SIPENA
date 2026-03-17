@extends('layouts.app')

@section('content')
<div class="admin-dashboard">
    
    {{-- Hero Header --}}
    <div class="hero-section">
        <div class="hero-content">
            <div class="hero-text">
                <div class="hero-badge">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V9h7V2.99c3.72 1.15 6.47 4.82 7 8.94h-7v1.06z"/>
                    </svg>
                    Admin Panel
                </div>
                <h1 class="hero-title">Dashboard Admin</h1>
                <p class="hero-subtitle">
                    Selamat datang, <strong>{{ Auth::user()->name }}</strong>! 
                    <span class="text-muted">Kelola dan pantau semua laporan warga dengan mudah</span>
                </p>
            </div>
            <div class="hero-date">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/>
                </svg>
                <span>{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
            </div>
        </div>
    </div>

    {{-- Stats Overview --}}
    <div class="stats-grid">
        {{-- Total Laporan --}}
        <div class="stat-card stat-primary">
            <div class="stat-icon-wrapper">
                <div class="stat-icon">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                    </svg>
                </div>
            </div>
            <div class="stat-details">
                <div class="stat-value">{{ $total }}</div>
                <div class="stat-label">Total Laporan</div>
            </div>
            <div class="stat-trend">
                <span class="trend-indicator positive">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/>
                    </svg>
                </span>
            </div>
        </div>

        {{-- Menunggu --}}
        <div class="stat-card stat-warning">
            <div class="stat-icon-wrapper">
                <div class="stat-icon">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                    </svg>
                </div>
                @if($menunggu > 0)
                <div class="stat-pulse"></div>
                @endif
            </div>
            <div class="stat-details">
                <div class="stat-value">{{ $menunggu }}</div>
                <div class="stat-label">Menunggu Verifikasi</div>
            </div>
            @if($menunggu > 0)
            <div class="stat-badge badge-warning">Perlu Aksi!</div>
            @endif
        </div>

        {{-- Diproses --}}
        <div class="stat-card stat-info">
            <div class="stat-icon-wrapper">
                <div class="stat-icon">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19.43 12.98c.04-.32.07-.64.07-.98s-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.3-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.23-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98s.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.23.09.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zM12 15.5c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5z"/>
                    </svg>
                </div>
            </div>
            <div class="stat-details">
                <div class="stat-value">{{ $diproses }}</div>
                <div class="stat-label">Sedang Diproses</div>
            </div>
        </div>

        {{-- Selesai --}}
        <div class="stat-card stat-success">
            <div class="stat-icon-wrapper">
                <div class="stat-icon">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
            </div>
            <div class="stat-details">
                <div class="stat-value">{{ $selesai }}</div>
                <div class="stat-label">Telah Selesai</div>
            </div>
        </div>

        {{-- Ditolak --}}
        <div class="stat-card stat-danger">
            <div class="stat-icon-wrapper">
                <div class="stat-icon">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm5 13.59L15.59 17 12 13.41 8.41 17 7 15.59 10.59 12 7 8.41 8.41 7 12 10.59 15.59 7 17 8.41 13.41 12 17 15.59z"/>
                    </svg>
                </div>
            </div>
            <div class="stat-details">
                <div class="stat-value">{{ $ditolak }}</div>
                <div class="stat-label">Ditolak</div>
            </div>
        </div>
    </div>

    {{-- Time Period Stats --}}
    <div class="period-card">
        <div class="period-header">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                <path d="M3.5 18.49l6-6.01 4 4L22 6.92l-1.41-1.41-7.09 7.97-4-4L2 16.99z"/>
            </svg>
            <h6>Statistik Periode</h6>
        </div>
        <div class="period-grid">
            <div class="period-item">
                <div class="period-icon">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                    </svg>
                </div>
                <div class="period-content">
                    <div class="period-value">{{ $todayReports }}</div>
                    <div class="period-label">Hari Ini</div>
                </div>
            </div>
            <div class="period-item">
                <div class="period-icon">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/>
                    </svg>
                </div>
                <div class="period-content">
                    <div class="period-value">{{ $weekReports }}</div>
                    <div class="period-label">Minggu Ini</div>
                </div>
            </div>
            <div class="period-item">
                <div class="period-icon">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/>
                    </svg>
                </div>
                <div class="period-content">
                    <div class="period-value">{{ $monthReports }}</div>
                    <div class="period-label">Bulan Ini</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content Grid --}}
    <div class="main-grid">
        {{-- Chart Section --}}
        <div class="chart-section">
            <div class="chart-card">
                <div class="chart-header">
                    <div class="chart-title">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2zm0 4h14v-2H7v2zM7 7v2h14V7H7z"/>
                        </svg>
                        <h5>Tren Laporan 6 Bulan Terakhir</h5>
                    </div>
                </div>
                <div class="chart-body">
                    <canvas id="monthlyReportsChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="sidebar-section">
            {{-- Quick Actions --}}
            <div class="quick-actions-card">
                <div class="quick-actions-header">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4V7zm-1-5C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                    </svg>
                    <h6>Aksi Cepat</h6>
                </div>
                <div class="quick-actions-body">
                    <a href="{{ route('admin.laporan.index') }}" class="action-button action-primary">
                        <div class="action-icon">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                            </svg>
                        </div>
                        <span>Kelola Laporan</span>
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" class="arrow">
                            <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                        </svg>
                    </a>

                    @if($menunggu > 0)
                    <a href="{{ route('admin.laporan.index', ['status' => 'menunggu']) }}" class="action-button action-warning">
                        <div class="action-icon">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                            </svg>
                        </div>
                        <span>Verifikasi Laporan</span>
                        <div class="action-notification">{{ $menunggu }}</div>
                    </a>
                    @endif

                    <a href="{{ route('admin.laporan.export.pdf', request()->query()) }}" class="action-button action-outline">
                        <div class="action-icon">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 12v7H5v-7H3v7c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-7h-2zm-6 .67l2.59-2.58L17 11.5l-5 5-5-5 1.41-1.41L11 12.67V3h2z"/>
                            </svg>
                        </div>
                        <span>Export Laporan</span>
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" class="arrow">
                            <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Status Progress --}}
            <div class="progress-card">
                <div class="progress-header">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3.5 18.49l6-6.01 4 4L22 6.92l-1.41-1.41-7.09 7.97-4-4L2 16.99z"/>
                    </svg>
                    <h6>Progres Status</h6>
                </div>
                <div class="progress-body">
                    {{-- Menunggu --}}
                    <div class="progress-item">
                        <div class="progress-info">
                            <span class="progress-label">Menunggu</span>
                            <span class="progress-percent">{{ $total > 0 ? round(($menunggu / $total) * 100) : 0 }}%</span>
                        </div>
                        <div class="progress-bar-container">
                            <div class="progress-bar progress-warning" style="width: {{ $total > 0 ? ($menunggu / $total) * 100 : 0 }}%"></div>
                        </div>
                        <span class="progress-count">{{ $menunggu }} laporan</span>
                    </div>

                    {{-- Diproses --}}
                    <div class="progress-item">
                        <div class="progress-info">
                            <span class="progress-label">Diproses</span>
                            <span class="progress-percent">{{ $total > 0 ? round(($diproses / $total) * 100) : 0 }}%</span>
                        </div>
                        <div class="progress-bar-container">
                            <div class="progress-bar progress-info" style="width: {{ $total > 0 ? ($diproses / $total) * 100 : 0 }}%"></div>
                        </div>
                        <span class="progress-count">{{ $diproses }} laporan</span>
                    </div>

                    {{-- Selesai --}}
                    <div class="progress-item">
                        <div class="progress-info">
                            <span class="progress-label">Selesai</span>
                            <span class="progress-percent">{{ $total > 0 ? round(($selesai / $total) * 100) : 0 }}%</span>
                        </div>
                        <div class="progress-bar-container">
                            <div class="progress-bar progress-success" style="width: {{ $total > 0 ? ($selesai / $total) * 100 : 0 }}%"></div>
                        </div>
                        <span class="progress-count">{{ $selesai }} laporan</span>
                    </div>

                    {{-- Ditolak --}}
                    <div class="progress-item">
                        <div class="progress-info">
                            <span class="progress-label">Ditolak</span>
                            <span class="progress-percent">{{ $total > 0 ? round(($ditolak / $total) * 100) : 0 }}%</span>
                        </div>
                        <div class="progress-bar-container">
                            <div class="progress-bar progress-danger" style="width: {{ $total > 0 ? ($ditolak / $total) * 100 : 0 }}%"></div>
                        </div>
                        <span class="progress-count">{{ $ditolak }} laporan</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Latest Reports --}}
        <div class="reports-section">
            <div class="reports-card">
                <div class="reports-header">
                    <div class="reports-title">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22 5.72l-4.6-3.86-1.29 1.53 4.6 3.86L22 5.72zM7.88 3.39L6.6 1.86 2 5.71l1.29 1.53 4.59-3.85zM12 4c-4.97 0-9 4.03-9 9s4.02 9 9 9c4.97 0 9-4.03 9-9s-4.03-9-9-9zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm1-11h-2v6l5.25 3.15.75-1.23-4-2.42V9z"/>
                        </svg>
                        <h5>Laporan Terbaru</h5>
                    </div>
                    <a href="{{ route('admin.laporan.index') }}" class="view-all-link">
                        Lihat Semua
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                        </svg>
                    </a>
                </div>
                <div class="reports-body">
                    @forelse($latest as $item)
                        <div class="report-item">
                            <div class="report-thumbnail">
                                @if($item->fotos && $item->fotos->count() > 0)
                                    <img src="{{ asset('storage/' . $item->fotos->first()->foto_path) }}" alt="{{ $item->judul }}" loading="lazy">
                                @else
                                    <div class="report-thumbnail-placeholder">
                                        <svg width="28" height="28" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="report-details">
                                <div class="report-top">
                                    <h6 class="report-title">{{ Str::limit($item->judul, 55) }}</h6>
                                    <span class="report-badge badge-{{ $item->status }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </div>
                                <p class="report-text">{{ Str::limit($item->isi, 90) }}</p>
                                <div class="report-footer">
                                    <div class="report-meta">
                                        <span class="meta-user">
                                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                            </svg>
                                            {{ $item->user->name ?? 'Anonim' }}
                                        </span>
                                        <span class="meta-time">
                                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/><path d="M12.5 7H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                                            </svg>
                                            {{ $item->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <a href="{{ route('admin.laporan.show', $item->id) }}" class="report-link">
                                        Detail
                                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-reports">
                            <svg width="64" height="64" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                            </svg>
                            <p>Belum ada laporan</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>

<style>
/* ========================================
   GLOBAL RESET & BASE
======================================== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.admin-dashboard {
    padding: 2rem;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
}

/* ========================================
   HERO SECTION
======================================== */
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    padding: 2.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 40px rgba(102, 126, 234, 0.25);
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    border-radius: 50%;
}

.hero-content {
    position: relative;
    z-index: 1;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 0.5rem 1rem;
    border-radius: 50px;
    color: white;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.hero-title {
    font-size: 2rem;
    font-weight: 800;
    color: white;
    margin-bottom: 0.5rem;
    letter-spacing: -0.5px;
}

.hero-subtitle {
    color: rgba(255, 255, 255, 0.95);
    font-size: 1rem;
    line-height: 1.6;
}

.hero-subtitle strong {
    font-weight: 700;
}

.hero-date {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    padding: 0.875rem 1.5rem;
    border-radius: 50px;
    color: white;
    font-size: 0.9rem;
    font-weight: 600;
    white-space: nowrap;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* ========================================
   STATS GRID
======================================== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 1.75rem;
    display: flex;
    align-items: center;
    gap: 1.25rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--stat-color-1), var(--stat-color-2));
}

.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
}

.stat-primary {
    --stat-color-1: #667eea;
    --stat-color-2: #764ba2;
}

.stat-warning {
    --stat-color-1: #f093fb;
    --stat-color-2: #f5576c;
}

.stat-info {
    --stat-color-1: #4facfe;
    --stat-color-2: #00f2fe;
}

.stat-success {
    --stat-color-1: #43e97b;
    --stat-color-2: #38f9d7;
}

.stat-danger {
    --stat-color-1: #fa709a;
    --stat-color-2: #fee140;
}

.stat-icon-wrapper {
    position: relative;
    flex-shrink: 0;
}

.stat-icon {
    width: 64px;
    height: 64px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--stat-color-1), var(--stat-color-2));
    color: white;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.stat-pulse {
    position: absolute;
    top: 0;
    right: 0;
    width: 12px;
    height: 12px;
    background: #f5576c;
    border-radius: 50%;
    border: 2px solid white;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.2);
        opacity: 0.7;
    }
}

.stat-details {
    flex: 1;
}

.stat-value {
    font-size: 2rem;
    font-weight: 800;
    color: #1a1a2e;
    line-height: 1;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 0.875rem;
    color: #6c757d;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    padding: 0.35rem 0.75rem;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge-warning {
    background: linear-gradient(135deg, #f093fb, #f5576c);
    color: white;
    box-shadow: 0 4px 12px rgba(245, 87, 108, 0.3);
}

.stat-trend {
    position: absolute;
    bottom: 1rem;
    right: 1rem;
}

.trend-indicator {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.25rem 0.5rem;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 600;
}

.trend-indicator.positive {
    background: rgba(67, 233, 123, 0.15);
    color: #43e97b;
}

/* ========================================
   PERIOD CARD
======================================== */
.period-card {
    background: white;
    border-radius: 16px;
    padding: 1.75rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.period-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    color: #667eea;
}

.period-header h6 {
    font-size: 1rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin: 0;
}

.period-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1.25rem;
}

.period-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 12px;
    transition: all 0.3s ease;
}

.period-item:hover {
    background: linear-gradient(135deg, #e9ecef, #dee2e6);
    transform: translateY(-4px);
}

.period-icon {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    flex-shrink: 0;
}

.period-content {
    flex: 1;
}

.period-value {
    font-size: 1.75rem;
    font-weight: 800;
    color: #1a1a2e;
    line-height: 1;
    margin-bottom: 0.25rem;
}

.period-label {
    font-size: 0.8rem;
    color: #6c757d;
    font-weight: 600;
}

/* ========================================
   MAIN GRID LAYOUT
======================================== */
.main-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
}

/* ========================================
   CHART SECTION
======================================== */
.chart-section {
    grid-column: 1 / -1;
}

.chart-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.chart-header {
    padding: 1.75rem 2rem;
    border-bottom: 2px solid #f1f3f5;
}

.chart-title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: #667eea;
}

.chart-title h5 {
    font-size: 1.125rem;
    font-weight: 700;
    margin: 0;
}

.chart-body {
    padding: 2rem;
}

.chart-body canvas {
    max-height: 350px !important;
}

/* ========================================
   SIDEBAR SECTION
======================================== */
.sidebar-section {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

/* Quick Actions */
.quick-actions-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.quick-actions-header {
    padding: 1.5rem;
    border-bottom: 2px solid #f1f3f5;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: #667eea;
}

.quick-actions-header h6 {
    font-size: 1rem;
    font-weight: 700;
    margin: 0;
}

.quick-actions-body {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.action-button {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.25rem;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    position: relative;
}

.action-button .action-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.action-button span {
    flex: 1;
}

.action-button .arrow {
    opacity: 0;
    transform: translateX(-10px);
    transition: all 0.3s ease;
}

.action-button:hover .arrow {
    opacity: 1;
    transform: translateX(0);
}

.action-primary {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}

.action-primary .action-icon {
    background: rgba(255, 255, 255, 0.2);
}

.action-primary:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.35);
    color: white;
}

.action-warning {
    background: linear-gradient(135deg, #f093fb, #f5576c);
    color: white;
}

.action-warning .action-icon {
    background: rgba(255, 255, 255, 0.2);
}

.action-warning:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(245, 87, 108, 0.35);
    color: white;
}

.action-outline {
    background: white;
    border: 2px solid #667eea;
    color: #667eea;
}

.action-outline .action-icon {
    background: rgba(102, 126, 234, 0.1);
    color: #667eea;
}

.action-outline:hover {
    background: #667eea;
    color: white;
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.25);
}

.action-outline:hover .action-icon {
    background: rgba(255, 255, 255, 0.2);
    color: white;
}

.action-notification {
    background: rgba(255, 255, 255, 0.3);
    padding: 0.35rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 700;
}

/* Progress Card */
.progress-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.progress-header {
    padding: 1.5rem;
    border-bottom: 2px solid #f1f3f5;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: #667eea;
}

.progress-header h6 {
    font-size: 1rem;
    font-weight: 700;
    margin: 0;
}

.progress-body {
    padding: 1.5rem;
}

.progress-item {
    margin-bottom: 1.75rem;
}

.progress-item:last-child {
    margin-bottom: 0;
}

.progress-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.75rem;
}

.progress-label {
    font-size: 0.9rem;
    font-weight: 700;
    color: #495057;
}

.progress-percent {
    font-size: 0.9rem;
    font-weight: 800;
    color: #667eea;
}

.progress-bar-container {
    height: 10px;
    background: #f1f3f5;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 0.5rem;
}

.progress-bar {
    height: 100%;
    border-radius: 10px;
    transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.progress-warning {
    background: linear-gradient(90deg, #f093fb, #f5576c);
}

.progress-info {
    background: linear-gradient(90deg, #4facfe, #00f2fe);
}

.progress-success {
    background: linear-gradient(90deg, #43e97b, #38f9d7);
}

.progress-danger {
    background: linear-gradient(90deg, #fa709a, #fee140);
}

.progress-count {
    font-size: 0.8rem;
    color: #868e96;
    font-weight: 500;
}

/* ========================================
   REPORTS SECTION
======================================== */
.reports-section {
    grid-column: 1 / -1;
}

.reports-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.reports-header {
    padding: 1.75rem 2rem;
    border-bottom: 2px solid #f1f3f5;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.reports-title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: #667eea;
}

.reports-title h5 {
    font-size: 1.125rem;
    font-weight: 700;
    margin: 0;
}

.view-all-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.view-all-link:hover {
    color: #764ba2;
    gap: 0.75rem;
}

.reports-body {
    padding: 0;
}

.report-item {
    display: flex;
    gap: 1.25rem;
    padding: 1.75rem 2rem;
    border-bottom: 1px solid #f1f3f5;
    transition: all 0.3s ease;
}

.report-item:last-child {
    border-bottom: none;
}

.report-item:hover {
    background: #f8f9fa;
}

.report-thumbnail {
    width: 90px;
    height: 90px;
    border-radius: 12px;
    overflow: hidden;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.report-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.report-thumbnail-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #e9ecef, #dee2e6);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #adb5bd;
}

.report-details {
    flex: 1;
    min-width: 0;
}

.report-top {
    display: flex;
    justify-content: space-between;
    align-items: start;
    gap: 1rem;
    margin-bottom: 0.75rem;
}

.report-title {
    font-size: 1rem;
    font-weight: 700;
    color: #1a1a2e;
    margin: 0;
    line-height: 1.4;
}

.report-badge {
    padding: 0.35rem 0.875rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    white-space: nowrap;
    flex-shrink: 0;
}

.badge-menunggu {
    background: linear-gradient(135deg, #f093fb, #f5576c);
    color: white;
}

.badge-diproses {
    background: linear-gradient(135deg, #4facfe, #00f2fe);
    color: white;
}

.badge-selesai {
    background: linear-gradient(135deg, #43e97b, #38f9d7);
    color: white;
}

.badge-ditolak {
    background: linear-gradient(135deg, #fa709a, #fee140);
    color: white;
}

.report-text {
    font-size: 0.9rem;
    color: #6c757d;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.report-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}

.report-meta {
    display: flex;
    gap: 1.25rem;
    flex-wrap: wrap;
}

.meta-user,
.meta-time {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.8rem;
    color: #868e96;
    font-weight: 500;
}

.report-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1.25rem;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.85rem;
    transition: all 0.3s ease;
}

.report-link:hover {
    transform: translateX(4px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.35);
    color: white;
}

.empty-reports {
    padding: 4rem 2rem;
    text-align: center;
}

.empty-reports svg {
    color: #dee2e6;
    margin-bottom: 1rem;
}

.empty-reports p {
    color: #6c757d;
    font-size: 1rem;
    font-weight: 500;
    margin: 0;
}

/* ========================================
   RESPONSIVE DESIGN
======================================== */
@media (min-width: 992px) {
    .main-grid {
        grid-template-columns: 1fr 380px;
    }
    
    .chart-section {
        grid-column: 1;
    }
    
    .reports-section {
        grid-column: 1;
    }
    
    .sidebar-section {
        grid-column: 2;
        grid-row: 1 / 3;
    }
}

@media (max-width: 991px) {
    .hero-content {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .hero-date {
        align-self: stretch;
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .admin-dashboard {
        padding: 1rem;
    }
    
    .hero-section {
        padding: 1.75rem;
    }
    
    .hero-title {
        font-size: 1.5rem;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    
    .stat-card {
        padding: 1.25rem;
        flex-direction: column;
        text-align: center;
    }
    
    .stat-icon {
        width: 56px;
        height: 56px;
    }
    
    .stat-value {
        font-size: 1.75rem;
    }
    
    .period-grid {
        grid-template-columns: 1fr;
    }
    
    .chart-body {
        padding: 1.5rem;
    }
    
    .report-item {
        flex-direction: column;
        padding: 1.5rem;
    }
    
    .report-thumbnail {
        width: 100%;
        height: 160px;
    }
    
    .report-footer {
        flex-direction: column;
        align-items: stretch;
    }
    
    .report-link {
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .stat-badge {
        position: static;
        display: inline-block;
        margin-top: 0.5rem;
    }
    
    .hero-badge {
        font-size: 0.75rem;
    }
    
    .hero-subtitle {
        font-size: 0.9rem;
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
        
        const monthlyData = {
            labels: @json($monthlyChartData['labels']),
            datasets: [
                {
                    label: 'Menunggu',
                    data: @json($monthlyChartData['menunggu']),
                    backgroundColor: 'rgba(240, 147, 251, 0.85)',
                    borderColor: 'rgba(240, 147, 251, 1)',
                    borderWidth: 2,
                    borderRadius: 10,
                    borderSkipped: false,
                },
                {
                    label: 'Diproses',
                    data: @json($monthlyChartData['diproses']),
                    backgroundColor: 'rgba(79, 172, 254, 0.85)',
                    borderColor: 'rgba(79, 172, 254, 1)',
                    borderWidth: 2,
                    borderRadius: 10,
                    borderSkipped: false,
                },
                {
                    label: 'Selesai',
                    data: @json($monthlyChartData['selesai']),
                    backgroundColor: 'rgba(67, 233, 123, 0.85)',
                    borderColor: 'rgba(67, 233, 123, 1)',
                    borderWidth: 2,
                    borderRadius: 10,
                    borderSkipped: false,
                },
                {
                    label: 'Ditolak',
                    data: @json($monthlyChartData['ditolak']),
                    backgroundColor: 'rgba(250, 112, 154, 0.85)',
                    borderColor: 'rgba(250, 112, 154, 1)',
                    borderWidth: 2,
                    borderRadius: 10,
                    borderSkipped: false,
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
                        align: 'end',
                        labels: {
                            padding: 20,
                            font: {
                                size: 13,
                                weight: '600',
                                family: "'Inter', sans-serif"
                            },
                            usePointStyle: true,
                            pointStyle: 'circle',
                            boxWidth: 8,
                            boxHeight: 8,
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(26, 26, 46, 0.95)',
                        padding: 14,
                        cornerRadius: 10,
                        titleFont: {
                            size: 14,
                            weight: '700'
                        },
                        bodyFont: {
                            size: 13
                        },
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.dataset.label + ': ' + context.parsed.y + ' laporan';
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
                                size: 12,
                                weight: '600'
                            },
                            color: '#6c757d'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.04)',
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 12,
                                weight: '500'
                            },
                            color: '#6c757d',
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
});
</script>

@endsection