@extends('layouts.user')

@section('title', 'Saran Saya - Lapor Aja!')

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

    .saran-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1.5rem 1rem 5rem;
    }

    .header-section {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        margin-bottom: 2.5rem;
        gap: 1rem;
    }

    @media (min-width: 768px) {
        .header-section {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.25rem;
        margin-bottom: 2.5rem;
    }

    .stats-card {
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(129, 212, 250, 0.2);
        border-radius: var(--radius-md);
        padding: 1.5rem;
        box-shadow: var(--shadow-soft);
        transition: all 0.3s ease;
        text-align: center;
    }

    .stats-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-hover);
    }

    .stats-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        margin: 0 auto 1rem;
    }

    .stats-value {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--text-dark);
    }

    .stats-label {
        font-size: 0.9rem;
        color: var(--text-muted);
        font-weight: 500;
    }

    .saran-card {
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(129, 212, 250, 0.2);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-soft);
        transition: all 0.3s ease;
        height: 100%;
    }

    .saran-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-hover);
    }

    .status-badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.8rem;
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

    .saran-preview {
        font-size: 0.95rem;
        color: var(--text-muted);
        line-height: 1.5;
        margin-bottom: 1.25rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .meta-info {
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .tanggapan-preview {
        background: rgba(34, 197, 94, 0.08);
        border-radius: 10px;
        padding: 0.75rem;
        margin: 1rem 0;
        font-size: 0.9rem;
        color: #166534;
    }

    .empty-state {
        text-align: center;
        padding: 6rem 2rem;
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        border: 2px dashed rgba(129, 212, 250, 0.3);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-soft);
    }

    .empty-icon {
        font-size: 5rem;
        color: #cbd5e1;
        margin-bottom: 1.5rem;
    }

    .btn-create {
        background: var(--primary);
        border: none;
        border-radius: 12px;
        padding: 0.85rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-create:hover {
        background: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: var(--shadow-hover);
    }

    @media (max-width: 768px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .stats-value { font-size: 1.8rem; }
    }
</style>
@endpush

@section('content')
<div class="saran-container">

    <!-- Header -->
    <div class="header-section">
        <div>
            <h2 class="fw-bold mb-1" style="color: var(--primary-dark);">Saran Saya</h2>
            <p class="text-muted mb-0">Kelola dan pantau semua saran yang kamu kirimkan ke RW</p>
        </div>
        <a href="{{ route('warga.saran.create') }}" class="btn btn-create shadow">
            <i class="fas fa-plus-circle me-2"></i> Buat Saran Baru
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center gap-3 mb-4 rounded-3 shadow-sm">
            <i class="fas fa-check-circle fa-lg"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- Statistics -->
    <div class="stats-grid">
        <div class="stats-card">
            <div class="stats-icon" style="background: rgba(79, 195, 247, 0.15); color: var(--primary);">
                <i class="fas fa-lightbulb"></i>
            </div>
            <div class="stats-value">{{ $saran->total() }}</div>
            <div class="stats-label">Total Saran</div>
        </div>

        <div class="stats-card">
            <div class="stats-icon" style="background: rgba(249, 115, 22, 0.15); color: #f97316;">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stats-value text-warning">{{ $saran->where('status', 'menunggu')->count() }}</div>
            <div class="stats-label">Menunggu</div>
        </div>

        <div class="stats-card">
            <div class="stats-icon" style="background: rgba(34, 197, 94, 0.15); color: #22c55e;">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stats-value text-success">{{ $saran->where('status', 'diterapkan')->count() }}</div>
            <div class="stats-label">Diterapkan</div>
        </div>

        <div class="stats-card">
            <div class="stats-icon" style="background: rgba(239, 68, 68, 0.15); color: #ef4444;">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stats-value text-danger">{{ $saran->where('status', 'ditolak')->count() }}</div>
            <div class="stats-label">Ditolak</div>
        </div>
    </div>

    <!-- Saran List -->
    @if($saran->count() > 0)
        <div class="row g-4">
            @foreach($saran as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="saran-card">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="status-badge status-{{ $item->status }}">
                                    {{ ucfirst($item->status) }}
                                </span>

                                @if($item->tanggapan_admin)
                                    <span class="badge bg-success bg-opacity-75 text-white px-3 py-1">
                                        <i class="fas fa-reply me-1"></i> Ditanggapi
                                    </span>
                                @endif
                            </div>

                            <h5 class="fw-bold mb-2">{{ Str::limit($item->judul, 55) }}</h5>

                            <p class="saran-preview">
                                {{ Str::limit($item->isi, 110) }}
                            </p>

                            <div class="meta-info d-flex gap-4 mb-3">
                                <span><i class="fas fa-calendar-alt me-1"></i>{{ $item->created_at->format('d M Y') }}</span>
                                <span><i class="fas fa-clock me-1"></i>{{ $item->created_at->diffForHumans() }}</span>
                            </div>

                            @if($item->tanggapan_admin)
                                <div class="tanggapan-preview">
                                    <strong>Tanggapan Admin:</strong><br>
                                    {{ Str::limit($item->tanggapan_admin, 80) }}
                                </div>
                            @endif

                            <div class="d-flex gap-2 mt-3">
                                <a href="{{ route('warga.saran.show', $item->id) }}" 
                                   class="btn btn-primary btn-sm flex-fill rounded-pill">
                                    <i class="fas fa-eye me-1"></i> Detail
                                </a>

                                @if(!$item->tanggapan_admin)
                                    <a href="{{ route('warga.saran.edit', $item->id) }}" 
                                       class="btn btn-outline-secondary btn-sm rounded-pill">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('warga.saran.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill"
                                                onclick="return confirm('Yakin hapus saran ini?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @else
                                    <span class="badge bg-secondary align-self-center px-3 py-2">
                                        <i class="fas fa-lock me-1"></i> Terkunci
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $saran->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    @else
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-icon">
                <i class="far fa-lightbulb"></i>
            </div>
            <h4 class="fw-bold mb-3">Belum Ada Saran</h4>
            <p class="text-muted mb-4 lead">
                Kamu belum pernah mengirimkan saran atau ide untuk RW 05.<br>
                Yuk, bagikan pemikiranmu sekarang!
            </p>
            <a href="{{ route('warga.saran.create') }}" class="btn btn-create btn-lg shadow">
                <i class="fas fa-plus-circle me-2"></i> Buat Saran Pertama
            </a>
        </div>
    @endif

</div>
@endsection