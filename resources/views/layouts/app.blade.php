<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lapor Aja!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            --primary-color: #0066CC;
            --primary-light: #3385DB;
            --primary-dark: #004999;
            --secondary-color: #00BFA6;
            --success-color: #00C853;
            --warning-color: #FFB300;
            --danger-color: #FF3D00;
            --info-color: #00B8D4;
            --light-bg: #F5F7FA;
            --card-bg: #FFFFFF;
            --text-primary: #1A1A1A;
            --text-secondary: #6B7280;
            --border-color: #E5E7EB;
            --sidebar-width: 260px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        /* Top Navigation Bar */
        .top-navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 64px;
            background: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            z-index: 1030;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 700;
            font-size: 1.25rem;
            transition: opacity 0.2s ease;
        }

        .brand-logo:hover {
            opacity: 0.8;
            color: var(--primary-color);
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: white;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 64px;
            left: 0;
            width: var(--sidebar-width);
            height: calc(100vh - 64px);
            background: var(--card-bg);
            border-right: 1px solid var(--border-color);
            overflow-y: auto;
            z-index: 1020;
            transition: transform 0.3s ease;
            padding: 1.5rem 0;
        }

        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #D1D5DB;
            border-radius: 10px;
        }

        .sidebar-section {
            padding: 0 1rem;
            margin-bottom: 2rem;
        }

        .sidebar-title {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-secondary);
            margin-bottom: 0.75rem;
            padding: 0 0.75rem;
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            color: var(--text-secondary);
            text-decoration: none;
            border-radius: 10px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            background: var(--light-bg);
            color: var(--primary-color);
        }

        .nav-link.active {
            background: linear-gradient(90deg, rgba(0, 102, 204, 0.1), transparent);
            color: var(--primary-color);
            font-weight: 600;
            border-left: 3px solid var(--primary-color);
            padding-left: calc(0.75rem - 3px);
        }

        .nav-link i {
            width: 20px;
            font-size: 1.1rem;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: 64px;
            padding: 2rem;
            min-height: calc(100vh - 64px);
        }

        /* User Profile */
        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            padding: 0.5rem 0.75rem;
            background: var(--light-bg);
            border-radius: 12px;
            transition: all 0.2s ease;
            border: none;
        }

        .user-profile:hover {
            background: #E5E7EB;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .user-info {
            text-align: left;
            color: var(--text-primary);
        }

        .user-name {
            font-weight: 600;
            font-size: 0.875rem;
            line-height: 1.2;
        }

        .user-role {
            font-size: 0.7rem;
            color: var(--text-secondary);
        }

        .dropdown-toggle::after {
            margin-left: 0.5rem;
            vertical-align: middle;
        }

        /* Dropdown Menu */
        .profile-dropdown {
            min-width: 260px;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            padding: 0;
            margin-top: 0.5rem;
            overflow: hidden;
        }

        .dropdown-header-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            padding: 1.25rem;
            color: white;
        }

        .user-avatar-large {
            width: 56px;
            height: 56px;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .dropdown-menu-custom {
            padding: 0.5rem;
        }

        .dropdown-item-custom {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            color: var(--text-primary);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s ease;
            font-size: 0.875rem;
        }

        .dropdown-item-custom:hover {
            background: var(--light-bg);
            color: var(--primary-color);
        }

        .dropdown-item-custom i {
            width: 18px;
            text-align: center;
            font-size: 1rem;
            color: var(--text-secondary);
        }

        .dropdown-item-custom:hover i {
            color: var(--primary-color);
        }

        .dropdown-divider-custom {
            margin: 0.5rem 0;
            border-top: 1px solid var(--border-color);
        }

        .logout-btn {
            width: 100%;
            padding: 0.75rem;
            background: var(--danger-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
            margin-top: 0.25rem;
        }

        .logout-btn:hover {
            background: #E63300;
        }

        /* Mobile Toggle */
        .mobile-toggle {
            display: none;
            background: var(--light-bg);
            border: none;
            color: var(--text-primary);
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            font-size: 1.1rem;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-toggle {
                display: block !important;
            }

            .user-info {
                display: none;
            }

            .brand-logo span {
                display: none !important;
            }
        }

        /* Sidebar Overlay */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 64px;
            left: 0;
            width: 100%;
            height: calc(100vh - 64px);
            background: rgba(0, 0, 0, 0.4);
            z-index: 1010;
        }

        .sidebar-overlay.show {
            display: block;
        }

        /* Page Header Styles */
        .page-header {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid var(--border-color);
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
        }

        .page-subtitle {
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        /* Card Styles */
        .card-modern {
            background: var(--card-bg);
            border-radius: 12px;
            border: 1px solid var(--border-color);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
        }

        .card-modern:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* Badge Styles */
        .badge-modern {
            padding: 0.375rem 0.75rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.75rem;
        }

        .badge-primary {
            background: rgba(0, 102, 204, 0.1);
            color: var(--primary-color);
        }

        .badge-success {
            background: rgba(0, 200, 83, 0.1);
            color: var(--success-color);
        }

        .badge-warning {
            background: rgba(255, 179, 0, 0.1);
            color: var(--warning-color);
        }

        .badge-danger {
            background: rgba(255, 61, 0, 0.1);
            color: var(--danger-color);
        }

        /* Button Styles */
        .btn-modern {
            padding: 0.625rem 1.25rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-primary-modern {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary-modern:hover {
            background: var(--primary-dark);
            color: white;
        }
    </style>
</head>
<body>

<!-- Top Navigation -->
<nav class="top-navbar">
    <div class="d-flex align-items-center gap-3">
        <button class="mobile-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <a href="#" class="brand-logo">
            <div class="brand-icon">
                <i class="fas fa-bullhorn"></i>
            </div>
            <span>Lapor Aja!</span>
        </a>
    </div>

    <!-- User Profile Dropdown -->
    <div class="dropdown">
        <button class="user-profile dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="user-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="user-info">
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role">{{ ucfirst(auth()->user()->role) }}</div>
            </div>
        </button>
        
        <ul class="dropdown-menu dropdown-menu-end profile-dropdown">
            <li class="dropdown-header-custom">
                <div class="user-avatar-large">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div class="user-name fw-bold mb-1">{{ auth()->user()->name }}</div>
                <div class="user-role" style="opacity: 0.95;">{{ auth()->user()->email }}</div>
            </li>
            
            <li class="dropdown-menu-custom">
                <a href="{{route ('warga.profile')}}" class="dropdown-item-custom">
                    <i class="fas fa-user"></i>
                    <span>Profil Saya</span>
                </a>
                <a href="#" class="dropdown-item-custom">
                    <i class="fas fa-cog"></i>
                    <span>Pengaturan</span>
                </a>
                <a href="#" class="dropdown-item-custom">
                    <i class="fas fa-bell"></i>
                    <span>Notifikasi</span>
                </a>
                
                <div class="dropdown-divider-custom"></div>
                
                <div class="px-2">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- Sidebar Overlay (Mobile) -->
<div class="sidebar-overlay" onclick="toggleSidebar()"></div>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    @if(auth()->user()->role == 'warga')
    <div class="sidebar-section">
        <div class="sidebar-title">Menu Utama</div>
        <nav class="nav-menu">
            <a href="{{ route('warga.dashboard') }}" class="nav-link {{ request()->is('warga/dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('warga.laporan.index') }}" class="nav-link {{ request()->is('warga/laporan') && !request()->is('warga/laporan/semua') && !request()->is('warga/laporan/riwayat') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i>
                <span>Laporan Saya</span>
            </a>
            <a href="{{ route('warga.laporan.semua') }}" class="nav-link {{ request()->is('warga/laporan/semua') ? 'active' : '' }}">
                <i class="fas fa-list"></i>
                <span>Semua Laporan</span>
            </a>
            <a href="{{ route('warga.laporan.riwayat') }}" class="nav-link {{ request()->is('warga/laporan/riwayat') ? 'active' : '' }}">
                <i class="fas fa-history"></i>
                <span>Riwayat Laporan</span>
            </a>
        </nav>
    </div>
    @endif

    @if(auth()->user()->role == 'admin')
    <div class="sidebar-section">
        <div class="sidebar-title">Menu Admin</div>
        <nav class="nav-menu">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.laporan.index') }}" class="nav-link {{ request()->is('admin/laporan*') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i>
                <span>Semua Laporan</span>
            </a>
            <a href="{{ route('admin.saran.index') }}" class="nav-link {{ request()->is('admin/saran*') ? 'active' : '' }}">
                <i class="fas fa-lightbulb"></i>
                <span>Saran User</span>
            </a>
        </nav>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-title">Lainnya</div>
        <nav class="nav-menu">
            <a href="#" class="nav-link">
                <i class="fas fa-download"></i>
                <span>Export Data</span>
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-cog"></i>
                <span>Pengaturan</span>
            </a>
        </nav>
    </div>
    @endif
</aside>

<!-- Main Content -->
<main class="main-content">
    @yield('content')
</main>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.querySelector('.sidebar-overlay');
    
    sidebar.classList.toggle('show');
    overlay.classList.toggle('show');
}

// Close sidebar when clicking outside on mobile
document.addEventListener('click', function(event) {
    const sidebar = document.getElementById('sidebar');
    const toggle = document.querySelector('.mobile-toggle');
    
    if (window.innerWidth <= 992) {
        if (!sidebar.contains(event.target) && !toggle.contains(event.target) && sidebar.classList.contains('show')) {
            toggleSidebar();
        }
    }
});
</script>

</body>
</html>