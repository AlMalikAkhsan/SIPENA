@extends('layouts.user')

@section('title', 'Beranda - Lapor Aja!')

@push('styles')
<style>
    :root {
        --bg: #f9fafb;
        --surface: #ffffff;
        --primary: #3b82f6;
        --primary-dark: #1d4ed8;
        --primary-light: #60a5fa;
        --accent: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --text: #111827;
        --text-muted: #6b7280;
        --border: #e5e7eb;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
        --shadow-md: 0 4px 12px rgba(0,0,0,0.08);
        --radius: 16px;
        --transition: all 0.22s ease;
    }

    body {
        background: var(--bg);
    }

    .container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 1.5rem 1rem 6rem;
    }

    /* Welcome */
    .welcome {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-radius: var(--radius);
        padding: 2.5rem 2rem;
        margin-bottom: 2.5rem;
        box-shadow: var(--shadow-md);
        color: white;
    }

    .welcome h1 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0 0 0.5rem;
    }

    .welcome p {
        font-size: 1.05rem;
        margin: 0;
        opacity: 0.95;
    }

    /* Stats */
    .stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1.25rem;
        margin-bottom: 2.5rem;
    }

    .stat {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.5rem;
        text-align: center;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
    }

    .stat:hover {
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

    .stat-icon.blue   { background: rgba(59,130,246,0.1); color: var(--primary); }
    .stat-icon.orange { background: rgba(245,158,11,0.1);  color: var(--warning); }
    .stat-icon.green  { background: rgba(16,185,129,0.1);  color: var(--accent); }
    .stat-icon.red    { background: rgba(239,68,68,0.1);   color: var(--danger); }

    .stat-value {
        font-size: 2.4rem;
        font-weight: 800;
        color: var(--text);
        line-height: 1;
    }

    .stat-label {
        font-size: 0.95rem;
        color: var(--text-muted);
        margin-top: 0.4rem;
        font-weight: 500;
    }

    /* Quick Actions */
    .quick {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.75rem;
        margin-bottom: 2.5rem;
        box-shadow: var(--shadow-sm);
    }

    .section-title {
        font-size: 1.35rem;
        font-weight: 700;
        color: var(--text);
        margin: 0 0 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 1rem;
    }

    .action {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
        padding: 1.25rem 1rem;
        background: rgba(243,244,246,0.6);
        border: 1px solid var(--border);
        border-radius: 14px;
        text-decoration: none;
        color: var(--text);
        font-weight: 600;
        font-size: 0.95rem;
        transition: var(--transition);
    }

    .action:hover {
        background: rgba(243,244,246,0.9);
        border-color: var(--primary-light);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
        color: var(--text);
    }

    .action i {
        font-size: 1.85rem;
        color: var(--primary);
    }

    /* Reports Section */
    .reports-section {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.75rem;
        box-shadow: var(--shadow-sm);
    }

    .reports-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-top: 1.5rem;
    }

    /* Report Card */
    .report-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        display: flex;
        flex-direction: column;
    }

    .report-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.1);
        border-color: var(--primary-light);
    }

    .report-image {
        height: 180px;
        position: relative;
        background: #f3f4f6;
        overflow: hidden;
    }

    .report-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .report-placeholder {
        height: 180px;
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9ca3af;
        font-size: 3.5rem;
    }

    .status-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        padding: 0.45rem 1rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        backdrop-filter: blur(10px);
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

    .report-body {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .report-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
        gap: 1rem;
    }

    .report-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--text);
        line-height: 1.4;
        margin: 0;
        flex: 1;
    }

    .report-desc {
        font-size: 0.92rem;
        color: var(--text-muted);
        line-height: 1.6;
        margin-bottom: 1.25rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .report-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid var(--border);
        margin-top: auto;
    }

    .report-date {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .report-date i {
        color: var(--primary);
    }

    .btn-detail {
        padding: 0.5rem 1.25rem;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.88rem;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-detail:hover {
        background: var(--primary-dark);
        transform: translateX(2px);
        color: white;
    }

    .report-actions {
        display: flex;
        gap: 0.75rem;
        padding: 0 1.5rem 1.5rem;
    }

    .btn-edit,
    .btn-delete {
        flex: 1;
        padding: 0.6rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.88rem;
        text-decoration: none;
        text-align: center;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-edit {
        background: rgba(59,130,246,0.1);
        color: var(--primary);
        border: 1px solid var(--primary-light);
    }

    .btn-edit:hover {
        background: var(--primary);
        color: white;
    }

    .btn-delete {
        background: rgba(239,68,68,0.1);
        color: var(--danger);
        border: 1px solid #fecaca;
    }

    .btn-delete:hover {
        background: var(--danger);
        color: white;
        border-color: var(--danger);
    }

    .btn-archive {
        width: 100%;
        padding: 0.6rem 1rem;
        background: rgba(107,114,128,0.1);
        color: var(--text-muted);
        border: 1px solid var(--border);
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.88rem;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-archive:hover {
        background: var(--text-muted);
        color: white;
        border-color: var(--text-muted);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: var(--surface);
        border: 2px dashed var(--border);
        border-radius: var(--radius);
        color: var(--text-muted);
    }

    .empty-state i {
        font-size: 4.5rem;
        color: #d1d5db;
        margin-bottom: 1.5rem;
    }

    .empty-state h3 {
        font-size: 1.4rem;
        color: var(--text);
        margin-bottom: 0.75rem;
        font-weight: 700;
    }

    .empty-state p {
        font-size: 1rem;
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
        transition: var(--transition);
        box-shadow: 0 4px 12px rgba(59,130,246,0.2);
    }

    .btn-primary-action:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(59,130,246,0.3);
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .welcome {
            padding: 2rem 1.5rem;
        }
        
        .welcome h1 {
            font-size: 1.7rem;
        }
        
        .stats {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .actions {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .reports-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .stats,
        .actions {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="container">

    <!-- Welcome -->
    <div class="welcome">
        <h1>Halo, {{ Auth::user()->name }}! 👋</h1>
        <p>Selamat datang kembali. Laporkan apa saja dengan mudah dan ikuti prosesnya di sini.</p>
    </div>

    <!-- Stats -->
    <div class="stats">
        <div class="stat">
            <div class="stat-icon blue"><i class="fas fa-file-alt"></i></div>
            <div class="stat-value">{{ $total ?? 0 }}</div>
            <div class="stat-label">Total Laporan</div>
        </div>
        <div class="stat">
            <div class="stat-icon orange"><i class="fas fa-clock"></i></div>
            <div class="stat-value">{{ $menunggu ?? 0 }}</div>
            <div class="stat-label">Menunggu</div>
        </div>
        <div class="stat">
            <div class="stat-icon blue"><i class="fas fa-tasks"></i></div>
            <div class="stat-value">{{ $diproses ?? 0 }}</div>
            <div class="stat-label">Diproses</div>
        </div>
        <div class="stat">
            <div class="stat-icon green"><i class="fas fa-check-circle"></i></div>
            <div class="stat-value">{{ $selesai ?? 0 }}</div>
            <div class="stat-label">Selesai</div>
        </div>
        <div class="stat">
            <div class="stat-icon red"><i class="fas fa-times-circle"></i></div>
            <div class="stat-value">{{ $ditolak ?? 0 }}</div>
            <div class="stat-label">Ditolak</div>
        </div>
    </div>

    <!-- Reports Section -->
    <div class="reports-section">
        <h2 class="section-title"><i class="fas fa-folder-open"></i> Laporan Terbaru Saya</h2>
        
        @if($laporan->count() > 0)
            <div class="reports-grid">
                @foreach($laporan as $item)
                    <div class="report-card">
                        @if($item->fotos && $item->fotos->count() > 0)
                        <div class="report-image">
                            <img src="{{ asset('storage/' . $item->fotos->first()->foto_path) }}" 
                                 alt="{{ $item->judul }}"
                                 loading="lazy">
                            <span class="status-badge status-{{ $item->status }}">
                                <span class="status-dot bg-white"></span>
                                {{ ucfirst($item->status) }}
                            </span>
                        </div>
                        @else
                            <div class="report-placeholder">
                                <i class="far fa-image"></i>
                                <span class="status-badge status-{{ $item->status }}">
                                    <span class="status-dot bg-white"></span>
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>
                        @endif

                        <div class="report-body">
                            <h3 class="report-title">{{ Str::limit($item->judul, 60) }}</h3>
                            <p class="report-desc">{{ Str::limit($item->isi, 120) }}</p>
                            
                            <div class="report-footer">
                                <div class="report-date">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>{{ $item->created_at->format('d M Y') }}</span>
                                </div>
                                <a href="{{ route('warga.laporan.show', $item->id) }}" class="btn-detail">
                                    Detail
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                        @if($item->status == 'menunggu')
                            <div class="report-actions">
                                <a href="{{ route('warga.laporan.edit', $item->id) }}" class="btn-edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button type="button" class="btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Hapus Laporan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus laporan "<strong>{{ $item->judul }}</strong>"?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('warga.laporan.destroy', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($item->status == 'selesai')
                            <div class="report-actions">
                                <form action="{{ route('warga.laporan.archive', $item->id) }}" method="POST" style="width: 100%; padding: 0 1.5rem 1.5rem;">
                                    @csrf
                                    <button type="submit" class="btn-archive">
                                        <i class="fas fa-archive"></i> Arsipkan
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($laporan->hasPages())
                <div class="mt-4">
                    {{ $laporan->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <i class="far fa-folder-open"></i>
                <h3>Belum Ada Laporan</h3>
                <p>Mulai buat laporan pertama kamu untuk lingkungan yang lebih baik!</p>
                <a href="{{ route('warga.laporan.create') }}" class="btn-primary-action">
                    <i class="fas fa-plus-circle"></i> Buat Laporan Baru
                </a>
            </div>
        @endif
    </div>

</div>
@endsection

@push('scripts')
<script>
// Optional: Add any additional interactivity here
</script>
@endpush