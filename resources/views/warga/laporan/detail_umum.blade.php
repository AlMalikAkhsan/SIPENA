@extends('layouts.user')

@section('title', 'Detail Laporan - Lapor Aja!')

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

    .detail-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 1.5rem 1rem 6rem;
    }

    /* Header */
    .detail-header {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.75rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        flex: 1;
    }

    .back-button {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: var(--bg);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text);
        text-decoration: none;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .back-button:hover {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
        transform: translateX(-3px);
    }

    .header-info h1 {
        font-size: 1.75rem;
        font-weight: 800;
        color: var(--text);
        margin: 0 0 0.5rem;
    }

    .header-meta {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    .header-meta span {
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    /* Status Badge - Improved */
    .status-badge {
        padding: 0.65rem 1.5rem;
        border-radius: 999px;
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        flex-shrink: 0;
    }

    .status-badge i {
        font-size: 1rem;
    }

    .status-menunggu {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }

    .status-diproses {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
    }

    .status-selesai {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }

    .status-ditolak {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% {
            box-shadow: 0 4px 16px rgba(239, 68, 68, 0.4);
        }
        50% {
            box-shadow: 0 4px 24px rgba(239, 68, 68, 0.7);
        }
    }

    /* Photo Gallery */
    .photo-section {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
    }

    .main-photo-wrapper {
        position: relative;
        width: 100%;
        height: 500px;
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        cursor: pointer;
        overflow: hidden;
    }

    .main-photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .main-photo-wrapper:hover .main-photo {
        transform: scale(1.05);
    }

    .photo-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #9ca3af;
    }

    .photo-placeholder i {
        font-size: 5rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    /* Photo Counter Badge */
    .photo-counter {
        position: absolute;
        bottom: 20px;
        left: 20px;
        background: rgba(0, 0, 0, 0.75);
        backdrop-filter: blur(10px);
        color: white;
        padding: 0.6rem 1.2rem;
        border-radius: 999px;
        font-size: 0.9rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        z-index: 5;
    }

    /* Status Badge on Photo */
    .photo-status-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        padding: 0.75rem 1.5rem;
        border-radius: 999px;
        font-size: 0.95rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.25);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        gap: 0.6rem;
        z-index: 10;
        animation: fadeInDown 0.5s ease;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Thumbnails */
    .thumbnail-gallery {
        display: flex;
        gap: 1rem;
        padding: 1.5rem;
        overflow-x: auto;
        background: var(--bg);
    }

    .thumbnail-gallery::-webkit-scrollbar {
        height: 6px;
    }

    .thumbnail-gallery::-webkit-scrollbar-track {
        background: var(--border);
        border-radius: 3px;
    }

    .thumbnail-gallery::-webkit-scrollbar-thumb {
        background: var(--text-muted);
        border-radius: 3px;
    }

    .thumbnail-item {
        width: 100px;
        height: 100px;
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        border: 3px solid transparent;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .thumbnail-item:hover {
        border-color: var(--primary-light);
        transform: scale(1.05);
    }

    .thumbnail-item.active {
        border-color: var(--primary);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .thumbnail-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Content Card */
    .content-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--text);
        margin: 0 0 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-title i {
        color: var(--primary);
        font-size: 1.4rem;
    }

    /* Meta Grid */
    .meta-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: var(--bg);
        border-radius: 12px;
        border: 1px solid var(--border);
    }

    .meta-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: rgba(59, 130, 246, 0.1);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
    }

    .meta-content {
        flex: 1;
    }

    .meta-label {
        font-size: 0.8rem;
        color: var(--text-muted);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .meta-value {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text);
    }

    /* Description */
    .description-box {
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 1.75rem;
        font-size: 1.05rem;
        line-height: 1.8;
        color: var(--text);
        white-space: pre-line;
    }

    /* Sidebar */
    .sidebar-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.75rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-sm);
    }

    .sidebar-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text);
        margin: 0 0 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .sidebar-title i {
        color: var(--primary);
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--border);
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-size: 0.85rem;
        color: var(--text-muted);
        font-weight: 500;
    }

    .info-value {
        font-weight: 600;
        color: var(--text);
        font-size: 0.9rem;
    }

    /* User Card */
    .user-profile {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: var(--bg);
        border-radius: 12px;
        margin-bottom: 1rem;
    }

    .user-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-light), var(--primary));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        font-weight: 700;
        flex-shrink: 0;
    }

    .user-info {
        flex: 1;
    }

    .user-name {
        font-weight: 700;
        color: var(--text);
        margin-bottom: 0.2rem;
    }

    .user-role {
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    /* Share Buttons */
    .share-buttons {
        display: grid;
        gap: 0.75rem;
    }

    .btn-share {
        padding: 0.75rem 1.25rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        border: 2px solid;
    }

    .btn-share:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    .btn-whatsapp {
        background: rgba(37, 211, 102, 0.1);
        border-color: #25d366;
        color: #25d366;
    }

    .btn-whatsapp:hover {
        background: #25d366;
        color: white;
    }

    .btn-twitter {
        background: rgba(29, 161, 242, 0.1);
        border-color: #1da1f2;
        color: #1da1f2;
    }

    .btn-twitter:hover {
        background: #1da1f2;
        color: white;
    }

    .btn-copy {
        background: rgba(107, 114, 128, 0.1);
        border-color: var(--text-muted);
        color: var(--text-muted);
    }

    .btn-copy:hover {
        background: var(--text-muted);
        color: white;
    }

    /* Lightbox */
    .lightbox {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.95);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
    }

    .lightbox.active {
        display: flex;
    }

    .lightbox img {
        max-width: 90%;
        max-height: 90vh;
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6);
        animation: zoomIn 0.3s ease;
    }

    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .lightbox-close {
        position: absolute;
        top: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        font-size: 1.8rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .lightbox-close:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(90deg);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .detail-header {
            padding: 1.25rem;
        }

        .header-info h1 {
            font-size: 1.4rem;
        }

        .main-photo-wrapper {
            height: 300px;
        }

        .content-card {
            padding: 1.5rem;
        }

        .meta-grid {
            grid-template-columns: 1fr;
        }

        .photo-status-badge,
        .photo-counter {
            font-size: 0.8rem;
            padding: 0.5rem 1rem;
        }

        .thumbnail-gallery {
            justify-content: flex-start;
        }
    }
