<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lapor Aja! - Warga')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        :root {
            --bg: #f8fafc;                /* netral sangat lembut */
            --surface: rgba(255, 255, 255, 0.92);
            --primary: #3b82f6;           /* biru modern kepercayaan */
            --primary-dark: #1d4ed8;
            --primary-light: #60a5fa;
            --accent: #10b981;            /* hijau harapan/berhasil */
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --text-muted: #64748b;
            --border: rgba(226, 232, 240, 0.8);
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.06);
            --shadow-md: 0 4px 16px rgba(0,0,0,0.08);
            --radius: 16px;
            --transition: all 0.22s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text-primary);
            min-height: 100vh;
            line-height: 1.6;
        }

        /* Header - lebih minimal & clean */
        .app-header {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(12px);
            padding: 0.9rem 1.25rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: var(--shadow-sm);
        }

        .header-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--primary-dark);
            text-decoration: none;
            font-weight: 700;
            font-size: 1.4rem;
            letter-spacing: -0.5px;
        }

        .brand i {
            font-size: 1.55rem;
            color: var(--primary);
        }

        .user-section {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .notif-btn {
            background: transparent;
            border: none;
            color: var(--text-secondary);
            font-size: 1.35rem;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            cursor: pointer;
            display: grid;
            place-items: center;
            transition: var(--transition);
        }

        .notif-btn:hover {
            background: rgba(59, 130, 246, 0.08);
            color: var(--primary);
        }

        .avatar-btn {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            display: grid;
            place-items: center;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.2);
            border: none;
            cursor: pointer;
            transition: var(--transition);
        }

        .avatar-btn:hover {
            transform: scale(1.06);
            box-shadow: 0 4px 14px rgba(59, 130, 246, 0.25);
        }

        /* Dropdown lebih modern */
        .dropdown-menu {
            border: none;
            border-radius: var(--radius);
            box-shadow: var(--shadow-md);
            background: var(--surface);
            backdrop-filter: blur(10px);
            margin-top: 0.5rem;
            min-width: 220px;
        }

        .dropdown-item {
            padding: 0.7rem 1.3rem;
            color: var(--text-primary);
            font-weight: 500;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background: rgba(59, 130, 246, 0.07);
        }

        .dropdown-divider {
            border-color: var(--border);
        }

        /* Konten utama */
        .app-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 1.25rem 1rem 6rem;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        h1, h2, h3 {
            color: var(--text-primary);
            font-weight: 700;
            letter-spacing: -0.4px;
        }

        /* Bottom Navigation - lebih minimal & elegan */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: var(--surface);
            border-top: 1px solid var(--border);
            backdrop-filter: blur(16px);
            padding: 0.65rem 1rem;
            display: flex;
            justify-content: space-around;
            z-index: 999;
            box-shadow: 0 -2px 12px rgba(0,0,0,0.04);
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: var(--text-muted);
            font-size: 0.73rem;
            font-weight: 500;
            gap: 3px;
            text-decoration: none;
            transition: var(--transition);
            padding: 0.4rem 0.8rem;
            border-radius: 12px;
        }

        .nav-item.active,
        .nav-item:hover {
            color: var(--primary);
            background: rgba(59, 130, 246, 0.06);
        }

        .nav-item i {
            font-size: 1.45rem;
        }

        /* Responsive */
        @media (min-width: 576px)  { .app-container { padding-left: 1.5rem; padding-right: 1.5rem; } }
        @media (min-width: 768px)  { 
            .header-inner, .app-container { max-width: 720px; } 
            .bottom-nav { padding: 0.8rem 2rem; }
        }
        @media (min-width: 992px)  { 
            .header-inner, .app-container { max-width: 960px; } 
        }
        @media (min-width: 1200px) { 
            .header-inner, .app-container { max-width: 1140px; } 
        }
        @media (min-width: 1400px) { 
            .header-inner, .app-container { max-width: 1320px; } 
        }

    </style>
    @stack('styles')
</head>
<body>

    <header class="app-header">
        <div class="header-inner">
            <a href="{{ route('warga.dashboard') }}" class="brand">
                <i class="fas fa-bullhorn"></i>
                <span>Lapor Aja!</span>
            </a>

            <div class="user-section">
                <div class="dropdown">
                    <button class="avatar-btn" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ strtoupper(substr(auth()->user()->name ?? 'W', 0, 1)) }}
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="p-3 text-center border-bottom">
                            <div class="avatar-btn mx-auto mb-2" style="width:56px;height:56px;font-size:1.4rem;background:var(--primary);">
                                {{ strtoupper(substr(auth()->user()->name ?? 'W', 0, 1)) }}
                            </div>
                            <div class="fw-bold mt-1">{{ auth()->user()->name ?? 'Warga' }}</div>
                            <small class="text-muted d-block mt-1">{{ auth()->user()->email ?? '' }}</small>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('warga.profile') }}"><i class="fas fa-user me-2"></i>Profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Pengaturan</a></li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i>Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <main class="app-container">
        @yield('content')
    </main>

    <nav class="bottom-nav">
        <a href="{{ route('warga.dashboard') }}" class="nav-item {{ request()->routeIs('warga.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            <span>Beranda</span>
        </a>
        <a href="{{ route('warga.laporan.semua') }}" class="nav-item {{ request()->routeIs('warga.laporan.semua') ? 'active' : '' }}">
            <i class="fas fa-search"></i>
            <span>Semua Laporan Warga</span>
        </a>
        <a href="{{ route('warga.laporan.create') }}" class="nav-item">
            <i class="fas fa-plus-circle"></i>
            <span>Lapor</span>
        </a>
        <a href="{{ route('warga.laporan.index') }}" class="nav-item">
            <i class="fas fa-list-ul"></i>
            <span>Laporan</span>
        </a>
        <a href="{{ route('warga.saran.index') }}" class="nav-item {{ request()->routeIs('warga.saran.*') ? 'active' : '' }}">
            <i class="fas fa-comment-dots"></i>
            <span>Saran</span>
        </a>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function showNotifications() {
            alert('Belum ada notifikasi baru.');
        }
        function toggleNotifications() {
            document.getElementById('notifDropdown')
                .classList.toggle('d-none');
        }
    </script>
    @stack('scripts')
</body>
</html>