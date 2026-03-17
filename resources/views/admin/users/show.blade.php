@extends('layouts.app')

@section('content')
<style>
    .show-header {
        background: var(--card-bg);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .back-button {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: var(--light-bg);
        border: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-primary);
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .back-button:hover {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .header-title {
        display: flex;
        flex-direction: column;
    }

    .page-title-show {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
    }

    .page-subtitle-show {
        font-size: 0.875rem;
        color: var(--text-secondary);
    }

    .header-actions {
        display: flex;
        gap: 0.75rem;
    }

    .btn-action-header {
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-edit-header {
        background: var(--success-color);
        color: white;
    }

    .btn-edit-header:hover {
        background: #00A844;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 200, 83, 0.3);
    }

    .btn-delete-header {
        background: var(--danger-color);
        color: white;
    }

    .btn-delete-header:hover {
        background: #E63300;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(255, 61, 0, 0.3);
    }

    .profile-card {
        background: var(--card-bg);
        border-radius: 12px;
        border: 1px solid var(--border-color);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .profile-header {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        padding: 2.5rem;
        text-align: center;
        position: relative;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        font-weight: 700;
        color: white;
        margin: 0 auto 1.5rem;
        border: 4px solid rgba(255, 255, 255, 0.3);
    }

    .profile-name {
        font-size: 2rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.5rem;
    }

    .profile-email {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 1rem;
    }

    .profile-badges {
        display: flex;
        gap: 0.75rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .badge-show {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .badge-role-show {
        background: rgba(255, 255, 255, 0.25);
        color: white;
        backdrop-filter: blur(10px);
    }

    .badge-verified {
        background: rgba(0, 200, 83, 0.2);
        color: white;
        backdrop-filter: blur(10px);
    }

    .badge-unverified {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        backdrop-filter: blur(10px);
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .detail-card {
        background: var(--card-bg);
        border-radius: 12px;
        border: 1px solid var(--border-color);
        padding: 0;
        overflow: hidden;
    }

    .detail-card-header {
        background: var(--light-bg);
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .detail-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.125rem;
    }

    .detail-card-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    .detail-card-body {
        padding: 1.5rem;
    }

    .detail-item {
        display: flex;
        padding: 0.875rem 0;
        border-bottom: 1px solid var(--border-color);
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-label {
        flex: 0 0 140px;
        font-weight: 600;
        color: var(--text-secondary);
        font-size: 0.875rem;
    }

    .detail-value {
        flex: 1;
        color: var(--text-primary);
        font-size: 0.875rem;
        font-weight: 500;
    }

    .detail-value-empty {
        color: var(--text-secondary);
        font-style: italic;
    }

    .timeline-card {
        background: var(--card-bg);
        border-radius: 12px;
        border: 1px solid var(--border-color);
        padding: 0;
        overflow: hidden;
    }

    .timeline-header {
        background: var(--light-bg);
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .timeline-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    .timeline-body {
        padding: 1.5rem;
    }

    .timeline-item {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        position: relative;
    }

    .timeline-item:last-child {
        margin-bottom: 0;
    }

    .timeline-item:not(:last-child)::before {
        content: '';
        position: absolute;
        left: 20px;
        top: 40px;
        bottom: -24px;
        width: 2px;
        background: var(--border-color);
    }

    .timeline-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .timeline-content {
        flex: 1;
    }

    .timeline-date {
        font-size: 0.75rem;
        color: var(--text-secondary);
        margin-bottom: 0.25rem;
    }

    .timeline-text {
        font-size: 0.875rem;
        color: var(--text-primary);
        font-weight: 500;
    }

    .stats-mini {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .stat-mini-card {
        background: var(--card-bg);
        border-radius: 12px;
        border: 1px solid var(--border-color);
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .stat-mini-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        color: white;
    }

    .stat-mini-icon.purple {
        background: linear-gradient(135deg, #667eea, #764ba2);
    }

    .stat-mini-icon.orange {
        background: linear-gradient(135deg, #f093fb, #f5576c);
    }

    .stat-mini-icon.green {
        background: linear-gradient(135deg, #4facfe, #00f2fe);
    }

    .stat-mini-content h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
    }

    .stat-mini-content p {
        font-size: 0.75rem;
        color: var(--text-secondary);
        margin: 0;
    }

    @media (max-width: 992px) {
        .details-grid {
            grid-template-columns: 1fr;
        }

        .show-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .header-actions {
            width: 100%;
        }

        .btn-action-header {
            flex: 1;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .header-actions {
            flex-direction: column;
        }
    }
</style>

<!-- Page Header -->
<div class="show-header">
    <div class="header-left">
        <a href="{{ route('admin.users.index') }}" class="back-button">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div class="header-title">
            <h1 class="page-title-show">Detail User</h1>
            <p class="page-subtitle-show">Informasi lengkap pengguna</p>
        </div>
    </div>
    <div class="header-actions">
        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-action-header btn-edit-header">
            <i class="fas fa-edit"></i>
            <span>Edit</span>
        </a>
        <button type="button" onclick="deleteUser({{ $user->id }})" class="btn-action-header btn-delete-header">
            <i class="fas fa-trash"></i>
            <span>Hapus</span>
        </button>
    </div>
</div>

<!-- Profile Card -->
<div class="profile-card">
    <div class="profile-header">
        <div class="profile-avatar">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <h2 class="profile-name">{{ $user->name }}</h2>
        <p class="profile-email">{{ $user->email }}</p>
        <div class="profile-badges">
            <span class="badge-show badge-role-show">
                <i class="fas fa-{{ $user->role == 'admin' ? 'shield-alt' : 'user' }}"></i>
                {{ ucfirst($user->role) }}
            </span>
            @if($user->email_verified_at)
                <span class="badge-show badge-verified">
                    <i class="fas fa-check-circle"></i>
                    Email Verified
                </span>
            @else
                <span class="badge-show badge-unverified">
                    <i class="fas fa-times-circle"></i>
                    Not Verified
                </span>
            @endif
        </div>
    </div>
</div>

<!-- Stats Mini -->
<div class="stats-mini">
    <div class="stat-mini-card">
        <div class="stat-mini-icon purple">
            <i class="fas fa-calendar-check"></i>
        </div>
        <div class="stat-mini-content">
            <h3>{{ $user->created_at->diffInDays(now()) }}</h3>
            <p>Hari Terdaftar</p>
        </div>
    </div>
    
    <div class="stat-mini-card">
        <div class="stat-mini-icon orange">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-mini-content">
            <h3>{{ $user->updated_at->diffForHumans() }}</h3>
            <p>Update Terakhir</p>
        </div>
    </div>
    
    <div class="stat-mini-card">
        <div class="stat-mini-icon green">
            <i class="fas fa-user-clock"></i>
        </div>
        <div class="stat-mini-content">
            <h3>{{ $user->created_at->format('d M Y') }}</h3>
            <p>Tanggal Bergabung</p>
        </div>
    </div>
</div>

<!-- Details Grid -->
<div class="details-grid">
    <!-- Personal Information -->
    <div class="detail-card">
        <div class="detail-card-header">
            <div class="detail-icon">
                <i class="fas fa-user"></i>
            </div>
            <h3 class="detail-card-title">Informasi Pribadi</h3>
        </div>
        <div class="detail-card-body">
            <div class="detail-item">
                <div class="detail-label">Nama Lengkap</div>
                <div class="detail-value">{{ $user->name }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Gender</div>
                <div class="detail-value {{ !$user->gender ? 'detail-value-empty' : '' }}">
                    {{ $user->gender ?? 'Belum diisi' }}
                </div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Tanggal Lahir</div>
                <div class="detail-value {{ !$user->tanggal_lahir ? 'detail-value-empty' : '' }}">
                    @if($user->tanggal_lahir)
                        {{ $user->tanggal_lahir->format('d F Y') }}
                        <small class="text-muted">({{ $user->tanggal_lahir->age }} tahun)</small>
                    @else
                        Belum diisi
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Contact & Identity -->
    <div class="detail-card">
        <div class="detail-card-header">
            <div class="detail-icon">
                <i class="fas fa-id-card"></i>
            </div>
            <h3 class="detail-card-title">Kontak & Identitas</h3>
        </div>
        <div class="detail-card-body">
            <div class="detail-item">
                <div class="detail-label">Email</div>
                <div class="detail-value">{{ $user->email }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">No. HP</div>
                <div class="detail-value {{ !$user->no_hp ? 'detail-value-empty' : '' }}">
                    {{ $user->no_hp ?? 'Belum diisi' }}
                </div>
            </div>
            <div class="detail-item">
                <div class="detail-label">NIK</div>
                <div class="detail-value {{ !$user->nik ? 'detail-value-empty' : '' }}">
                    {{ $user->nik ?? 'Belum diisi' }}
                </div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Status Email</div>
                <div class="detail-value">
                    @if($user->email_verified_at)
                        <span style="color: var(--success-color);">
                            <i class="fas fa-check-circle"></i> Verified
                        </span>
                        <br>
                        <small class="text-muted">{{ $user->email_verified_at->format('d M Y H:i') }}</small>
                    @else
                        <span style="color: var(--danger-color);">
                            <i class="fas fa-times-circle"></i> Not Verified
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Address Information -->
    <div class="detail-card">
        <div class="detail-card-header">
            <div class="detail-icon">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <h3 class="detail-card-title">Informasi Alamat</h3>
        </div>
        <div class="detail-card-body">
            <div class="detail-item">
                <div class="detail-label">Alamat Lengkap</div>
                <div class="detail-value {{ !$user->alamat ? 'detail-value-empty' : '' }}">
                    {{ $user->alamat ?? 'Belum diisi' }}
                </div>
            </div>
            <div class="detail-item">
                <div class="detail-label">RT / RW</div>
                <div class="detail-value {{ !$user->rt && !$user->rw ? 'detail-value-empty' : '' }}">
                    @if($user->rt || $user->rw)
                        RT {{ $user->rt ?? '-' }} / RW {{ $user->rw ?? '-' }}
                    @else
                        Belum diisi
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- System Information -->
    <div class="detail-card">
        <div class="detail-card-header">
            <div class="detail-icon">
                <i class="fas fa-cog"></i>
            </div>
            <h3 class="detail-card-title">Informasi Sistem</h3>
        </div>
        <div class="detail-card-body">
            <div class="detail-item">
                <div class="detail-label">ID User</div>
                <div class="detail-value">#{{ $user->id }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Role</div>
                <div class="detail-value">
                    <span class="badge-role {{ $user->role }}">
                        <i class="fas fa-{{ $user->role == 'admin' ? 'shield-alt' : 'user' }}"></i>
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Terdaftar</div>
                <div class="detail-value">
                    {{ $user->created_at->format('d F Y H:i') }}
                    <br>
                    <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                </div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Update Terakhir</div>
                <div class="detail-value">
                    {{ $user->updated_at->format('d F Y H:i') }}
                    <br>
                    <small class="text-muted">{{ $user->updated_at->diffForHumans() }}</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Timeline -->
<div class="timeline-card">
    <div class="timeline-header">
        <div class="detail-icon">
            <i class="fas fa-history"></i>
        </div>
        <h3 class="timeline-title">Riwayat Aktivitas</h3>
    </div>
    <div class="timeline-body">
        @if($user->updated_at != $user->created_at)
        <div class="timeline-item">
            <div class="timeline-icon">
                <i class="fas fa-edit"></i>
            </div>
            <div class="timeline-content">
                <div class="timeline-date">{{ $user->updated_at->format('d F Y, H:i') }}</div>
                <div class="timeline-text">Profil user diperbarui</div>
            </div>
        </div>
        @endif

        @if($user->email_verified_at)
        <div class="timeline-item">
            <div class="timeline-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="timeline-content">
                <div class="timeline-date">{{ $user->email_verified_at->format('d F Y, H:i') }}</div>
                <div class="timeline-text">Email berhasil diverifikasi</div>
            </div>
        </div>
        @endif

        <div class="timeline-item">
            <div class="timeline-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <div class="timeline-content">
                <div class="timeline-date">{{ $user->created_at->format('d F Y, H:i') }}</div>
                <div class="timeline-text">User terdaftar di sistem</div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Form -->
<form id="deleteForm" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
function deleteUser(userId) {
    if (confirm('Apakah Anda yakin ingin menghapus user ini?\n\nTindakan ini tidak dapat dibatalkan!')) {
        document.getElementById('deleteForm').submit();
    }
}
</script>

@endsection