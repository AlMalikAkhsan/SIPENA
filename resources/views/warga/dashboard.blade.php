@extends('layouts.app')

@section('content')
<div class="warga-dashboard">
    
    {{-- Hero Header --}}
    <div class="hero-section">
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">Dashboard Warga</h1>
                <p class="hero-subtitle">
                    Selamat datang, <strong>{{ Auth::user()->name }}</strong>! 
                    <span>Kelola dan pantau laporan Anda dengan mudah</span>
                </p>
            </div>
            <div class="hero-action">
                <a href="{{ route('warga.laporan.create') }}" class="btn-create">
                    <svg width="20" height="20" fill="currentColor">
                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                    </svg>
                    <span>Buat Laporan</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="stats-section">
        <div class="stats-grid">
            {{-- Total Laporan --}}
            <div class="stat-card stat-primary">
                <div class="stat-icon">
                    <svg width="24" height="24" fill="currentColor">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z"/>
                        <path d="M7 10h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <span class="stat-label">Total Laporan</span>
                    <h3 class="stat-value">{{ $total }}</h3>
                </div>
            </div>

            {{-- Menunggu --}}
            <div class="stat-card stat-warning">
                <div class="stat-icon">
                    <svg width="24" height="24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.5-13H11v6l5.2 3.2.8-1.3-4.5-2.7V7z"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <span class="stat-label">Menunggu</span>
                    <h3 class="stat-value">{{ $menunggu }}</h3>
                </div>
            </div>

            {{-- Diproses --}}
            <div class="stat-card stat-info">
                <div class="stat-icon">
                    <svg width="24" height="24" fill="currentColor">
                        <path d="M19.43 12.98c.04-.32.07-.64.07-.98s-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.3-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.23-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98s.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.23.09.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zM12 15.5c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5z"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <span class="stat-label">Diproses</span>
                    <h3 class="stat-value">{{ $diproses }}</h3>
                </div>
            </div>

            {{-- Selesai --}}
            <div class="stat-card stat-success">
                <div class="stat-icon">
                    <svg width="24" height="24" fill="currentColor">
                        <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <span class="stat-label">Selesai</span>
                    <h3 class="stat-value">{{ $selesai }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Reports Section --}}
    <div class="reports-section">
        <div class="section-header">
            <h2 class="section-title">
                <svg width="20" height="20" fill="currentColor" class="me-2">
                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z"/>
                </svg>
                Laporan Terbaru
            </h2>
            <a href="{{ route('warga.laporan.index') }}" class="btn-view-all">
                Lihat Semua
                <svg width="16" height="16" fill="currentColor" class="ms-1">
                    <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                </svg>
            </a>
        </div>

        <div class="reports-grid">
            @forelse($latest as $item)
                <div class="report-card">
                    {{-- Report Image --}}
                    @if($item->foto)
                        <div class="report-image">
                            <img 
                                src="{{ asset('uploads/'.$item->foto) }}" 
                                alt="{{ $item->judul }}"
                            >
                            <div class="image-overlay">
                                <span class="status-badge status-{{ $item->status }}">
                                    @if($item->status == 'menunggu')
                                        <svg width="12" height="12" fill="currentColor">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                                        </svg>
                                    @elseif($item->status == 'diproses')
                                        <svg width="12" height="12" fill="currentColor">
                                            <path d="M19.43 12.98c.04-.32.07-.64.07-.98s-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.3-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.23-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98s.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.23.09.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65z"/>
                                        </svg>
                                    @else
                                        <svg width="12" height="12" fill="currentColor">
                                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/>
                                        </svg>
                                    @endif
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>
                        </div>
                    @else
                        <div class="report-image-placeholder">
                            <svg width="40" height="40" fill="currentColor">
                                <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                            </svg>
                            <span class="status-badge status-{{ $item->status }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </div>
                    @endif

                    {{-- Report Content --}}
                    <div class="report-content">
                        <h3 class="report-title">{{ $item->judul }}</h3>
                        <p class="report-description">
                            {{ Str::limit($item->isi, 100) }}
                        </p>
                        
                        <div class="report-footer">
                            <span class="report-date">
                                <svg width="14" height="14" fill="currentColor">
                                    <path d="M9 11H7v2h2v-2zm4-8h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/>
                                </svg>
                                {{ $item->created_at->diffForHumans() }}
                            </span>
                            <a 
                                href="{{ route('warga.laporan.show', $item->id) }}" 
                                class="btn-detail"
                            >
                                Detail
                                <svg width="14" height="14" fill="currentColor">
                                    <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg width="64" height="64" fill="currentColor">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z"/>
                        </svg>
                    </div>
                    <h3>Belum Ada Laporan</h3>
                    <p>Buat laporan pertama Anda untuk melaporkan keluhan atau aspirasi</p>
                    <a href="{{ route('warga.laporan.create') }}" class="btn-empty-action">
                        <svg width="18" height="18" fill="currentColor">
                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                        </svg>
                        Buat Laporan Sekarang
                    </a>
                </div>
            @endforelse
        </div>
    </div>

</div>