</style>
@endpush

@section('content')
<div class="detail-container">

    <!-- Header -->
    <div class="detail-header">
        <div class="header-left">
            <a href="{{ route('warga.laporan.semua') }}" class="back-button">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="header-info">
                <h1>Detail Laporan Warga</h1>
                <div class="header-meta">
                    <span><i class="fas fa-hashtag"></i> ID: {{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            
            <!-- Photo Gallery -->
            <div class="photo-section">
                @if($laporan->fotos && $laporan->fotos->count() > 0)
                    <div class="main-photo-wrapper" onclick="openLightbox('{{ asset('storage/' . $laporan->fotos->first()->foto_path) }}')">
                        <img src="{{ asset('storage/' . $laporan->fotos->first()->foto_path) }}" 
                             alt="{{ $laporan->judul }}" 
                             class="main-photo"
                             id="mainPhoto">
                        
                        @if($laporan->fotos->count() > 1)
                            <div class="photo-counter">
                                <i class="fas fa-images"></i>
                                {{ $laporan->fotos->count() }} Foto
                            </div>
                        @endif

                        <div class="photo-status-badge status-{{ $laporan->status }}">
                            @if($laporan->status == 'menunggu')
                                <i class="fas fa-clock"></i>
                            @elseif($laporan->status == 'diproses')
                                <i class="fas fa-spinner"></i>
                            @elseif($laporan->status == 'selesai')
                                <i class="fas fa-check-circle"></i>
                            @else
                                <i class="fas fa-times-circle"></i>
                            @endif
                            <span>{{ ucfirst($laporan->status) }}</span>
                        </div>
                    </div>

                    @if($laporan->fotos->count() > 1)
                        <div class="thumbnail-gallery">
                            @foreach($laporan->fotos as $index => $foto)
                                <div class="thumbnail-item {{ $index == 0 ? 'active' : '' }}" 
                                     onclick="changeMainPhoto('{{ asset('storage/' . $foto->foto_path) }}', this)">
                                    <img src="{{ asset('storage/' . $foto->foto_path) }}" alt="Foto {{ $index + 1 }}">
                                </div>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="main-photo-wrapper">
                        <div class="photo-placeholder">
                            <i class="far fa-image"></i>
                            <p style="margin-top: 1rem; font-size: 1.1rem;">Tidak ada foto</p>
                        </div>
                        <div class="photo-status-badge status-{{ $laporan->status }}">
                            @if($laporan->status == 'menunggu')
                                <i class="fas fa-clock"></i>
                            @elseif($laporan->status == 'diproses')
                                <i class="fas fa-spinner"></i>
                            @elseif($laporan->status == 'selesai')
                                <i class="fas fa-check-circle"></i>
                            @else
                                <i class="fas fa-times-circle"></i>
                            @endif
                            <span>{{ ucfirst($laporan->status) }}</span>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Content -->
            <div class="content-card">
                <h2 class="section-title">
                    <i class="fas fa-file-alt"></i>
                    {{ $laporan->judul }}
                </h2>

                <!-- Meta Info -->
                <div class="meta-grid">
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="meta-content">
                            <div class="meta-label">Tanggal Laporan</div>
                            <div class="meta-value">{{ $laporan->created_at->format('d M Y') }}</div>
                        </div>
                    </div>

                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="meta-content">
                            <div class="meta-label">Pelapor</div>
                            <div class="meta-value">{{ $laporan->user->name ?? 'Anonim' }}</div>
                        </div>
                    </div>

                    @if($laporan->lokasi)
                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="meta-content">
                                <div class="meta-label">Lokasi</div>
                                <div class="meta-value">{{ $laporan->lokasi }}</div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Description -->
                <h3 class="section-title" style="font-size: 1.2rem;">
                    <i class="fas fa-align-left"></i>
                    Detail Laporan
                </h3>
                <div class="description-box">
                    {{ $laporan->isi }}
                </div>
            </div>

        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            
            <!-- User Info -->
            <div class="sidebar-card">
                <h3 class="sidebar-title">
                    <i class="fas fa-user-circle"></i>
                    Informasi Pelapor
                </h3>
                
                <div class="user-profile">
                    <div class="user-avatar">
                        {{ strtoupper(substr($laporan->user->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="user-info">
                        <div class="user-name">{{ $laporan->user->name ?? 'Anonim' }}</div>
                        <div class="user-role">Warga</div>
                    </div>
                </div>

                <div class="info-row">
                    <span class="info-label">Dilaporkan</span>
                    <span class="info-value">{{ $laporan->created_at->diffForHumans() }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Terakhir Update</span>
                    <span class="info-value">{{ $laporan->updated_at->diffForHumans() }}</span>
                </div>
            </div>

            <!-- Status Info -->
            <div class="sidebar-card">
                <h3 class="sidebar-title">
                    <i class="fas fa-info-circle"></i>
                    Status Laporan
                </h3>
                
                <div class="info-row">
                    <span class="info-label">ID Laporan</span>
                    <span class="info-value">#{{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Status</span>
                    <span class="info-value">
                        <span class="status-badge status-{{ $laporan->status }}" style="padding: 0.35rem 0.8rem; font-size: 0.75rem;">
                            {{ ucfirst($laporan->status) }}
                        </span>
                    </span>
                </div>
                @if($laporan->fotos)
                    <div class="info-row">
                        <span class="info-label">Jumlah Foto</span>
                        <span class="info-value">{{ $laporan->fotos->count() }} foto</span>
                    </div>
                @endif
            </div>

            <!-- Share Card -->
            <div class="sidebar-card">
                <h3 class="sidebar-title">
                    <i class="fas fa-share-alt"></i>
                    Bagikan Laporan
                </h3>
                <p class="text-muted mb-3" style="font-size: 0.9rem;">
                    Sebarkan agar lebih banyak yang tahu dan cepat ditangani
                </p>
                
                <div class="share-buttons">
                    <button class="btn btn-share btn-whatsapp" onclick="shareWhatsApp()">
                        <i class="fab fa-whatsapp"></i>
                        Bagikan via WhatsApp
                    </button>
                    <button class="btn btn-share btn-twitter" onclick="shareTwitter()">
                        <i class="fab fa-twitter"></i>
                        Bagikan via Twitter
                    </button>
                    <button class="btn btn-share btn-copy" onclick="copyLink()">
                        <i class="fas fa-link"></i>
                        Salin Link
                    </button>
                </div>
            </div>

        </div>
    </div>

</div>

<!-- Lightbox -->
<div class="lightbox" id="lightbox" onclick="closeLightbox()">
    <button class="lightbox-close">
        <i class="fas fa-times"></i>
    </button>
    <img id="lightboxImg" src="" alt="Zoom Foto">
</div>
@endsection

@push('scripts')
<script>
// Change main photo when clicking thumbnail
function changeMainPhoto(src, element) {
    const mainPhoto = document.getElementById('mainPhoto');
    if (mainPhoto) {
        mainPhoto.src = src;
    }
    
    // Update active state
    document.querySelectorAll('.thumbnail-item').forEach(item => {
        item.classList.remove('active');
    });
    element.classList.add('active');
}

// Open lightbox
function openLightbox(src) {
    document.getElementById('lightboxImg').src = src;
    document.getElementById('lightbox').classList.add('active');
    document.body.style.overflow = 'hidden';
}

// Close lightbox
function closeLightbox() {
    document.getElementById('lightbox').classList.remove('active');
    document.body.style.overflow = 'auto';
}

// Close lightbox with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeLightbox();
    }
});

// Share functions
function copyLink() {
    const url = window.location.href;
    
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(url).then(() => {
            alert('✅ Link berhasil disalin ke clipboard!');
        }).catch(() => {
            fallbackCopyText(url);
        });
    } else {
        fallbackCopyText(url);
    }
}

function fallbackCopyText(text) {
    const textArea = document.createElement('textarea');
    textArea.value = text;
    textArea.style.position = 'fixed';
    textArea.style.left = '-999999px';
    document.body.appendChild(textArea);
    textArea.select();
    
    try {
        document.execCommand('copy');
        alert('✅ Link berhasil disalin!');
    } catch (err) {
        alert('❌ Gagal menyalin link. Silakan salin manual: ' + text);
    }
    
    document.body.removeChild(textArea);
}

function shareWhatsApp() {
    const title = '{{ $laporan->judul }}';
    const url = window.location.href;
    const text = encodeURIComponent(`Lihat laporan warga ini: "${title}"\n\n${url}`);
    window.open(`https://wa.me/?text=${text}`, '_blank');
}

function shareTwitter() {
    const title = '{{ $laporan->judul }}';
    const url = window.location.href;
    const text = encodeURIComponent(`Lihat laporan warga: "${title}"`);
    window.open(`https://twitter.com/intent/tweet?text=${text}&url=${encodeURIComponent(url)}`, '_blank');
}
</script>
@endpush