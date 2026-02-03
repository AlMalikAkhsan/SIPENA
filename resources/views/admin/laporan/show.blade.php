@extends('layouts.app')

@section('content')
<div class="modern-detail-page">
    
    <!-- Top Bar with Back Button -->
    <div class="top-bar">
        <div class="container-modern">
            <a href="{{ route('admin.laporan.index') }}" class="btn-back-modern">
                <svg width="20" height="20" fill="currentColor">
                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                </svg>
                Kembali
            </a>
            
            <div class="top-bar-actions">
                @if($laporan->status != 'ditolak')
                    <button class="btn-icon-action" data-bs-toggle="modal" data-bs-target="#rejectModal" title="Tolak Laporan">
                        <svg width="20" height="20" fill="currentColor">
                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                        </svg>
                    </button>
                    <button class="btn-icon-action" onclick="window.print()" title="Print">
                        <svg width="20" height="20" fill="currentColor">
                            <path d="M19 8H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zm-3 11H8v-5h8v5zm3-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-1-9H6v4h12V3z"/>
                        </svg>
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="container-modern mt-4">
            <div class="alert-box alert-success-box">
                <div class="alert-icon-wrapper success">
                    <svg width="24" height="24" fill="currentColor">
                        <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/>
                    </svg>
                </div>
                <div class="alert-content-box">
                    <div class="alert-title-box">Berhasil!</div>
                    <div class="alert-message-box">{{ session('success') }}</div>
                </div>
                <button class="alert-close-btn" onclick="this.parentElement.remove()">
                    <svg width="20" height="20" fill="currentColor">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container-modern mt-4">
            <div class="alert-box alert-error-box">
                <div class="alert-icon-wrapper error">
                    <svg width="24" height="24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                    </svg>
                </div>
                <div class="alert-content-box">
                    <div class="alert-title-box">Terjadi Kesalahan!</div>
                    <div class="alert-message-box">{{ session('error') }}</div>
                </div>
                <button class="alert-close-btn" onclick="this.parentElement.remove()">
                    <svg width="20" height="20" fill="currentColor">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Main Content Grid -->
    <div class="container-modern">
        <div class="content-grid">
            
            <!-- Left Column - Main Content -->
            <div class="main-column">
                
                <!-- Report Header Card -->
                <div class="card-modern card-gradient">
                    <div class="report-header">
                        <div class="report-badge-group">
                            <span class="report-id">#{{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</span>
                            <span class="status-badge status-{{ $laporan->status }}">
                                <span class="status-indicator"></span>
                                {{ ucfirst($laporan->status) }}
                            </span>
                        </div>
                        <h1 class="report-title">{{ $laporan->judul }}</h1>
                        
                        <!-- User Card -->
                        <div class="user-card-inline">
                            <div class="user-avatar-large">
                                {{ substr($laporan->user->name ?? 'A', 0, 1) }}
                            </div>
                            <div class="user-info-inline">
                                <div class="user-name-large">{{ $laporan->user->name ?? 'Anonim' }}</div>
                                <div class="user-meta-inline">
                                    <span class="meta-icon-text">
                                        <svg width="14" height="14" fill="currentColor">
                                            <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                        </svg>
                                        {{ $laporan->user->email ?? '-' }}
                                    </span>
                                    <span class="meta-divider">•</span>
                                    <span class="meta-icon-text">
                                        <svg width="14" height="14" fill="currentColor">
                                            <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                                        </svg>
                                        {{ $laporan->created_at->format('d M Y, H:i') }}
                                    </span>
                                    <span class="meta-divider">•</span>
                                    <span class="meta-time-text">{{ $laporan->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Report Images Gallery (Compatible with laporan_fotos relation) -->
                @if($laporan->fotos && $laporan->fotos->count() > 0)
                    <div class="card-modern">
                        <!-- Photo Count Badge -->
                        <div class="gallery-header">
                            <div class="gallery-title">
                                <svg width="20" height="20" fill="currentColor">
                                    <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                                </svg>
                                <span>Dokumentasi Foto</span>
                            </div>
                            <span class="photo-count-badge">{{ $laporan->fotos->count() }} Foto</span>
                        </div>

                        @if($laporan->fotos->count() === 1)
                            <!-- Single Photo -->
                            <div class="image-container-modern">
                                <img src="{{ Storage::url($laporan->fotos->first()->foto_path) }}" 
                                    alt="{{ $laporan->judul }}"
                                    class="report-image-modern"
                                    onclick="openImageModal('{{ Storage::url($laporan->fotos->first()->foto_path) }}', 0)">
                                <div class="image-overlay-modern">
                                    <button class="btn-view-full" onclick="openImageModal('{{ Storage::url($laporan->fotos->first()->foto_path) }}', 0)">
                                        <svg width="24" height="24" fill="currentColor">
                                            <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                                        </svg>
                                        Lihat Foto Penuh
                                    </button>
                                </div>
                            </div>
                        @else
                            <!-- Multiple Photos - Carousel -->
                            <div class="gallery-carousel" id="photoCarousel">
                                <!-- Main Image Display -->
                                <div class="carousel-main-container">
                                    <button class="carousel-nav carousel-prev" onclick="changeSlide(-1)">
                                        <svg width="24" height="24" fill="currentColor">
                                            <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
                                        </svg>
                                    </button>

                                    <div class="carousel-main-image">
                                        @foreach($laporan->fotos as $index => $foto)
                                            <div class="carousel-slide {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}">
                                                <img src="{{ Storage::url($foto->foto_path) }}" 
                                                    alt="{{ $laporan->judul }} - Foto {{ $index + 1 }}"
                                                    class="carousel-image"
                                                    onclick="openImageModal('{{ Storage::url($foto->foto_path) }}', {{ $index }})">
                                                <div class="slide-overlay">
                                                    <button class="btn-view-full" onclick="openImageModal('{{ Storage::url($foto->foto_path) }}', {{ $index }})">
                                                        <svg width="24" height="24" fill="currentColor">
                                                            <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                                                        </svg>
                                                        Lihat Foto Penuh
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <button class="carousel-nav carousel-next" onclick="changeSlide(1)">
                                        <svg width="24" height="24" fill="currentColor">
                                            <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                                        </svg>
                                    </button>

                                    <!-- Slide Counter -->
                                    <div class="carousel-counter">
                                        <span id="currentSlide">1</span> / <span id="totalSlides">{{ $laporan->fotos->count() }}</span>
                                    </div>
                                </div>

                                <!-- Thumbnail Gallery -->
                                <div class="carousel-thumbnails">
                                    @foreach($laporan->fotos as $index => $foto)
                                        <div class="thumbnail-item {{ $index === 0 ? 'active' : '' }}" 
                                            onclick="goToSlide({{ $index }})"
                                            data-thumb="{{ $index }}">
                                            <img src="{{ Storage::url($foto->foto_path) }}" 
                                                alt="Thumbnail {{ $index + 1 }}">
                                            <div class="thumbnail-overlay">
                                                <span class="thumbnail-number">{{ $index + 1 }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @elseif($laporan->foto)
                    <!-- Fallback untuk foto lama (single photo di kolom 'foto') -->
                    <div class="card-modern">
                        <div class="gallery-header">
                            <div class="gallery-title">
                                <svg width="20" height="20" fill="currentColor">
                                    <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                                </svg>
                                <span>Dokumentasi Foto</span>
                            </div>
                            <span class="photo-count-badge">1 Foto</span>
                        </div>
                        
                        <div class="image-container-modern">
                            <img src="{{ Storage::url($laporan->foto) }}" 
                                alt="{{ $laporan->judul }}"
                                class="report-image-modern"
                                onclick="openImageModal('{{ Storage::url($laporan->foto) }}', 0)">
                            <div class="image-overlay-modern">
                                <button class="btn-view-full" onclick="openImageModal('{{ Storage::url($laporan->foto) }}', 0)">
                                    <svg width="24" height="24" fill="currentColor">
                                        <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                                    </svg>
                                    Lihat Foto Penuh
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Report Content -->
                <div class="card-modern">
                    <div class="section-header-modern">
                        <div class="section-icon">📄</div>
                        <h3 class="section-title-modern">Isi Laporan</h3>
                    </div>
                    <div class="report-content-text">
                        {{ $laporan->isi }}
                    </div>
                </div>

                <!-- Rejected Alert -->
                @if($laporan->status == 'ditolak' && $laporan->alasan_penolakan)
                <div class="card-modern card-rejected">
                    <div class="rejected-header">
                        <div class="rejected-icon">
                            <svg width="28" height="28" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                            </svg>
                        </div>
                        <div class="rejected-content">
                            <div class="rejected-title">⚠️ Laporan Ditolak</div>
                            <div class="rejected-time">{{ $laporan->updated_at->format('d F Y, H:i') }} WIB</div>
                        </div>
                    </div>
                    <div class="rejected-reason">
                        {{ $laporan->alasan_penolakan }}
                    </div>
                </div>
                @endif

                <!-- Responses Section -->
                <div class="card-modern">
                    <div class="section-header-modern">
                        <div class="section-title-group">
                            <div class="section-icon">💬</div>
                            <h3 class="section-title-modern">Tanggapan Admin</h3>
                        </div>
                        <span class="badge-count">{{ $laporan->tanggapans->count() }}</span>
                    </div>

                    <!-- Response List -->
                    <div class="responses-list">
                        @forelse($laporan->tanggapans as $tanggapan)
                            <div class="response-card">
                                <div class="response-avatar-wrapper">
                                    <div class="response-avatar">
                                        {{ substr($tanggapan->user->name ?? 'A', 0, 1) }}
                                    </div>
                                </div>
                                <div class="response-body">
                                    <div class="response-header-inline">
                                        <div class="response-author-group">
                                            <span class="response-author-name">{{ $tanggapan->user->name ?? 'Admin' }}</span>
                                            <span class="badge-admin">Admin</span>
                                        </div>
                                        <span class="response-time-text">{{ $tanggapan->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="response-message">
                                        {{ $tanggapan->isi }}
                                    </div>
                                    <div class="response-footer-time">
                                        <svg width="12" height="12" fill="currentColor">
                                            <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                                        </svg>
                                        {{ $tanggapan->created_at->format('d M Y, H:i') }} WIB
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <svg width="64" height="64" fill="currentColor">
                                        <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/>
                                    </svg>
                                </div>
                                <p class="empty-text">Belum ada tanggapan untuk laporan ini</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Response Form -->
                    @if($laporan->status != 'ditolak')
                        <div class="response-form-section">
                            <h4 class="form-section-title">✍️ Berikan Tanggapan</h4>
                            <form action="{{ route('admin.tanggapan.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="laporan_id" value="{{ $laporan->id }}">
                                
                                <div class="form-group-modern">
                                    <label class="form-label-modern">
                                        Isi Tanggapan 
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="isi" 
                                              class="form-input-modern @error('isi') is-invalid @enderror" 
                                              rows="5" 
                                              placeholder="Tulis tanggapan Anda untuk laporan ini..."
                                              required>{{ old('isi') }}</textarea>
                                    @error('isi')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                    <small class="form-hint-modern">
                                        <svg width="14" height="14" fill="currentColor">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                                        </svg>
                                        Tanggapan akan dikirim sebagai notifikasi ke warga
                                    </small>
                                </div>

                                <div class="form-actions-modern">
                                    <button type="submit" class="btn-primary-modern">
                                        <svg width="20" height="20" fill="currentColor">
                                            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                                        </svg>
                                        Kirim Tanggapan
                                    </button>
                                    <button type="reset" class="btn-secondary-modern">
                                        <svg width="20" height="20" fill="currentColor">
                                            <path d="M12 5V1L7 6l5 5V7c3.31 0 6 2.69 6 6s-2.69 6-6 6-6-2.69-6-6H4c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8z"/>
                                        </svg>
                                        Reset
                                    </button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="warning-banner">
                            <svg width="20" height="20" fill="currentColor">
                                <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
                            </svg>
                            <span>Laporan yang ditolak tidak dapat diberi tanggapan baru</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Column - Sidebar -->
            <div class="sidebar-column">
                
                <!-- Quick Action Card -->
                @if($laporan->status != 'ditolak')
                <div class="card-modern card-quick-action">
                    <div class="quick-action-header">
                        <svg width="24" height="24" fill="currentColor">
                            <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
                        </svg>
                        <h4>Aksi Cepat</h4>
                    </div>
                    <p class="quick-action-desc">Jika laporan tidak sesuai, Anda dapat menolaknya dengan memberikan alasan yang jelas.</p>
                    <button class="btn-reject-action" data-bs-toggle="modal" data-bs-target="#rejectModal">
                        <svg width="20" height="20" fill="currentColor">
                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                        </svg>
                        Tolak Laporan
                    </button>
                </div>
                @endif

                <!-- Status Update Card - HANYA TAMPIL JIKA TIDAK DITOLAK -->
                @if($laporan->status != 'ditolak')
                <div class="card-modern">
                    <div class="card-header-colored">
                        <svg width="20" height="20" fill="currentColor">
                            <path d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.11 0 2-.9 2-2V7l-4-4zm-5 16c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-10H5V5h10v4z"/>
                        </svg>
                        Update Status
                    </div>
                    
                    <form action="{{ route('admin.laporan.status', $laporan->id) }}" method="POST" class="status-form">
                        @csrf
                        
                        <div class="form-group-sidebar">
                            <label class="form-label-sidebar">Status Saat Ini</label>
                            <div class="current-status-display">
                                <span class="status-badge status-{{ $laporan->status }}">
                                    <span class="status-indicator"></span>
                                    {{ ucfirst($laporan->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group-sidebar">
                            <label class="form-label-sidebar">Ubah Ke</label>
                            <select name="status" 
                                    class="form-select-modern @error('status') is-invalid @enderror" 
                                    required>
                                <option value="">-- Pilih Status --</option>
                                <option value="menunggu" {{ $laporan->status == 'menunggu' ? 'selected' : '' }}>⏱️ Menunggu</option>
                                <option value="diproses" {{ $laporan->status == 'diproses' ? 'selected' : '' }}>⚙️ Diproses</option>
                                <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                            </select>
                            @error('status')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="info-notice">
                            <svg width="16" height="16" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                            </svg>
                            <span>User akan menerima notifikasi perubahan status</span>
                        </div>

                        <button type="submit" class="btn-update-status">
                            <svg width="18" height="18" fill="currentColor">
                                <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/>
                            </svg>
                            Update Status
                        </button>
                    </form>
                </div>
                @endif

                <!-- Info Card -->
                <div class="card-modern">
                    <div class="card-header-colored">
                        <svg width="20" height="20" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                        </svg>
                        Informasi Detail
                    </div>
                    
                    <div class="info-list-modern">
                        <div class="info-row">
                            <span class="info-label-modern">ID Laporan</span>
                            <span class="info-value-modern">#{{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </div>

                        <div class="info-row">
                            <span class="info-label-modern">Dilaporkan Oleh</span>
                            <div class="user-mini-card">
                                <div class="user-mini-avatar">
                                    {{ substr($laporan->user->name ?? 'A', 0, 1) }}
                                </div>
                                <div class="user-mini-details">
                                    <div class="user-mini-name">{{ $laporan->user->name ?? 'Anonim' }}</div>
                                    <div class="user-mini-email">{{ $laporan->user->email ?? '-' }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="info-row">
                            <span class="info-label-modern">Dibuat</span>
                            <span class="info-value-modern">
                                {{ $laporan->created_at->format('d M Y') }}
                                <small class="info-time-small">{{ $laporan->created_at->format('H:i') }}</small>
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label-modern">Diupdate</span>
                            <span class="info-value-modern">
                                {{ $laporan->updated_at->diffForHumans() }}
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label-modern">Total Tanggapan</span>
                            <span class="badge-count-mini">{{ $laporan->tanggapans->count() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Delete Card -->
                @if($laporan->status != 'ditolak')
                <div class="card-modern card-danger-zone">
                    <div class="danger-zone-header">
                        <svg width="20" height="20" fill="currentColor">
                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                        </svg>
                        <h4>Zona Bahaya</h4>
                    </div>
                    <p class="danger-zone-desc">Tindakan ini permanen dan tidak dapat dibatalkan.</p>
                    <form action="{{ route('admin.laporan.destroy', $laporan->id) }}" 
                          method="POST" 
                          onsubmit="return confirm('⚠️ PERHATIAN!\n\nAnda yakin ingin menghapus laporan ini?\n\nTindakan ini akan:\n• Menghapus laporan secara permanen\n• Menghapus semua tanggapan terkait\n• Tidak dapat dikembalikan\n\nKetik OK untuk melanjutkan')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete-danger">
                            <svg width="18" height="18" fill="currentColor">
                                <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                            </svg>
                            Hapus Laporan
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content modal-transparent">
            <button type="button" class="btn-close-fullscreen" data-bs-dismiss="modal">
                <svg width="32" height="32" fill="currentColor">
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                </svg>
            </button>
            <img id="modalImage" src="" class="modal-image-full" alt="Full Image">
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-modern-design">
            <form action="{{ route('admin.laporan.reject', $laporan->id) }}" method="POST">
                @csrf
                <div class="modal-header-danger-modern">
                    <div class="modal-icon-wrapper">
                        <svg width="40" height="40" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                        </svg>
                    </div>
                    <div class="modal-title-wrapper-modern">
                        <h3 class="modal-title-modern">Tolak Laporan</h3>
                        <p class="modal-subtitle-modern">Berikan alasan penolakan yang jelas dan profesional</p>
                    </div>
                    <button type="button" class="btn-close-modal-modern" data-bs-dismiss="modal">
                        <svg width="24" height="24" fill="currentColor">
                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                        </svg>
                    </button>
                </div>
                
                <div class="modal-body-modern-design">
                    <div class="alert-warning-modern">
                        <svg width="24" height="24" fill="currentColor">
                            <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
                        </svg>
                        <div>
                            <strong>Perhatian!</strong>
                            <p>User akan menerima notifikasi penolakan. Pastikan alasan yang Anda berikan jelas dan membantu.</p>
                        </div>
                    </div>

                    <div class="form-group-modern">
                        <label class="form-label-modern">
                            Alasan Penolakan 
                            <span class="text-danger">*</span>
                        </label>
                        <textarea name="alasan_penolakan" 
                                  class="form-input-modern @error('alasan_penolakan') is-invalid @enderror" 
                                  rows="7" 
                                  placeholder="Contoh:&#10;&#10;Terima kasih atas laporan Anda. Namun, kami tidak dapat memprosesnya karena:&#10;&#10;1. Foto yang dilampirkan kurang jelas&#10;2. Lokasi tidak sesuai dengan wilayah kami&#10;3. Informasi yang diberikan kurang lengkap&#10;&#10;Silakan kirim kembali dengan informasi yang lebih detail. Terima kasih."
                                  required>{{ old('alasan_penolakan') }}</textarea>
                        @error('alasan_penolakan')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                        <small class="form-hint-modern">
                            <svg width="14" height="14" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                            </svg>
                            Minimal 20 karakter. Bersikap profesional dan membantu.
                        </small>
                    </div>

                    <div class="info-box-list">
                        <div class="info-box-title">
                            <svg width="16" height="16" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                            </svg>
                            Yang akan terjadi:
                        </div>
                        <ul class="info-box-items">
                            <li>Status berubah menjadi "Ditolak"</li>
                            <li>User menerima notifikasi dengan alasan penolakan</li>
                            <li>Tidak dapat diberi tanggapan tambahan</li>
                            <li>User dapat mengirim laporan baru yang lebih lengkap</li>
                        </ul>
                    </div>
                </div>
                
                <div class="modal-footer-modern-design">
                    <button type="button" class="btn-modal-cancel-modern" data-bs-dismiss="modal">
                        <svg width="18" height="18" fill="currentColor">
                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                        </svg>
                        Batal
                    </button>
                    <button type="submit" class="btn-modal-reject-modern">
                        <svg width="18" height="18" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                        </svg>
                        Tolak Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* ========================================
   MODERN DETAIL PAGE - PREMIUM DESIGN
   ======================================== */

/* Reset & Base */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.modern-detail-page {
    background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
    min-height: 100vh;
    padding-bottom: 3rem;
}

/* Top Bar */
.top-bar {
    background: white;
    border-bottom: 1px solid #e9ecef;
    padding: 1.25rem 0;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.container-modern {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.btn-back-modern {
    display: inline-flex;
    align-items: center;
    gap: 0.625rem;
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    color: white;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.95rem;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
}

.btn-back-modern:hover {
    background: linear-gradient(135deg, #0a58ca 0%, #084298 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(13, 110, 253, 0.3);
    color: white;
}

.top-bar-actions {
    display: flex;
    gap: 0.75rem;
}

.btn-icon-action {
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    color: #495057;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-icon-action:hover {
    background: white;
    border-color: #0d6efd;
    color: #0d6efd;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

/* Content Grid */
.content-grid {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 2rem;
    margin-top: 2rem;
}

/* Cards */
.card-modern {
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    overflow: hidden;
    margin-bottom: 1.5rem;
    transition: all 0.3s ease;
}

.card-modern:hover {
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

/* Report Header Card with Gradient */
.card-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.report-header {
    padding: 2.5rem;
}

.report-badge-group {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.25rem;
}

.report-id {
    font-size: 0.875rem;
    font-weight: 700;
    background: rgba(255, 255, 255, 0.2);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    backdrop-filter: blur(10px);
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1.25rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
    backdrop-filter: blur(10px);
}

.status-indicator {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: currentColor;
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.5; transform: scale(1.2); }
}

.status-menunggu {
    background: rgba(255, 193, 7, 0.2);
    color: #fff;
    border: 2px solid rgba(255, 193, 7, 0.4);
}

.status-diproses {
    background: rgba(13, 202, 240, 0.2);
    color: #fff;
    border: 2px solid rgba(13, 202, 240, 0.4);
}

.status-selesai {
    background: rgba(25, 135, 84, 0.2);
    color: #fff;
    border: 2px solid rgba(25, 135, 84, 0.4);
}

.status-ditolak {
    background: rgba(220, 53, 69, 0.2);
    color: #fff;
    border: 2px solid rgba(220, 53, 69, 0.4);
}

.report-title {
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: 1.75rem;
    line-height: 1.3;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* User Card Inline */
.user-card-inline {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    background: rgba(255, 255, 255, 0.15);
    padding: 1.5rem;
    border-radius: 16px;
    backdrop-filter: blur(10px);
}

.user-avatar-large {
    width: 64px;
    height: 64px;
    border-radius: 16px;
    background: linear-gradient(135deg, #fff 0%, #f0f0f0 100%);
    color: #667eea;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 700;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.user-info-inline {
    flex: 1;
}

.user-name-large {
    font-size: 1.125rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.user-meta-inline {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    align-items: center;
    font-size: 0.875rem;
    opacity: 0.95;
}

.meta-icon-text {
    display: flex;
    align-items: center;
    gap: 0.375rem;
}

.meta-divider {
    opacity: 0.5;
}

.meta-time-text {
    opacity: 0.9;
    font-style: italic;
}

/* Image Container */
.image-container-modern {
    position: relative;
    width: 100%;
    height: 500px;
    overflow: hidden;
    cursor: pointer;
}

.report-image-modern {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.image-container-modern:hover .report-image-modern {
    transform: scale(1.05);
}

.image-overlay-modern {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.7) 100%);
    display: flex;
    align-items: flex-end;
    justify-content: center;
    padding: 2rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.image-container-modern:hover .image-overlay-modern {
    opacity: 1;
}

.btn-view-full {
    display: flex;
    align-items: center;
    gap: 0.625rem;
    padding: 1rem 2rem;
    background: white;
    color: #1a1a1a;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.btn-view-full:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
}

/* Section Header */
.section-header-modern {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 2rem 2rem 1.5rem;
    border-bottom: 2px solid #f1f3f5;
}

.section-icon {
    font-size: 1.75rem;
}

.section-title-modern {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0;
}

.section-title-group {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex: 1;
}

.badge-count {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
}

/* Report Content */
.report-content-text {
    padding: 2rem;
    font-size: 1.05rem;
    line-height: 1.8;
    color: #495057;
    text-align: justify;
    white-space: pre-line;
}

/* Rejected Card */
.card-rejected {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.rejected-header {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    padding: 2rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}

.rejected-icon {
    width: 64px;
    height: 64px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    backdrop-filter: blur(10px);
}

.rejected-content {
    flex: 1;
}

.rejected-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 0.375rem;
}

.rejected-time {
    font-size: 0.875rem;
    opacity: 0.9;
}

.rejected-reason {
    padding: 2rem;
    font-size: 1rem;
    line-height: 1.7;
    white-space: pre-line;
}

/* Responses */
.responses-list {
    padding: 2rem;
    max-height: 600px;
    overflow-y: auto;
}

.response-card {
    display: flex;
    gap: 1.25rem;
    padding-bottom: 1.75rem;
    margin-bottom: 1.75rem;
    border-bottom: 2px solid #f1f3f5;
}

.response-card:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.response-avatar-wrapper {
    flex-shrink: 0;
}

.response-avatar {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    background: linear-gradient(135deg, #198754 0%, #146c43 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.125rem;
    box-shadow: 0 4px 12px rgba(25, 135, 84, 0.3);
}

.response-body {
    flex: 1;
    min-width: 0;
}

.response-header-inline {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.response-author-group {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.response-author-name {
    font-weight: 700;
    color: #1a1a1a;
    font-size: 1rem;
}

.badge-admin {
    background: linear-gradient(135deg, #198754 0%, #146c43 100%);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

.response-time-text {
    font-size: 0.85rem;
    color: #868e96;
}

.response-message {
    background: linear-gradient(135deg, #f8f9fa 0%, #f1f3f5 100%);
    padding: 1.25rem 1.5rem;
    border-radius: 16px;
    font-size: 1rem;
    color: #495057;
    line-height: 1.7;
    white-space: pre-line;
    margin-bottom: 0.75rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.response-footer-time {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    font-size: 0.8rem;
    color: #868e96;
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

.empty-text {
    color: #6c757d;
    font-size: 1rem;
    margin: 0;
}

/* Response Form */
.response-form-section {
    padding: 2rem;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-top: 2px solid #e9ecef;
}

.form-section-title {
    font-size: 1.125rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 1.5rem;
}

.form-group-modern {
    margin-bottom: 1.5rem;
}

.form-label-modern {
    display: block;
    font-size: 0.95rem;
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.75rem;
}

.form-input-modern {
    width: 100%;
    padding: 1rem 1.25rem;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    font-size: 0.95rem;
    font-family: inherit;
    transition: all 0.2s ease;
    background: white;
}

.form-input-modern:focus {
    outline: none;
    border-color: #0d6efd;
    box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
}

.form-hint-modern {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.85rem;
    color: #6c757d;
    margin-top: 0.625rem;
}

.form-error {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

/* Buttons */
.form-actions-modern {
    display: flex;
    gap: 1rem;
}

.btn-primary-modern {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.625rem;
    padding: 1rem 2rem;
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    color: white;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
}

.btn-primary-modern:hover {
    background: linear-gradient(135deg, #0a58ca 0%, #084298 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(13, 110, 253, 0.4);
}

.btn-secondary-modern {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem 1.75rem;
    background: white;
    color: #495057;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-secondary-modern:hover {
    background: #f8f9fa;
    border-color: #adb5bd;
    color: #1a1a1a;
}

.warning-banner {
    display: flex;
    align-items: center;
    gap: 0.875rem;
    padding: 1.25rem 2rem;
    background: linear-gradient(135deg, #fff3cd 0%, #ffe69c 100%);
    border-left: 4px solid #ffc107;
    color: #997404;
    font-weight: 500;
}

/* Sidebar */
.sidebar-column {
    position: sticky;
    top: 100px;
    align-self: start;
}

/* Quick Action Card */
.card-quick-action {
    background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
    color: #fff;
}

.quick-action-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1.5rem 1.5rem 1rem;
    font-size: 1.125rem;
    font-weight: 700;
}

.quick-action-desc {
    padding: 0 1.5rem 1.25rem;
    font-size: 0.9rem;
    opacity: 0.95;
    line-height: 1.6;
}

.btn-reject-action {
    width: calc(100% - 3rem);
    margin: 0 1.5rem 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.625rem;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-reject-action:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

/* Card Headers */
.card-header-colored {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1.25rem 1.5rem;
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    color: white;
    font-weight: 700;
    font-size: 1rem;
}

/* Status Form */
.status-form {
    padding: 1.5rem;
}

.form-group-sidebar {
    margin-bottom: 1.25rem;
}

.form-label-sidebar {
    display: block;
    font-size: 0.875rem;
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.625rem;
}

.current-status-display {
    margin-bottom: 1rem;
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

.info-notice {
    display: flex;
    align-items: start;
    gap: 0.625rem;
    padding: 1rem;
    background: rgba(13, 202, 240, 0.1);
    border-left: 3px solid #0dcaf0;
    border-radius: 8px;
    font-size: 0.85rem;
    color: #495057;
    margin-bottom: 1.25rem;
}

.danger-notice {
    display: flex;
    align-items: start;
    gap: 0.625rem;
    padding: 1rem;
    background: rgba(220, 53, 69, 0.1);
    border-left: 3px solid #dc3545;
    border-radius: 8px;
    font-size: 0.85rem;
    color: #495057;
}

.btn-update-status {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.625rem;
    padding: 0.875rem;
    background: linear-gradient(135deg, #198754 0%, #146c43 100%);
    color: white;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(25, 135, 84, 0.3);
}

.btn-update-status:hover {
    background: linear-gradient(135deg, #146c43 0%, #0d5132 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(25, 135, 84, 0.4);
}

/* Info List */
.info-list-modern {
    padding: 1.5rem;
}

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: start;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid #f1f3f5;
}

.info-row:last-child {
    border-bottom: none;
}

.info-label-modern {
    font-size: 0.85rem;
    color: #6c757d;
    font-weight: 500;
}

.info-value-modern {
    font-size: 0.9rem;
    font-weight: 600;
    color: #1a1a1a;
    text-align: right;
}

.info-time-small {
    display: block;
    font-size: 0.75rem;
    color: #868e96;
    font-weight: 400;
    margin-top: 0.25rem;
}

/* User Mini Card */
.user-mini-card {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.user-mini-avatar {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.9rem;
    flex-shrink: 0;
}

.user-mini-details {
    flex: 1;
    min-width: 0;
}

.user-mini-name {
    font-size: 0.9rem;
    font-weight: 600;
    color: #1a1a1a;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.user-mini-email {
    font-size: 0.75rem;
    color: #6c757d;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.badge-count-mini {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    color: white;
    padding: 0.375rem 0.875rem;
    border-radius: 16px;
    font-size: 0.875rem;
    font-weight: 700;
    box-shadow: 0 2px 8px rgba(13, 110, 253, 0.3);
}

/* Danger Zone */
.card-danger-zone {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.danger-zone-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1.5rem 1.5rem 1rem;
    font-size: 1.125rem;
    font-weight: 700;
}

.danger-zone-desc {
    padding: 0 1.5rem 1.25rem;
    font-size: 0.9rem;
    opacity: 0.95;
    line-height: 1.6;
}

.btn-delete-danger {
    width: calc(100% - 3rem);
    margin: 0 1.5rem 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.625rem;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-delete-danger:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

/* Alerts */
.alert-box {
    display: flex;
    align-items: start;
    gap: 1.25rem;
    padding: 1.5rem;
    border-radius: 16px;
    position: relative;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.alert-success-box {
    background: linear-gradient(135deg, #d1e7dd 0%, #badbcc 100%);
    border-left: 4px solid #198754;
}

.alert-error-box {
    background: linear-gradient(135deg, #f8d7da 0%, #f1aeb5 100%);
    border-left: 4px solid #dc3545;
}

.alert-icon-wrapper {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.alert-icon-wrapper.success {
    background: #198754;
    color: white;
}

.alert-icon-wrapper.error {
    background: #dc3545;
    color: white;
}

.alert-content-box {
    flex: 1;
}

.alert-title-box {
    font-size: 1.125rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 0.375rem;
}

.alert-message-box {
    font-size: 0.95rem;
    color: #495057;
    line-height: 1.6;
}

.alert-close-btn {
    background: transparent;
    border: none;
    padding: 0.5rem;
    cursor: pointer;
    color: #495057;
    transition: all 0.2s ease;
    flex-shrink: 0;
}

.alert-close-btn:hover {
    color: #1a1a1a;
    transform: scale(1.1);
}

/* Modals */
.modal-transparent {
    background: transparent;
    border: none;
}

.modal-transparent .modal-body {
    padding: 0;
}

.btn-close-fullscreen {
    position: absolute;
    top: 2rem;
    right: 2rem;
    width: 56px;
    height: 56px;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(10px);
    border: none;
    border-radius: 14px;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    z-index: 10;
}

.btn-close-fullscreen:hover {
    background: rgba(0, 0, 0, 0.95);
    transform: scale(1.1);
}

.modal-image-full {
    width: 100%;
    border-radius: 16px;
}

/* Reject Modal */
.modal-modern-design {
    border: none;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
}

.modal-header-danger-modern {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
    padding: 2rem;
    display: flex;
    align-items: start;
    gap: 1.25rem;
}

.modal-icon-wrapper {
    width: 72px;
    height: 72px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.modal-title-wrapper-modern {
    flex: 1;
}

.modal-title-modern {
    font-size: 1.5rem;
    font-weight: 800;
    margin: 0 0 0.5rem 0;
}

.modal-subtitle-modern {
    font-size: 0.95rem;
    opacity: 0.95;
    margin: 0;
}

.btn-close-modal-modern {
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
    transition: all 0.2s ease;
    flex-shrink: 0;
}

.btn-close-modal-modern:hover {
    background: rgba(255, 255, 255, 0.3);
}

.modal-body-modern-design {
    padding: 2rem;
}

.alert-warning-modern {
    display: flex;
    gap: 1rem;
    padding: 1.25rem;
    background: rgba(255, 193, 7, 0.1);
    border-left: 4px solid #ffc107;
    border-radius: 12px;
    margin-bottom: 1.75rem;
}

.alert-warning-modern svg {
    color: #ffc107;
    flex-shrink: 0;
}

.alert-warning-modern strong {
    color: #997404;
    display: block;
    margin-bottom: 0.375rem;
    font-size: 0.95rem;
}

.alert-warning-modern p {
    font-size: 0.9rem;
    color: #495057;
    margin: 0;
    line-height: 1.6;
}

.info-box-list {
    background: #f8f9fa;
    padding: 1.25rem;
    border-radius: 12px;
    margin-top: 1.5rem;
}

.info-box-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.info-box-items {
    font-size: 0.875rem;
    color: #6c757d;
    margin: 0;
    padding-left: 1.5rem;
    line-height: 1.9;
}

.info-box-items li {
    margin-bottom: 0.375rem;
}

.modal-footer-modern-design {
    padding: 1.5rem 2rem;
    background: #f8f9fa;
    border-top: 2px solid #e9ecef;
    display: flex;
    gap: 1rem;
}

.btn-modal-cancel-modern {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.625rem;
    padding: 1rem;
    background: white;
    color: #495057;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-modal-cancel-modern:hover {
    background: #f8f9fa;
    border-color: #adb5bd;
    color: #1a1a1a;
}

.btn-modal-reject-modern {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.625rem;
    padding: 1rem;
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
}

.btn-modal-reject-modern:hover {
    background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(220, 53, 69, 0.4);
}

/* Responsive */
@media (max-width: 1200px) {
    .content-grid {
        grid-template-columns: 1fr 320px;
    }
}

@media (max-width: 992px) {
    .content-grid {
        grid-template-columns: 1fr;
    }

    .sidebar-column {
        position: relative;
        top: auto;
    }

    .container-modern {
        padding: 0 1.5rem;
    }
}

@media (max-width: 768px) {
    .container-modern {
        padding: 0 1rem;
        flex-direction: column;
        align-items: stretch;
    }

    .top-bar-actions {
        width: 100%;
        justify-content: flex-end;
        margin-top: 1rem;
    }

    .report-title {
        font-size: 1.5rem;
    }

    .user-card-inline {
        flex-direction: column;
        align-items: start;
    }

    .image-container-modern {
        height: 300px;
    }

    .form-actions-modern {
        flex-direction: column;
    }

    .modal-header-danger-modern {
        flex-direction: column;
    }

    .modal-footer-modern-design {
        flex-direction: column;
    }
}

@media (max-width: 576px) {
    .modern-detail-page {
        padding-bottom: 2rem;
    }

    .top-bar {
        padding: 1rem 0;
    }

    .btn-back-modern {
        padding: 0.625rem 1.25rem;
        font-size: 0.875rem;
    }

    .report-header {
        padding: 2rem 1.5rem;
    }

    .card-modern {
        border-radius: 16px;
    }

    .report-badge-group {
        flex-direction: column;
        align-items: start;
        gap: 0.75rem;
    }
}

/* Print Styles */
@media print {
    .top-bar,
    .btn-back-modern,
    .top-bar-actions,
    .sidebar-column,
    .response-form-section,
    .btn-reject-action,
    .btn-delete-danger {
        display: none !important;
    }

    .content-grid {
        grid-template-columns: 1fr;
    }

    .card-modern {
        box-shadow: none;
        border: 1px solid #e9ecef;
    }
}


/* =====================================
   GALLERY STYLES - MULTIPLE PHOTOS
   ===================================== */

.gallery-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 2rem;
    border-bottom: 2px solid #f1f3f5;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.gallery-title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.125rem;
    font-weight: 700;
    color: #1a1a1a;
}

.photo-count-badge {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
}

/* Gallery Carousel */
.gallery-carousel {
    position: relative;
}

.carousel-main-container {
    position: relative;
    width: 100%;
    height: 500px;
    overflow: hidden;
}

.carousel-main-image {
    position: relative;
    width: 100%;
    height: 100%;
}

.carousel-slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    visibility: hidden;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    transform: scale(0.95);
}

.carousel-slide.active {
    opacity: 1;
    visibility: visible;
    transform: scale(1);
    z-index: 1;
}

.carousel-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.carousel-slide:hover .carousel-image {
    transform: scale(1.05);
}

.slide-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.7) 100%);
    display: flex;
    align-items: flex-end;
    justify-content: center;
    padding: 2rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.carousel-slide:hover .slide-overlay {
    opacity: 1;
}

/* Navigation Buttons */
.carousel-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 56px;
    height: 56px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border: none;
    border-radius: 14px;
    color: #1a1a1a;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
}

.carousel-nav:hover {
    background: white;
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.25);
}

.carousel-prev {
    left: 2rem;
}

.carousel-next {
    right: 2rem;
}

/* Slide Counter */
.carousel-counter {
    position: absolute;
    top: 2rem;
    right: 2rem;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(10px);
    color: white;
    padding: 0.75rem 1.25rem;
    border-radius: 25px;
    font-size: 0.95rem;
    font-weight: 700;
    z-index: 10;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

#currentSlide {
    color: #0d6efd;
    font-size: 1.125rem;
}

/* Thumbnails */
.carousel-thumbnails {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 1rem;
    padding: 1.5rem 2rem;
    background: #f8f9fa;
    overflow-x: auto;
}

.thumbnail-item {
    position: relative;
    width: 100%;
    aspect-ratio: 16/10;
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    border: 3px solid transparent;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.thumbnail-item:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.thumbnail-item.active {
    border-color: #0d6efd;
    box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.2);
}

.thumbnail-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.thumbnail-item:hover img {
    transform: scale(1.1);
}

.thumbnail-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.7) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.thumbnail-item:hover .thumbnail-overlay,
.thumbnail-item.active .thumbnail-overlay {
    opacity: 1;
}

.thumbnail-number {
    color: white;
    font-size: 1.25rem;
    font-weight: 700;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

/* Responsive */
@media (max-width: 768px) {
    .carousel-main-container {
        height: 350px;
    }

    .carousel-nav {
        width: 44px;
        height: 44px;
    }

    .carousel-prev {
        left: 1rem;
    }

    .carousel-next {
        right: 1rem;
    }

    .carousel-counter {
        top: 1rem;
        right: 1rem;
        padding: 0.625rem 1rem;
        font-size: 0.875rem;
    }

    .carousel-thumbnails {
        grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
        gap: 0.75rem;
        padding: 1rem;
    }

    .gallery-header {
        padding: 1rem 1.25rem;
    }
}

@media (max-width: 576px) {
    .carousel-main-container {
        height: 280px;
    }

    .carousel-thumbnails {
        grid-template-columns: repeat(auto-fill, minmax(70px, 1fr));
        gap: 0.5rem;
        padding: 0.75rem;
    }

    .gallery-title {
        font-size: 1rem;
    }

    .photo-count-badge {
        padding: 0.375rem 0.75rem;
        font-size: 0.8rem;
    }
}
</style>

<script>
// Image Modal
function openImageModal(src) {
    const modalImage = document.getElementById('modalImage');
    if (modalImage) {
        modalImage.src = src;
        const modal = new bootstrap.Modal(document.getElementById('imageModal'));
        modal.show();
    }
}

// Smooth scroll for forms
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            // Add loading state if needed
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<svg class="spin" width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2v4m0 12v4M4.93 4.93l2.83 2.83m8.48 8.48l2.83 2.83M2 12h4m12 0h4M4.93 19.07l2.83-2.83m8.48-8.48l2.83-2.83"/></svg> Memproses...';
            }
        });
    });
});

// Auto-hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert-box');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-20px)';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });
});

// Carousel functionality
let currentSlideIndex = 0;
const slides = document.querySelectorAll('.carousel-slide');
const totalSlides = slides.length;

function changeSlide(direction) {
    if (totalSlides === 0) return;
    
    const thumbnails = document.querySelectorAll('.thumbnail-item');
    
    // Remove active class from current slide
    slides[currentSlideIndex].classList.remove('active');
    if (thumbnails[currentSlideIndex]) {
        thumbnails[currentSlideIndex].classList.remove('active');
    }
    
    // Calculate new index
    currentSlideIndex = (currentSlideIndex + direction + totalSlides) % totalSlides;
    
    // Add active class to new slide
    slides[currentSlideIndex].classList.add('active');
    if (thumbnails[currentSlideIndex]) {
        thumbnails[currentSlideIndex].classList.add('active');
    }
    
    // Update counter
    updateCounter();
    
    // Scroll thumbnail into view
    if (thumbnails[currentSlideIndex]) {
        thumbnails[currentSlideIndex].scrollIntoView({
            behavior: 'smooth',
            block: 'nearest',
            inline: 'center'
        });
    }
}

function goToSlide(index) {
    if (totalSlides === 0) return;
    
    const thumbnails = document.querySelectorAll('.thumbnail-item');
    
    // Remove active class from current slide
    slides[currentSlideIndex].classList.remove('active');
    if (thumbnails[currentSlideIndex]) {
        thumbnails[currentSlideIndex].classList.remove('active');
    }
    
    // Set new index
    currentSlideIndex = index;
    
    // Add active class to new slide
    slides[currentSlideIndex].classList.add('active');
    if (thumbnails[currentSlideIndex]) {
        thumbnails[currentSlideIndex].classList.add('active');
    }
    
    // Update counter
    updateCounter();
}

function updateCounter() {
    const currentSlideEl = document.getElementById('currentSlide');
    if (currentSlideEl) {
        currentSlideEl.textContent = currentSlideIndex + 1;
    }
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const modal = document.getElementById('imageModal');
    // Only handle carousel navigation if modal is not open
    if (!modal || !modal.classList.contains('show')) {
        if (e.key === 'ArrowLeft') {
            changeSlide(-1);
        } else if (e.key === 'ArrowRight') {
            changeSlide(1);
        }
    }
});

// Touch swipe support
let touchStartX = 0;
let touchEndX = 0;

const carouselContainer = document.querySelector('.carousel-main-container');
if (carouselContainer) {
    carouselContainer.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
    });

    carouselContainer.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });
}

function handleSwipe() {
    const swipeThreshold = 50;
    const diff = touchStartX - touchEndX;
    
    if (Math.abs(diff) > swipeThreshold) {
        if (diff > 0) {
            // Swipe left
            changeSlide(1);
        } else {
            // Swipe right
            changeSlide(-1);
        }
    }
}
</script>

@endsection