<style>
:root {
    --primary-color: #E31E24;
    --secondary-color: #1a1a1a;
    --success-color: #00A651;
    --warning-color: #FFA500;
    --info-color: #0099FF;
    --gray-50: #F9FAFB;
    --gray-100: #F3F4F6;
    --gray-200: #E5E7EB;
    --gray-300: #D1D5DB;
    --gray-400: #9CA3AF;
    --gray-500: #6B7280;
    --gray-600: #4B5563;
    --gray-700: #374151;
    --gray-800: #1F2937;
    --gray-900: #111827;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.warga-dashboard {
    max-width: 1400px;
    margin: 0 auto;
    padding: 24px;
    background: var(--gray-50);
    min-height: 100vh;
}

/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, var(--primary-color) 0%, #c41a1f 100%);
    border-radius: 20px;
    padding: 32px;
    margin-bottom: 32px;
    box-shadow: 0 8px 24px rgba(227, 30, 36, 0.15);
}

.hero-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 24px;
    flex-wrap: wrap;
}

.hero-title {
    font-size: 32px;
    font-weight: 700;
    color: white;
    margin-bottom: 8px;
}

.hero-subtitle {
    font-size: 16px;
    color: rgba(255, 255, 255, 0.95);
    line-height: 1.6;
}

.hero-subtitle strong {
    font-weight: 600;
}

.hero-subtitle span {
    display: block;
    font-size: 14px;
    opacity: 0.9;
    margin-top: 4px;
}

.btn-create {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 28px;
    background: white;
    color: var(--primary-color);
    border-radius: 12px;
    text-decoration: none;
    font-size: 15px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.btn-create:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    color: var(--primary-color);
}

/* Stats Section */
.stats-section {
    margin-bottom: 32px;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 24px;
    display: flex;
    align-items: center;
    gap: 16px;
    transition: all 0.3s ease;
    border: 1px solid var(--gray-100);
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
    background: currentColor;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
}

.stat-primary { color: #667eea; }
.stat-warning { color: var(--warning-color); }
.stat-info { color: var(--info-color); }
.stat-success { color: var(--success-color); }

.stat-icon {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: currentColor;
    color: white;
    flex-shrink: 0;
}

.stat-info {
    flex: 1;
}

.stat-label {
    display: block;
    font-size: 13px;
    color: var(--gray-500);
    font-weight: 500;
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-value {
    font-size: 32px;
    font-weight: 700;
    color: var(--gray-900);
    line-height: 1;
}

/* Reports Section */
.reports-section {
    margin-bottom: 32px;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.section-title {
    font-size: 22px;
    font-weight: 700;
    color: var(--gray-900);
    display: flex;
    align-items: center;
}

.btn-view-all {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 10px 20px;
    background: white;
    color: var(--primary-color);
    border: 1.5px solid var(--gray-200);
    border-radius: 10px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.btn-view-all:hover {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

/* Reports Grid */
.reports-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 24px;
}

.report-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid var(--gray-100);
}

.report-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.1);
}

.report-image {
    position: relative;
    width: 100%;
    height: 200px;
    overflow: hidden;
    background: var(--gray-100);
}

.report-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.report-card:hover .report-image img {
    transform: scale(1.05);
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, transparent 50%);
    display: flex;
    padding: 16px;
}

.report-image-placeholder {
    width: 100%;
    height: 200px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--gray-100) 0%, var(--gray-200) 100%);
    color: var(--gray-400);
    gap: 12px;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    backdrop-filter: blur(10px);
}

.status-menunggu {
    background: rgba(255, 165, 0, 0.9);
    color: white;
}

.status-diproses {
    background: rgba(0, 153, 255, 0.9);
    color: white;
}

.status-selesai {
    background: rgba(0, 166, 81, 0.9);
    color: white;
}

.report-content {
    padding: 20px;
}

.report-title {
    font-size: 18px;
    font-weight: 600;
    color: var(--gray-900);
    margin-bottom: 10px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.report-description {
    font-size: 14px;
    color: var(--gray-600);
    line-height: 1.6;
    margin-bottom: 16px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.report-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 16px;
    border-top: 1px solid var(--gray-100);
}

.report-date {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: var(--gray-500);
}

.btn-detail {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    background: var(--primary-color);
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.btn-detail:hover {
    background: #c41a1f;
    transform: translateX(2px);
    color: white;
}

/* Empty State */
.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 20px;
    background: white;
    border-radius: 16px;
    border: 2px dashed var(--gray-200);
}

.empty-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 24px;
    background: var(--gray-100);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gray-400);
}

.empty-state h3 {
    font-size: 22px;
    font-weight: 700;
    color: var(--gray-900);
    margin-bottom: 8px;
}

.empty-state p {
    font-size: 15px;
    color: var(--gray-500);
    margin-bottom: 24px;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

.btn-empty-action {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 28px;
    background: var(--primary-color);
    color: white;
    border-radius: 12px;
    text-decoration: none;
    font-size: 15px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-empty-action:hover {
    background: #c41a1f;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(227, 30, 36, 0.2);
    color: white;
}

/* Responsive */
@media (max-width: 768px) {
    .warga-dashboard {
        padding: 16px;
    }

    .hero-section {
        padding: 24px;
    }

    .hero-title {
        font-size: 26px;
    }

    .hero-content {
        flex-direction: column;
        align-items: stretch;
    }

    .btn-create {
        width: 100%;
        justify-content: center;
    }

    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .stat-card {
        padding: 16px;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
    }

    .stat-value {
        font-size: 26px;
    }

    .reports-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .section-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

    .btn-view-all {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }

    .stat-label {
        font-size: 11px;
    }

    .stat-value {
        font-size: 24px;
    }
}
</style>
@endsection