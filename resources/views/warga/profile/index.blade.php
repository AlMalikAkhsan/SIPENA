@extends('layouts.app')

@section('content')
<div class="profile-container">
    <div class="profile-header">
        <div class="breadcrumb">
            <a href="{{ route('warga.dashboard') }}">Dashboard</a>
            <span>/</span>
            <span>Profile Saya</span>
        </div>
        <h2>{{ Auth::user()->name }}</h2>
        <span class="profile-badge">Warga {{ Auth::user()->rw }} / {{ Auth::user()->rt }}</span>

    </div>

    @if(session('success'))
    <div class="alert alert-success">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 0C4.48 0 0 4.48 0 10C0 15.52 4.48 20 10 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 10 0ZM8 15L3 10L4.41 8.59L8 12.17L15.59 4.58L17 6L8 15Z" fill="currentColor"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    <div class="profile-grid">
        <!-- Profile Summary Card -->
        <div class="profile-card">
            <div class="profile-avatar-section">
                @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="profile-avatar">
                @else
                    <div class="profile-avatar-placeholder">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" fill="currentColor"/>
                            <path d="M12 14C7.58172 14 4 17.5817 4 22H20C20 17.5817 16.4183 14 12 14Z" fill="currentColor"/>
                        </svg>
                    </div>
                @endif
                <h2>{{ Auth::user()->name ?? 'Nama Belum Diisi' }}</h2>
                <p class="profile-username">{{ '@' . Auth::user()->username ?? 'username' }}</p>
                <span class="profile-badge">Member Aktif</span>
            </div>

            <div class="profile-stats">
                <div class="stat-item">
                    <div class="stat-label">Bergabung</div>
                    <div class="stat-value">{{ Auth::user()->created_at->format('d M Y') }}</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Email</div>
                    <div class="stat-value">{{ Auth::user()->email }}</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">No HP</div>
                    <div class="stat-value">{{ Auth::user()->no_hp ?? '-' }}</div>
                </div>
            </div>

            <a href="{{ route('warga.profile.update') }}" class="btn btn-primary btn-block">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.8463 2.6543C15.6273 1.87325 16.8983 1.87325 17.6793 2.6543C18.4604 3.43535 18.4604 4.70635 17.6793 5.4874L6.41422 16.7525L2.5 17.5L3.24752 13.5858L14.5126 2.32076L14.8463 2.6543Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Edit Profile
            </a>
        </div>

        <!-- Profile Details -->
        <div class="profile-details">
            <div class="detail-section">
                <h3 class="section-title">Informasi Personal</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <label>Nama Lengkap</label>
                        <p>{{ Auth::user()->name }}</p>
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


            <div class="detail-section">
                <h3 class="section-title">Informasi Kontak & Wilayah</h3>
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
                        <label>Alamat</label>
                        <p>{{ Auth::user()->alamat ?? '-' }}</p>
                    </div>

                    <div class="detail-item">
                        <label>RW</label>
                        <p>{{ Auth::user()->rw ?? '-' }}</p>
                    </div>

                    <div class="detail-item">
                        <label>RT</label>
                        <p>{{ Auth::user()->rt ?? '-' }}</p>
                    </div>
                </div>
            </div>


            <div class="detail-section">
                <h3 class="section-title">Keamanan</h3>
                <p>Password terakhir diperbarui {{ Auth::user()->updated_at->diffForHumans() }}</p>
                <a href="{{ route('warga.profile.update') }}" class="btn btn-outline btn-sm">
                    Ubah Password
                </a>
            </div>

        </div>
    </div>
</div>

<style>
:root {
    --primary: #2D3250;
    --primary-light: #424769;
    --accent: #7077A1;
    --accent-bright: #F6B17A;
    --bg-main: #F8F9FC;
    --bg-card: #FFFFFF;
    --text-primary: #1A1D2E;
    --text-secondary: #6B7280;
    --border: #E5E7EB;
    --success: #10B981;
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
}

.profile-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.profile-header {
    margin-bottom: 2rem;
}

.breadcrumb {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin-bottom: 0.75rem;
}

.breadcrumb a {
    color: var(--accent);
    text-decoration: none;
}

.breadcrumb a:hover {
    color: var(--primary);
}

.breadcrumb span {
    margin: 0 0.5rem;
}

.profile-header h1 {
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary);
    margin: 0;
}

.alert {
    padding: 1rem 1.25rem;
    border-radius: 12px;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    animation: slideDown 0.4s ease-out;
}

.alert-success {
    background: #D1FAE5;
    color: var(--success);
}

.profile-grid {
    display: grid;
    grid-template-columns: 350px 1fr;
    gap: 2rem;
}

.profile-card {
    background: var(--bg-card);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border);
    height: fit-content;
}

.profile-avatar-section {
    text-align: center;
    margin-bottom: 2rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid var(--border);
}

.profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 20px;
    object-fit: cover;
    border: 4px solid var(--accent-bright);
    margin-bottom: 1rem;
}

.profile-avatar-placeholder {
    width: 120px;
    height: 120px;
    border-radius: 20px;
    background: linear-gradient(135deg, var(--accent-bright), var(--accent));
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    color: white;
}

.profile-avatar-section h2 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 0.25rem;
}

.profile-username {
    color: var(--text-secondary);
    font-size: 1rem;
    margin-bottom: 0.75rem;
}

.profile-badge {
    display: inline-block;
    padding: 0.375rem 1rem;
    background: #D1FAE5;
    color: var(--success);
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
}

.profile-stats {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.stat-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.stat-label {
    font-size: 0.875rem;
    color: var(--text-secondary);
}

.stat-value {
    font-weight: 600;
    color: var(--primary);
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.875rem 1.5rem;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    font-size: 1rem;
}

.btn-primary {
    background: var(--accent-bright);
    color: var(--primary);
    box-shadow: 0 4px 12px rgba(246, 177, 122, 0.3);
}

.btn-primary:hover {
    background: #FFB366;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(246, 177, 122, 0.4);
}

.btn-block {
    width: 100%;
}

.btn-outline {
    background: white;
    color: var(--text-primary);
    border: 2px solid var(--border);
}

.btn-outline:hover {
    background: var(--bg-main);
    border-color: var(--accent);
}

.btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
}

.profile-details {
    background: var(--bg-card);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border);
}

.detail-section {
    margin-bottom: 2.5rem;
}

.detail-section:last-child {
    margin-bottom: 0;
}

.section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--border);
}

.detail-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.detail-item.full-width {
    grid-column: 1 / -1;
}

.detail-item label {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.detail-item p {
    font-size: 1rem;
    color: var(--text-primary);
    font-weight: 500;
}

.security-info {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.security-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem;
    background: var(--bg-main);
    border-radius: 12px;
    border: 1px solid var(--border);
}

.security-icon {
    width: 48px;
    height: 48px;
    background: var(--accent-bright);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.security-item > div {
    flex: 1;
}

.security-item h4 {
    font-size: 1rem;
    font-weight: 600;
    color: var(--primary);
    margin-bottom: 0.25rem;
}

.security-item p {
    font-size: 0.875rem;
    color: var(--text-secondary);
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 968px) {
    .profile-grid {
        grid-template-columns: 1fr;
    }

    .detail-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 640px) {
    .profile-container {
        padding: 1rem;
    }

    .security-item {
        flex-direction: column;
        text-align: center;
    }
}
</style>
@endsection