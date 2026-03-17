@extends('layouts.user')

@section('title', 'Detail Saran - Lapor Aja!')

@push('styles')
<style>
    :root {
        --primary: #4fc3f7;
        --primary-dark: #0288d1;
        --primary-soft: #81d4fa;
        --text-dark: #1e293b;
        --text-muted: #64748b;
        --card-bg: rgba(255, 255, 255, 0.78);
        --shadow-soft: 0 8px 32px rgba(79, 195, 247, 0.12);
        --shadow-hover: 0 12px 40px rgba(79, 195, 247, 0.22);
        --radius-lg: 20px;
        --radius-md: 16px;
    }

    .detail-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1.5rem 1rem 5rem;
    }

    .header-section {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-bottom: 2.5rem;
    }

    @media (min-width: 768px) {
        .header-section {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }
    }

    .saran-main {
        background: var(--card-bg);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(129, 212, 250, 0.2);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-soft);
        overflow: hidden;
    }

    .status-badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        color: white;
        backdrop-filter: blur(6px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    .status-menunggu { background: rgba(249, 115, 22, 0.9); }
    .status-dibaca    { background: rgba(59, 130, 246, 0.9); }
    .status-ditinjau  { background: rgba(111, 66, 193, 0.9); }
    .status-diterapkan{ background: rgba(34, 197, 94, 0.9); }
    .status-ditolak   { background: rgba(239, 68, 68, 0.9); }

    .tanggapan-box {
        background: rgba(34, 197, 94, 0.08);
        border-radius: 12px;
        padding: 1.5rem;
        margin: 2rem 0;
        border-left: 4px solid #22c55e;
    }

    .meta-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1.25rem;
        margin-bottom: 2rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .meta-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: rgba(79, 195, 247, 0.1);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
    }

    .meta-label {
        font-size: 0.85rem;
        color: var(--text-muted);
        font-weight: 500;
    }

    .meta-value {
        font-weight: 600;
        color: var(--text-dark);
    }

    .description {
        font-size: 1.05rem;
        line-height: 1.8;
        color: var(--text-dark);
        white-space: pre-line;
    }

    .sidebar-card {
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(129, 212, 250, 0.2);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-soft);
        padding: 1.5rem;
    }

    .btn-action {
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .btn-action:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-hover);
    }

    @media (max-width: 992px) {
        .sidebar-card { margin-top: 1.5rem; }
    }
</style>
@endpush

@section('content')
<div class="detail-container">

    <!-- Header -->
    <div class="header-section">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('warga.saran.index') }}" class="btn btn-light rounded-circle shadow-sm p-3" style="width:48px;height:48px;display:flex;align-items:center;justify-content:center;">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="fw-bold mb-1" style="color: var(--primary-dark);">Detail Saran</h2>
                <p class="text-muted mb-0">ID: #{{ str_pad($saran->id, 5, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>

        <span class="status-badge status-{{ $saran->status }}">
            {{ ucfirst($saran->status) }}
        </span>
    </div>

    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="saran-main">

                <div class="p-4 p-md-5">
                    <h3 class="fw-bold mb-4" style="color: var(--primary-dark);">
                        {{ $saran->judul }}
                    </h3>

                    <!-- Meta Info -->
                    <div class="meta-grid mb-5">
                        <div class="meta-item">
                            <div class="meta-icon"><i class="fas fa-calendar-alt"></i></div>
                            <div>
                                <div class="meta-label">Tanggal Dikirim</div>
                                <div class="meta-value">{{ $saran->created_at->format('d F Y, H:i') }}</div>
                            </div>
                        </div>

                        <div class="meta-item">
                            <div class="meta-icon"><i class="fas fa-user"></i></div>
                            <div>
                                <div class="meta-label">Pengirim</div>
                                <div class="meta-value">{{ $saran->user->name ?? 'Warga' }}</div>
                            </div>
                        </div>

                        <div class="meta-item">
                            <div class="meta-icon"><i class="fas fa-clock"></i></div>
                            <div>
                                <div class="meta-label">Waktu Lalu</div>
                                <div class="meta-value">{{ $saran->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Saran -->
                    <div class="mb-5">
                        <h5 class="fw-bold mb-3" style="color: var(--primary-dark);">
                            <i class="fas fa-lightbulb me-2"></i>Detail Saran
                        </h5>
                        <div class="description">
                            {{ $saran->isi }}
                        </div>
                    </div>

                    <!-- Tanggapan Admin -->
                    @if($saran->tanggapan_admin)
                        <div class="tanggapan-box">
                            <h5 class="fw-bold mb-3" style="color: #166534;">
                                <i class="fas fa-reply me-2"></i>Tanggapan Admin
                            </h5>
                            <p class="mb-3" style="white-space: pre-line;">
                                {{ $saran->tanggapan_admin }}
                            </p>
                            @if($saran->tanggapan_at)
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>
                                    {{ $saran->tanggapan_at->format('d M Y, H:i') }}
                                </small>
                            @endif

                            <!-- Status Akhir -->
                            <div class="mt-4 pt-3 border-top">
                                @if($saran->status == 'diterapkan')
                                    <div class="alert alert-success border-0 mb-0" style="background: rgba(34,197,94,0.1);">
                                        <i class="fas fa-check-circle me-2"></i>
                                        <strong>Selamat!</strong> Saran Anda akan diterapkan atau sudah diterapkan.
                                    </div>
                                @elseif($saran->status == 'ditolak')
                                    <div class="alert alert-warning border-0 mb-0" style="background: rgba(249,115,22,0.1);">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Mohon maaf, saran ini tidak dapat diterapkan saat ini. Terima kasih atas partisipasi Anda.
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info border-0 text-center py-5" style="background: rgba(59,130,246,0.08); border-radius: 12px;">
                            <i class="fas fa-hourglass-half fa-3x text-info mb-3"></i>
                            <h5 class="fw-bold mb-2">Menunggu Tanggapan</h5>
                            <p class="text-muted mb-0">Saran Anda sedang ditinjau oleh pengurus RW. Anda akan mendapat notifikasi jika ada tanggapan.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Info Card -->
            <div class="sidebar-card mb-4">
                <h6 class="fw-bold mb-3" style="color: var(--primary-dark);">
                    <i class="fas fa-info-circle me-2"></i>Informasi Saran
                </h6>

                <div class="mb-3 pb-3 border-bottom">
                    <small class="text-muted d-block mb-1">ID Saran</small>
                    <span class="fw-semibold">#{{ str_pad($saran->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>

                <div class="mb-3 pb-3 border-bottom">
                    <small class="text-muted d-block mb-1">Status</small>
                    <span class="status-badge status-{{ $saran->status }}">
                        {{ ucfirst($saran->status) }}
                    </span>
                </div>

                <div class="mb-3 pb-3 border-bottom">
                    <small class="text-muted d-block mb-1">Dibuat pada</small>
                    <span class="fw-semibold">{{ $saran->created_at->format('d M Y, H:i') }}</span>
                </div>

                <div>
                    <small class="text-muted d-block mb-1">Terakhir diupdate</small>
                    <span class="fw-semibold">{{ $saran->updated_at->format('d M Y, H:i') }}</span>
                </div>
            </div>

            <!-- Action Card -->
            @if(!$saran->tanggapan_admin)
                <div class="sidebar-card mb-4">
                    <h6 class="fw-bold mb-3" style="color: var(--primary-dark);">
                        <i class="fas fa-cog me-2"></i>Aksi yang Tersedia
                    </h6>
                    <p class="small text-muted mb-3">Karena belum ada tanggapan, Anda masih bisa mengedit atau menghapus saran ini.</p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('warga.saran.edit', $saran->id) }}" class="btn btn-warning btn-action">
                            <i class="fas fa-edit me-2"></i> Edit Saran
                        </a>
                        <form action="{{ route('warga.saran.destroy', $saran->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus saran ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-action w-100">
                                <i class="fas fa-trash me-2"></i> Hapus Saran
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="sidebar-card mb-4 text-center">
                    <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                        <i class="fas fa-lock fa-lg text-info"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Saran Terkunci</h6>
                    <p class="text-muted small">Saran yang sudah ditanggapi tidak dapat diedit atau dihapus lagi.</p>
                </div>
            @endif

            <!-- Help Card -->
            <div class="sidebar-card">
                <h6 class="fw-bold mb-3" style="color: var(--primary-dark);">
                    <i class="fas fa-question-circle me-2"></i>Butuh Bantuan?
                </h6>
                <p class="small text-muted mb-0">
                    Jika ada pertanyaan atau butuh klarifikasi terkait tanggapan, silakan hubungi pengurus RW melalui menu kontak atau WhatsApp resmi RW.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection