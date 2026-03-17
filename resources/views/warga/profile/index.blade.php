@extends('layouts.user')

@section('title', 'Profil Saya - Lapor Aja!')

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

    .profile-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1.5rem 1rem 4rem;
    }

    .profile-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .breadcrumb {
        font-size: 0.9rem;
        color: var(--text-muted);
        margin-bottom: 1rem;
    }

    .breadcrumb a {
        color: var(--primary);
        text-decoration: none;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .profile-header h2 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-dark);
        margin: 0.5rem 0 0.25rem;
    }

    .profile-badge {
        display: inline-block;
        padding: 0.4rem 1rem;
        background: rgba(79, 195, 247, 0.1);
        color: var(--primary);
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-top: 0.5rem;
    }

    .profile-grid {
        display: grid;
        grid-template-columns: 340px 1fr;
        gap: 2rem;
    }

    .profile-sidebar {
        background: var(--card-bg);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(129, 212, 250, 0.2);
        border-radius: var(--radius-lg);
        padding: 2rem;
        box-shadow: var(--shadow-soft);
        height: fit-content;
    }

    .avatar-section {
        text-align: center;
        margin-bottom: 2rem;
    }

    .profile-avatar {
        width: 140px;
        height: 140px;
        border-radius: 24px;
        object-fit: cover;
        border: 4px solid rgba(129, 212, 250, 0.3);
        box-shadow: 0 6px 20px rgba(79, 195, 247, 0.2);
        margin-bottom: 1.25rem;
    }

    .avatar-placeholder {
        width: 140px;
        height: 140px;
        border-radius: 24px;
        background: linear-gradient(135deg, var(--primary-soft), var(--primary));
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.25rem;
        color: white;
        font-size: 3.5rem;
        font-weight: bold;
        box-shadow: 0 6px 20px rgba(79, 195, 247, 0.3);
    }

    .btn-edit {
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 1rem;
    }

    .btn-edit:hover {
        background: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: var(--shadow-hover);
    }

    .profile-main {
        background: var(--card-bg);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(129, 212, 250, 0.2);
        border-radius: var(--radius-lg);
        padding: 2rem;
        box-shadow: var(--shadow-soft);
    }

    .section-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid rgba(129, 212, 250, 0.15);
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }

    .detail-item label {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .detail-item p {
        font-size: 1.05rem;
        color: var(--text-dark);
        font-weight: 500;
        margin: 0;
    }

    .security-section {
        margin-top: 2.5rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(129, 212, 250, 0.15);
    }

    .security-info {
        background: rgba(227, 242, 253, 0.4);
        border-radius: 12px;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }

    .security-info p {
        margin: 0;
        color: var(--text-muted);
    }

    .activity-placeholder {
        text-align: center;
        padding: 3rem 1rem;
        background: rgba(227, 242, 253, 0.3);
        border-radius: 16px;
        color: var(--text-muted);
    }

    @media (max-width: 992px) {
        .profile-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .profile-avatar, .avatar-placeholder {
            width: 110px;
            height: 110px;
        }
    }
</style>
@endpush

@section('content')
<div class="profile-container">

    <!-- Header -->
    <div class="profile-header">
        <div class="breadcrumb">
            <a href="{{ route('warga.dashboard') }}">Beranda</a> / Profil Saya
        </div>
        <h2>{{ Auth::user()->name ?? 'Warga RW 05' }}</h2>
        <span class="profile-badge">
            Warga {{ Auth::user()->rw ?? '05' }} / RT {{ Auth::user()->rt ?? '?' }} • Aktif
        </span>
    </div>

    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center gap-3 mb-4 rounded-3 shadow-sm">
            <i class="fas fa-check-circle fa-lg text-success"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="profile-grid">

        <!-- Sidebar Profile -->
        <div class="profile-sidebar">
            <div class="avatar-section">
                @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Foto Profil" class="profile-avatar">
                @else
                    <div class="avatar-placeholder">
                        {{ strtoupper(substr(Auth::user()->name ?? 'W', 0, 1)) }}
                    </div>
                @endif
                <h3 style="margin: 0.5rem 0 0.25rem;">{{ Auth::user()->name }}</h3>
                <p class="text-muted small mb-3">{{ Auth::user()->email }}</p>
            </div>

            <div class="text-center">
                <a href="{{ route('warga.profile.edit') }}" class="btn btn-edit">
                    <i class="fas fa-edit me-2"></i> Edit Profil
                </a>
            </div>

            <div class="mt-4">
                <div class="detail-item">
                    <label>Bergabung Sejak</label>
                    <p>{{ Auth::user()->created_at->format('d F Y') }}</p>
                </div>
                <div class="detail-item mt-3">
                    <label>No HP</label>
                    <p>{{ Auth::user()->no_hp ?? '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="profile-main">

            <!-- Informasi Personal -->
            <div class="mb-5">
                <h3 class="section-title">Informasi Personal</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <label>Nama Lengkap</label>
                        <p>{{ Auth::user()->name ?? '-' }}</p>
                    </div>
                    <div class="detail-item">
                        <label>NIK</label>
                        <p>{{ Auth::user()->nik ?? '-' }}</p>
                    </div>
                    <div class="detail-item">
                        <label>Tanggal Lahir</label>
                        <p>
                            {{ Auth::user()->tanggal_lahir 
                                ? \Carbon\Carbon::parse(Auth::user()->tanggal_lahir)->format('d F Y') 
                                : '-' }}
                        </p>
                    </div>
                    <div class="detail-item">
                        <label>Jenis Kelamin</label>
                        <p>{{ Auth::user()->gender ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Kontak & Wilayah -->
            <div class="mb-5">
                <h3 class="section-title">Kontak & Wilayah</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <label>Email</label>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                    <div class="detail-item">
                        <label>No HP</label>
                        <p>{{ Auth::user()->no_hp ?? '-' }}</p>
                    </div>
                    <div class="detail-item full-width">
                        <label>Alamat Lengkap</label>
                        <p>{{ Auth::user()->alamat ?? 'Belum diisi' }}</p>
                    </div>
                    <div class="detail-item">
                        <label>RW</label>
                        <p>{{ Auth::user()->rw ?? '05' }}</p>
                    </div>
                    <div class="detail-item">
                        <label>RT</label>
                        <p>{{ Auth::user()->rt ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Keamanan -->
            <div class="security-section">
                <h3 class="section-title">Keamanan Akun</h3>
                <div class="security-info">
                    <p class="mb-2">
                        <i class="fas fa-shield-alt text-primary me-2"></i>
                        Password terakhir diperbarui: {{ Auth::user()->password_changed_at 
                            ? Auth::user()->password_changed_at->diffForHumans() 
                            : Auth::user()->updated_at->diffForHumans() }}
                    </p>
                    <a href="{{ route('warga.profile.edit') . '#password' }}" class="btn btn-outline-secondary btn-sm mt-2">
                        <i class="fas fa-key me-2"></i>Ubah Password
                    </a>
                </div>
            </div>

            <!-- Aktivitas Terbaru (Placeholder) -->
            <div class="mt-5">
                <h3 class="section-title">Aktivitas Terbaru</h3>
                <div class="activity-placeholder">
                    <i class="far fa-clock fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada aktivitas terbaru yang tercatat.</p>
                    <small>Anda bisa melihat riwayat laporan di menu "Laporan Saya"</small>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection