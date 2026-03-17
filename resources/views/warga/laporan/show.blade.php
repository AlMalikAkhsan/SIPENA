@extends('layouts.user')

@section('title', 'Detail Laporan - Lapor Aja!')

@push('styles')
<style>
    :root {
        --primary: #3b82f6;
        --primary-dark: #1d4ed8;
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

    /* Header Section */
    .detail-header {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.75rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
        display: flex;
        align-items: center;
        gap: 1.5rem;
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

    .header-info {
        flex: 1;
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
        gap: 1rem;
        flex-wrap: wrap;
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    /* Photo Gallery Section */
    .photo-section {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.75rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
        position: relative;
    }

    .main-photo-wrapper {
        position: relative;
        width: 100%;
        height: 450px;
        border-radius: 14px;
        overflow: hidden;
        margin-bottom: 1.25rem;
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
    }

    .main-photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
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

    .photo-placeholder p {
        font-size: 1.1rem;
        margin: 0;
    }

    /* Status Badge - IMPROVED */
    .status-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        padding: 0.75rem 1.5rem;
        border-radius: 999px;
        font-size: 0.95rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.2);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        gap: 0.5rem;
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

    .status-badge i {
        font-size: 1.1rem;
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
            box-shadow: 0 4px 24px rgba(239, 68, 68, 0.6);
        }
    }

    /* Thumbnail Gallery */
    .thumbnail-gallery {
        display: flex;
        gap: 0.75rem;
        overflow-x: auto;
        padding: 0.5rem 0;
    }

    .thumbnail-gallery::-webkit-scrollbar {
        height: 6px;
    }

    .thumbnail-gallery::-webkit-scrollbar-track {
        background: var(--bg);
        border-radius: 3px;
    }

    .thumbnail-gallery::-webkit-scrollbar-thumb {
        background: var(--border);
        border-radius: 3px;
    }

    .thumbnail-gallery::-webkit-scrollbar-thumb:hover {
        background: var(--text-muted);
    }

    .thumbnail-item {
        width: 100px;
        height: 100px;
        border-radius: 10px;
        overflow: hidden;
        cursor: pointer;
        border: 3px solid transparent;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .thumbnail-item:hover {
        border-color: var(--primary);
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

    /* Content Section */
    .content-section {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text);
        margin: 0 0 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-title i {
        color: var(--primary);
        font-size: 1.3rem;
    }

    .info-grid {
        display: grid;
        gap: 1.25rem;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .info-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-value {
        font-size: 1rem;
        color: var(--text);
        line-height: 1.6;
    }

    .info-value.large {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text);
    }

    .description-text {
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 1.5rem;
        line-height: 1.8;
        color: var(--text);
        font-size: 1rem;
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

    .status-card {
        text-align: center;
        padding: 2rem 1.5rem;
    }

    .status-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.25rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
    }

    .status-icon.menunggu {
        background: rgba(245,158,11,0.1);
        color: var(--warning);
    }

    .status-icon.diproses {
        background: rgba(59,130,246,0.1);
        color: var(--primary);
    }

    .status-icon.selesai {
        background: rgba(16,185,129,0.1);
        color: var(--success);
    }

    .status-icon.ditolak {
        background: rgba(239,68,68,0.1);
        color: var(--danger);
    }

    .status-title {
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        color: var(--text);
    }

    .status-desc {
        color: var(--text-muted);
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
    }

    .status-meta {
        background: var(--bg);
        border-radius: 10px;
        padding: 1rem;
    }

    .status-meta-item {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        border-bottom: 1px solid var(--border);
    }

    .status-meta-item:last-child {
        border-bottom: none;
    }

    .meta-label {
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .meta-value {
        font-weight: 600;
        color: var(--text);
        font-size: 0.9rem;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .btn-action {
        padding: 0.85rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        border: none;
        font-size: 0.95rem;
    }

    .btn-edit {
        background: var(--primary);
        color: white;
    }

    .btn-edit:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59,130,246,0.3);
        color: white;
    }

    .btn-delete {
        background: rgba(239,68,68,0.1);
        color: var(--danger);
        border: 1px solid rgba(239,68,68,0.3);
    }

    .btn-delete:hover {
        background: var(--danger);
        color: white;
        border-color: var(--danger);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239,68,68,0.3);
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
            height: 280px;
        }

        .status-badge {
            top: 12px;
            right: 12px;
            padding: 0.6rem 1.2rem;
            font-size: 0.8rem;
        }

        .content-section {
            padding: 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<div class="detail-container">

    <!-- Header -->
    <div class="detail-header">
        <a href="{{ route('warga.laporan.index') }}" class="back-button">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div class="header-info">
            <h1>Detail Laporan</h1>
            <div class="header-meta">
                <span><i class="fas fa-hashtag"></i> ID: #{{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</span>
                <span><i class="fas fa-user"></i> {{ $laporan->user->name }}</span>
                <span><i class="fas fa-calendar-alt"></i> {{ $laporan->created_at->format('d M Y, H:i') }}</span>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            
            <!-- Photo Section -->
            <div class="photo-section">
                <div class="main-photo-wrapper">
                    @if($laporan->fotos && $laporan->fotos->count() > 0)
                        <img src="{{ asset('storage/' . $laporan->fotos->first()->foto_path) }}" 
                             alt="{{ $laporan->judul }}" 
                             class="main-photo"
                             id="mainPhoto">
                        
                        <!-- Status Badge with Better Styling -->
                        <div class="status-badge status-{{ $laporan->status }}">
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
                    @else
                        <div class="photo-placeholder">
                            <i class="far fa-image"></i>
                            <p>Tidak ada foto</p>
                        </div>
                        <div class="status-badge status-{{ $laporan->status }}">
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
                    @endif
                </div>

                <!-- Thumbnails -->
                @if($laporan->fotos && $laporan->fotos->count() > 1)
                    <div class="thumbnail-gallery">
                        @foreach($laporan->fotos as $index => $foto)
                            <div class="thumbnail-item {{ $index == 0 ? 'active' : '' }}" 
                                 onclick="changeMainPhoto('{{ asset('storage/' . $foto->foto_path) }}', this)">
                                <img src="{{ asset('storage/' . $foto->foto_path) }}" alt="Foto {{ $index + 1 }}">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Informasi Laporan -->
            <div class="content-section">
                <h2 class="section-title">
                    <i class="fas fa-info-circle"></i>
                    Informasi Laporan
                </h2>
                
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Judul Laporan</div>
                        <div class="info-value large">{{ $laporan->judul }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Deskripsi Lengkap</div>
                        <div class="description-text">{{ $laporan->isi }}</div>
                    </div>

                    @if($laporan->lokasi)
                        <div class="info-item">
                            <div class="info-label">
                                <i class="fas fa-map-marker-alt"></i> Lokasi
                            </div>
                            <div class="info-value">{{ $laporan->lokasi }}</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Response Admin (jika ada) -->
            @if($laporan->response)
                <div class="content-section">
                    <h2 class="section-title">
                        <i class="fas fa-reply"></i>
                        Tanggapan Admin
                    </h2>
                    <div class="description-text">
                        {{ $laporan->response }}
                    </div>
                    @if($laporan->responded_at)
                        <div class="text-muted small mt-3">
                            <i class="fas fa-clock"></i> 
                            Ditanggapi pada {{ $laporan->responded_at->format('d M Y, H:i') }}
                        </div>
                    @endif
                </div>
            @endif

        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            
            <!-- Status Card -->
            <div class="sidebar-card status-card">
                <div class="status-icon {{ $laporan->status }}">
                    @if($laporan->status == 'menunggu')
                        <i class="fas fa-clock"></i>
                    @elseif($laporan->status == 'diproses')
                        <i class="fas fa-spinner fa-spin"></i>
                    @elseif($laporan->status == 'selesai')
                        <i class="fas fa-check-circle"></i>
                    @else
                        <i class="fas fa-times-circle"></i>
                    @endif
                </div>
                
                <h3 class="status-title">{{ ucfirst($laporan->status) }}</h3>
                
                <p class="status-desc">
                    @if($laporan->status == 'menunggu')
                        Laporan Anda sedang menunggu untuk direview oleh admin
                    @elseif($laporan->status == 'diproses')
                        Laporan Anda sedang ditangani oleh tim kami
                    @elseif($laporan->status == 'selesai')
                        Laporan Anda telah selesai ditangani
                    @else
                        Laporan Anda ditolak. Silakan periksa tanggapan admin
                    @endif
                </p>

                <div class="status-meta">
                    <div class="status-meta-item">
                        <span class="meta-label">Dibuat</span>
                        <span class="meta-value">{{ $laporan->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="status-meta-item">
                        <span class="meta-label">Update Terakhir</span>
                        <span class="meta-value">{{ $laporan->updated_at->format('d M Y') }}</span>
                    </div>
                    @if($laporan->fotos)
                        <div class="status-meta-item">
                            <span class="meta-label">Jumlah Foto</span>
                            <span class="meta-value">{{ $laporan->fotos->count() }} foto</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            @if($laporan->status == 'menunggu')
                <div class="sidebar-card">
                    <h3 class="section-title" style="font-size: 1.1rem; margin-bottom: 1rem;">
                        <i class="fas fa-cog"></i>
                        Aksi
                    </h3>
                    <div class="action-buttons">
                        <a href="{{ route('warga.laporan.edit', $laporan->id) }}" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i>
                            Edit Laporan
                        </a>
                        <button type="button" class="btn-action btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fas fa-trash-alt"></i>
                            Hapus Laporan
                        </button>
                    </div>
                </div>
            @endif

        </div>
    </div>

</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header bg-danger text-white border-0">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-4">
                <i class="fas fa-trash-alt text-danger" style="font-size: 4rem; margin-bottom: 1rem;"></i>
                <h5 class="fw-bold mb-3">Yakin hapus laporan ini?</h5>
                <p class="text-muted mb-4">
                    Laporan "<strong>{{ $laporan->judul }}</strong>" akan dihapus permanen dan tidak bisa dikembalikan.
                </p>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-4">
                <button type="button" class="btn btn-light px-4 rounded-pill" data-bs-dismiss="modal">
                    Batal
                </button>
                <form action="{{ route('warga.laporan.destroy', $laporan->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4 rounded-pill">
                        <i class="fas fa-trash-alt me-2"></i>
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Change main photo when clicking thumbnail
function changeMainPhoto(src, element) {
    document.getElementById('mainPhoto').src = src;
    
    // Update active state
    document.querySelectorAll('.thumbnail-item').forEach(item => {
        item.classList.remove('active');
    });
    element.classList.add('active');
}

// Optional: Add lightbox functionality
document.getElementById('mainPhoto')?.addEventListener('click', function() {
    // You can add lightbox/modal functionality here
    console.log('Image clicked - add lightbox if needed');
});
</script>
@endpush