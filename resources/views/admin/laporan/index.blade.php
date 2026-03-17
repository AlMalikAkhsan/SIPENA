@extends('layouts.app')

@section('content')
<div class="admin-laporan">
    
    <!-- Hero Header -->
    <div class="hero-header">
        <div class="hero-content">
            <div class="hero-text">
                <div class="hero-badge">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                    </svg>
                    Manajemen Laporan
                </div>
                <h1 class="hero-title">Data Laporan Warga</h1>
                <p class="hero-subtitle">Kelola, verifikasi, dan pantau semua laporan dari warga RW 05</p>
            </div>
            <div class="hero-actions">
                <a href="{{ route('admin.laporan.export.pdf', request()->query()) }}" class="btn-export">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 12v7H5v-7H3v7c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-7h-2zm-6 .67l2.59-2.58L17 11.5l-5 5-5-5 1.41-1.41L11 12.67V3h2z"/>
                    </svg>
                    Export PDF
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="stats-overview">
        <div class="stat-box stat-primary">
            <div class="stat-icon-wrap">
                <div class="stat-icon">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                    </svg>
                </div>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $laporan->total() }}</div>
                <div class="stat-label">Total Laporan</div>
            </div>
        </div>

        <div class="stat-box stat-warning">
            <div class="stat-icon-wrap">
                <div class="stat-icon">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                    </svg>
                </div>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ \App\Models\Laporan::where('status', 'menunggu')->count() }}</div>
                <div class="stat-label">Menunggu</div>
            </div>
        </div>

        <div class="stat-box stat-info">
            <div class="stat-icon-wrap">
                <div class="stat-icon">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19.43 12.98c.04-.32.07-.64.07-.98s-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.3-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.23-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98s.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.23.09.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zM12 15.5c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5z"/>
                    </svg>
                </div>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ \App\Models\Laporan::where('status', 'diproses')->count() }}</div>
                <div class="stat-label">Diproses</div>
            </div>
        </div>

        <div class="stat-box stat-success">
            <div class="stat-icon-wrap">
                <div class="stat-icon">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ \App\Models\Laporan::where('status', 'selesai')->count() }}</div>
                <div class="stat-label">Selesai</div>
            </div>
        </div>
        <div class="stat-box stat-danger">
            <div class="stat-icon-wrap">
                <div class="stat-icon">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 13.59L15.59 17 12 13.41 8.41 17 7 15.59l3.59-3.59L7 8.41 8.41 7l3.59 3.59L15.59 7 17 8.41l-3.59 3.59L17 15.59z"/>
                    </svg>
                </div>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ \App\Models\Laporan::where('status', 'ditolak')->count() }}</div>
                <div class="stat-label">Ditolak</div>
            </div>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="filter-section">
        <div class="filter-header">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                <path d="M10 18h4v-2h-4v2zM3 6v2h18V6H3zm3 7h12v-2H6v2z"/>
            </svg>
            <h6>Filter & Pencarian</h6>
        </div>
        <form method="GET" action="{{ route('admin.laporan.index') }}">
            <div class="filter-grid">
                <!-- Search -->
                <div class="filter-group">
                    <label class="filter-label">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                        </svg>
                        Pencarian
                    </label>
                    <div class="search-wrapper">
                        <input type="text" 
                               name="search" 
                               class="filter-input" 
                               placeholder="Cari judul, isi, atau nama warga..." 
                               value="{{ request('search') }}">
                    </div>
                </div>
                
                <!-- Status Filter -->
                <div class="filter-group">
                    <label class="filter-label">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3.5 18.49l6-6.01 4 4L22 6.92l-1.41-1.41-7.09 7.97-4-4L2 16.99z"/>
                        </svg>
                        Status
                    </label>
                    <select name="status" class="filter-select">
                        <option value="">Semua Status</option>
                        <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <!-- Sort -->
                <div class="filter-group">
                    <label class="filter-label">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 18h6v-2H3v2zM3 6v2h18V6H3zm0 7h12v-2H3v2z"/>
                        </svg>
                        Urutkan
                    </label>
                    <select name="sort" class="filter-select">
                        <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </div>
                
                <!-- Actions -->
                <div class="filter-group">
                    <label class="filter-label">&nbsp;</label>
                    <div class="filter-buttons">
                        <button type="submit" class="btn-apply">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M10 18h4v-2h-4v2zM3 6v2h18V6H3zm3 7h12v-2H6v2z"/>
                            </svg>
                            Terapkan
                        </button>
                        @if(request('search') || request('status') || request('sort'))
                        <a href="{{ route('admin.laporan.index') }}" class="btn-clear" title="Reset Filter">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 5V1L7 6l5 5V7c3.31 0 6 2.69 6 6s-2.69 6-6 6-6-2.69-6-6H4c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8z"/>
                            </svg>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Data Table -->
    <div class="data-section">
        <div class="data-header">
            <div class="data-title">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                </svg>
                <h5>Daftar Laporan</h5>
            </div>
            <div class="data-count">
                <span class="count-badge">{{ $laporan->total() }}</span>
                <span class="count-text">Total Laporan</span>
            </div>
        </div>

        <div class="data-body">
            @forelse($laporan as $item)
                <div class="report-card">
                    <div class="report-number">
                        <span>{{ $laporan->firstItem() + $loop->index }}</span>
                    </div>

                    <div class="report-thumbnail">
                        @if($item->fotos && $item->fotos->count() > 0)
                            <img src="{{ asset('storage/' . $item->fotos->first()->foto_path) }}" 
                                 alt="{{ $item->judul }}"
                                 loading="lazy">
                        @else
                            <div class="report-thumbnail-empty">
                                <svg width="32" height="32" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="report-details">
                        <div class="report-top">
                            <h6 class="report-title">{{ Str::limit($item->judul, 65) }}</h6>
                            <span class="report-badge badge-{{ $item->status }}">
                                <span class="badge-dot"></span>
                                {{ ucfirst($item->status) }}
                            </span>
                        </div>
                        
                        <p class="report-text">{{ Str::limit($item->isi, 110) }}</p>
                        
                        <div class="report-meta">
                            <span class="meta-user">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                                {{ $item->user->name ?? 'Anonim' }}
                            </span>
                            <span class="meta-time">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/><path d="M12.5 7H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                                </svg>
                                {{ $item->created_at->format('d M Y, H:i') }}
                            </span>
                        </div>
                    </div>

                    <div class="report-actions">
                        <a href="{{ route('admin.laporan.show', $item->id) }}" class="action-btn action-view">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                            </svg>
                            Detail
                        </a>
                        
                        @if($item->status == 'menunggu')
                        <button type="button" 
                                class="action-btn action-process"
                                data-bs-toggle="modal" 
                                data-bs-target="#updateStatusModal{{ $item->id }}">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.43 12.98c.04-.32.07-.64.07-.98s-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.3-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.23-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98s.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.23.09.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zM12 15.5c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5z"/>
                            </svg>
                            Proses
                        </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-data">
                    <svg width="96" height="96" fill="currentColor" viewBox="0 0 24 24" class="empty-icon">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
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
                            Tidak ada laporan yang sesuai dengan filter Anda. Silakan ubah kriteria pencarian.
                        @else
                            Belum ada laporan yang masuk dari warga. Data akan muncul di sini setelah ada laporan baru.
                        @endif
                    </p>
                    @if(request('search') || request('status'))
                    <a href="{{ route('admin.laporan.index') }}" class="btn-reset-all">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 5V1L7 6l5 5V7c3.31 0 6 2.69 6 6s-2.69 6-6 6-6-2.69-6-6H4c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8z"/>
                        </svg>
                        Reset Semua Filter
                    </a>
                    @endif
                </div>
            @endforelse
        </div>

        @if($laporan->hasPages())
            <div class="data-footer">
                <div class="footer-info">
                    <span>Menampilkan {{ $laporan->firstItem() }} - {{ $laporan->lastItem() }} dari {{ $laporan->total() }} laporan</span>
                </div>
                <div class="footer-pagination">
                    {{ $laporan->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>

</div>

<!-- Update Status Modals -->
@foreach($laporan as $item)
    @if($item->status == 'menunggu')
        <div class="modal fade" id="updateStatusModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content status-modal">
                    <div class="modal-header-gradient">
                        <div class="modal-icon-bg">
                            <svg width="28" height="28" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.43 12.98c.04-.32.07-.64.07-.98s-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.3-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.23-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98s.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.23.09.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zM12 15.5c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5z"/>
                            </svg>
                        </div>
                        <div class="modal-title-wrap">
                            <h5 class="modal-title-gradient">Update Status Laporan</h5>
                            <p class="modal-subtitle-gradient">Ubah status laporan untuk melanjutkan proses</p>
                        </div>
                        <button type="button" class="btn-modal-close" data-bs-dismiss="modal">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="modal-body-gradient">
                        <div class="info-card">
                            <div class="info-item">
                                <span class="info-label">Judul Laporan</span>
                                <span class="info-value">{{ $item->judul }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Pelapor</span>
                                <span class="info-value">{{ $item->user->name ?? 'Anonim' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Tanggal</span>
                                <span class="info-value">{{ $item->created_at->format('d M Y, H:i') }} WIB</span>
                            </div>
                        </div>

                        <form action="{{ route('admin.laporan.status', $item->id) }}" method="POST">
                            @csrf
                            <div class="form-group-gradient">
                                <label class="form-label-gradient">
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M3.5 18.49l6-6.01 4 4L22 6.92l-1.41-1.41-7.09 7.97-4-4L2 16.99z"/>
                                    </svg>
                                    Pilih Status Baru
                                </label>
                                <select name="status" class="form-select-gradient" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="diproses">⚙️ Diproses</option>
                                    <option value="selesai">✅ Selesai</option>
                                    <option value="ditolak">❌ Ditolak</option>
                                </select>
                            </div>

                            <div class="alert-gradient">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                                </svg>
                                <div>
                                    <strong>Perhatian:</strong> Warga akan mendapatkan notifikasi otomatis tentang perubahan status laporan ini.
                                </div>
                            </div>

                            <div class="modal-footer-gradient">
                                <button type="button" class="btn-cancel-gradient" data-bs-dismiss="modal">
                                    Batal
                                </button>
                                <button type="submit" class="btn-submit-gradient">
                                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
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
/* ========================================
   BASE & CONTAINER
======================================== */
.admin-laporan {
    padding: 2rem;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
}

/* ========================================
   HERO HEADER
======================================== */
.hero-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    padding: 2.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 40px rgba(102, 126, 234, 0.25);
    position: relative;
    overflow: hidden;
}

.hero-header::before {
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
    margin: 0;
}

.btn-export {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 1.75rem;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    color: white;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.btn-export:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    color: white;
}

/* ========================================
   STATS OVERVIEW
======================================== */
.stats-overview {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-box {
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

.stat-box::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--stat-color-1), var(--stat-color-2));
}

.stat-box:hover {
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
    --stat-color-1: #f85032;
    --stat-color-2: #e73827;
}

.stat-icon-wrap {
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

.stat-info {
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

/* ========================================
   FILTER SECTION
======================================== */
.filter-section {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.filter-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    color: #667eea;
}

.filter-header h6 {
    font-size: 1rem;
    font-weight: 700;
    margin: 0;
}

.filter-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.25rem;
}

.filter-group {
    display: flex;
    flex-direction: column;
}

.filter-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.75rem;
}

.search-wrapper {
    position: relative;
}

.filter-input,
.filter-select {
    width: 100%;
    padding: 0.875rem 1.125rem;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    font-size: 0.9rem;
    background: white;
    transition: all 0.3s ease;
}

.filter-input:focus,
.filter-select:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
}

.filter-input::placeholder {
    color: #adb5bd;
}

.filter-select {
    cursor: pointer;
}

.filter-buttons {
    display: flex;
    gap: 0.75rem;
}

.btn-apply {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    padding: 0.875rem 1.5rem;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-apply:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.35);
}

.btn-clear {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    color: #6c757d;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-clear:hover {
    background: #667eea;
    border-color: #667eea;
    color: white;
    transform: translateY(-4px);
}

/* ========================================
   DATA SECTION
======================================== */
.data-section {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.data-header {
    padding: 2rem;
    border-bottom: 2px solid #f1f3f5;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.data-title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: #667eea;
}

.data-title h5 {
    font-size: 1.125rem;
    font-weight: 700;
    margin: 0;
}

.data-count {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.count-badge {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 700;
}

.count-text {
    font-size: 0.875rem;
    color: #6c757d;
    font-weight: 500;
}

.data-body {
    padding: 0;
}

/* ========================================
   REPORT CARDS
======================================== */
.report-card {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    padding: 1.75rem 2rem;
    border-bottom: 1px solid #f1f3f5;
    transition: all 0.3s ease;
}

.report-card:last-child {
    border-bottom: none;
}

.report-card:hover {
    background: #f8f9fa;
}

.report-number {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: linear-gradient(135deg, #e9ecef, #dee2e6);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    color: #495057;
    font-size: 1rem;
    flex-shrink: 0;
}

.report-thumbnail {
    width: 90px;
    height: 90px;
    border-radius: 14px;
    overflow: hidden;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.report-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.report-thumbnail-empty {
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
    padding: 0.4rem 1rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    white-space: nowrap;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.badge-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: currentColor;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
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

.report-meta {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.meta-user,
.meta-time {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.85rem;
    color: #868e96;
    font-weight: 500;
}

.report-actions {
    display: flex;
    gap: 0.75rem;
    flex-shrink: 0;
}

.action-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.25rem;
    border-radius: 10px;
    font-size: 0.875rem;
    font-weight: 600;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.action-view {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}

.action-view:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.35);
    color: white;
}

.action-process {
    background: linear-gradient(135deg, #43e97b, #38f9d7);
    color: white;
}

.action-process:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(67, 233, 123, 0.35);
}

/* ========================================
   EMPTY STATE
======================================== */
.empty-data {
    text-align: center;
    padding: 5rem 2rem;
}

.empty-icon {
    color: #dee2e6;
    margin-bottom: 2rem;
}

.empty-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #495057;
    margin-bottom: 1rem;
}

.empty-text {
    font-size: 1rem;
    color: #6c757d;
    margin-bottom: 2rem;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
}

.btn-reset-all {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 2rem;
    background: linear-gradient(135deg, #667eea);
    color: white;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-reset-all:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.35);
    color: white;
}

/* ========================================
   DATA FOOTER
======================================== */
.data-footer {
    padding: 1.75rem 2rem;
    border-top: 2px solid #f1f3f5;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1.5rem;
}

.footer-info {
    font-size: 0.9rem;
    color: #6c757d;
    font-weight: 500;
}

/* ========================================
   MODAL GRADIENT
======================================== */
.status-modal {
    border: none;
    border-radius: 20px;
    overflow: hidden;
}

.modal-header-gradient {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 2rem;
    display: flex;
    align-items: start;
    gap: 1.25rem;
    position: relative;
}

.modal-icon-bg {
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.modal-title-wrap {
    flex: 1;
}

.modal-title-gradient {
    font-size: 1.25rem;
    font-weight: 800;
    margin: 0;
}

.modal-subtitle-gradient {
    font-size: 0.9rem;
    opacity: 0.95;
    margin: 0.5rem 0 0 0;
}

.btn-modal-close {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border: none;
    border-radius: 10px;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.btn-modal-close:hover {
    background: rgba(255, 255, 255, 0.3);
}

.modal-body-gradient {
    padding: 2rem;
}

.info-card {
    background: #f8f9fa;
    border-radius: 14px;
    padding: 1.5rem;
    margin-bottom: 1.75rem;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: start;
    gap: 1rem;
    padding: 0.75rem 0;
}

.info-item:not(:last-child) {
    border-bottom: 1px solid #e9ecef;
}

.info-label {
    font-size: 0.875rem;
    color: #6c757d;
    font-weight: 600;
}

.info-value {
    font-size: 0.875rem;
    color: #1a1a2e;
    font-weight: 700;
    text-align: right;
}

.form-group-gradient {
    margin-bottom: 1.75rem;
}

.form-label-gradient {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.95rem;
    font-weight: 700;
    color: #495057;
    margin-bottom: 0.75rem;
}

.form-select-gradient {
    width: 100%;
    padding: 1rem 1.25rem;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    font-size: 0.95rem;
    background: white;
    cursor: pointer;
    transition: all 0.3s ease;
}

.form-select-gradient:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
}

.alert-gradient {
    display: flex;
    gap: 1rem;
    padding: 1.25rem;
    background: rgba(102, 126, 234, 0.1);
    border-left: 4px solid #667eea;
    border-radius: 10px;
    margin-bottom: 1.75rem;
}

.alert-gradient svg {
    color: #667eea;
    flex-shrink: 0;
}

.alert-gradient div {
    font-size: 0.9rem;
    color: #495057;
    line-height: 1.6;
}

.modal-footer-gradient {
    display: flex;
    gap: 1rem;
}

.btn-cancel-gradient {
    flex: 1;
    padding: 1rem 1.75rem;
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    color: #495057;
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-cancel-gradient:hover {
    background: #e9ecef;
}

.btn-submit-gradient {
    flex: 1;
    padding: 1rem 1.75rem;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border: none;
    border-radius: 12px;
    color: white;
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    transition: all 0.3s ease;
}

.btn-submit-gradient:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.35);
}

/* ========================================
   RESPONSIVE
======================================== */
@media (max-width: 991px) {
    .hero-content {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .hero-actions {
        align-self: stretch;
    }
    
    .btn-export {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .admin-laporan {
        padding: 1rem;
    }
    
    .hero-header {
        padding: 1.75rem;
    }
    
    .hero-title {
        font-size: 1.5rem;
    }
    
    .stats-overview {
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    
    .stat-box {
        padding: 1.25rem;
        flex-direction: column;
        text-align: center;
    }
    
    .filter-grid {
        grid-template-columns: 1fr;
    }
    
    .report-card {
        flex-direction: column;
        align-items: stretch;
        padding: 1.5rem;
    }
    
    .report-number {
        align-self: flex-start;
    }
    
    .report-thumbnail {
        width: 100%;
        height: 180px;
    }
    
    .report-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .action-btn {
        justify-content: center;
    }
    
    .data-footer {
        flex-direction: column;
        align-items: stretch;
    }
    
    .footer-pagination {
        display: flex;
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .stats-overview {
        grid-template-columns: 1fr;
    }
    
    .filter-buttons {
        flex-direction: column;
    }
    
    .btn-clear {
        width: 100%;
        height: 48px;
    }
    
    .data-count {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>
@endsection