<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sipena Warga')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        :root {
            --app-bg: #f6f7fb;
            --surface: rgba(255, 255, 255, 0.95);
            --surface-strong: #ffffff;
            --line: rgba(148, 163, 184, 0.24);
            --line-strong: rgba(148, 163, 184, 0.4);
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-soft: rgba(37, 99, 235, 0.12);
            --accent: #0ea5a4;
            --danger: #ef4444;
            --text: #0f172a;
            --text-soft: #475569;
            --text-faint: #94a3b8;
            --shadow-soft: 0 12px 28px rgba(15, 23, 42, 0.08);
            --shadow-float: 0 20px 48px rgba(15, 23, 42, 0.12);
            --radius-xl: 28px;
            --radius-lg: 20px;
            --radius-md: 14px;
            --sidebar-width: 260px;
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at 12% 10%, rgba(37, 99, 235, 0.08), transparent 36%),
                radial-gradient(circle at 88% 12%, rgba(14, 165, 164, 0.08), transparent 30%),
                var(--app-bg);
            min-height: 100vh;
        }

        a { color: inherit; text-decoration: none; }
        img { max-width: 100%; display: block; }
        .user-app { min-height: 100vh; display: flex; }

        .sidebar {
            width: var(--sidebar-width);
            padding: 26px 18px 28px;
            position: fixed;
            inset: 0 auto 0 0;
            background: #ffffff;
            backdrop-filter: none;
            color: var(--text);
            display: flex;
            flex-direction: column;
            gap: 18px;
            z-index: 1030;
            border-right: 1px solid var(--line);
            box-shadow: none;
            overflow-y: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .sidebar::-webkit-scrollbar { display: none; }

        .brand-box,
        .profile-mini,
        .support-card,
        .page-intro,
        .panel,
        .report-card,
        .stat-card,
        .empty-state,
        .timeline-card,
        .detail-card,
        .form-shell,
        .gallery-photo,
        .summary-card,
        .topbar-card {
            border: 1px solid var(--line);
            box-shadow: var(--shadow-soft);
        }

        .brand-box {
            padding: 18px;
            border-radius: 18px;
            background: transparent;
            border: 1px solid var(--line);
            box-shadow: none;
        }

        .brand-mark,
        .stat-icon,
        .empty-icon,
        .mini-avatar,
        .avatar-badge {
            display: grid;
            place-items: center;
        }

        .brand-mark {
            width: 52px;
            height: 52px;
            border-radius: 18px;
            margin-bottom: 14px;
            background: linear-gradient(135deg, #39b8ff, #0a84ff);
            color: white;
            font-size: 1.3rem;
            box-shadow: 0 14px 30px rgba(10, 132, 255, 0.32);
        }

        .page-kicker,
        .panel-subtitle,
        .helper-text,
        .meta-text,
        .empty-copy,
        .form-note,
        .brand-box p,
        .profile-mini p,
        .support-card p {
            color: var(--text-faint);
        }

        .brand-title,
        .support-card h6,
        .profile-mini strong { margin: 0; color: var(--text); font-weight: 700; }
        .brand-title { font-size: 1.15rem; }

        .sidebar-nav { display: grid; gap: 8px; }

        .nav-link-rail {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 16px;
            border-radius: 16px;
            color: var(--text-soft);
            font-weight: 600;
            transition: 0.25s ease;
        }

        .nav-link-rail:hover,
        .nav-link-rail.active {
            color: var(--primary-dark);
            background: rgba(37, 99, 235, 0.08);
        }

        .sidebar-footer {
            margin-top: auto;
            display: grid;
            gap: 12px;
            padding-top: 12px;
            border-top: 1px solid var(--line);
        }

        .profile-mini,
        .support-card {
            border-radius: 16px;
            padding: 12px;
            background: transparent;
            border: 1px solid var(--line);
            box-shadow: none;
        }

        .profile-mini { display: flex; align-items: center; gap: 12px; }

        .avatar-badge {
            width: 46px;
            height: 46px;
            border-radius: 16px;
            font-weight: 800;
            color: white;
            background: linear-gradient(135deg, #4fd1ff, #0a84ff);
            box-shadow: 0 12px 24px rgba(10, 132, 255, 0.25);
            overflow: hidden;
        }

        .avatar-badge img { width: 100%; height: 100%; object-fit: cover; }

        .logout-btn {
            width: 100%;
            border: 1px solid rgba(239, 68, 68, 0.18);
            border-radius: 14px;
            padding: 10px 12px;
            font-weight: 700;
            background: rgba(239, 68, 68, 0.08);
            color: #b91c1c;
        }

        .main-shell {
            width: 100%;
            padding: 24px 24px 104px;
            margin-left: var(--sidebar-width);
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .topbar-card {
            background: var(--surface);
            backdrop-filter: blur(18px);
            border-radius: 20px;
            padding: 16px 18px;
            border: 1px solid var(--line);
        }

        .topbar-greeting strong { display: block; font-size: 1rem; }
        .topbar-actions { display: flex; align-items: center; gap: 12px; }

        .icon-button {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            border: 1px solid var(--line);
            background: var(--surface-strong);
            color: var(--text);
            display: grid;
            place-items: center;
            box-shadow: var(--shadow-soft);
        }

        .page-content,
        .flash-stack,
        .timeline-list,
        .info-list { display: grid; gap: 22px; }

        .page-intro,
        .panel,
        .form-shell,
        .detail-card,
        .timeline-card,
        .summary-card,
        .stat-card {
            background: var(--surface);
            backdrop-filter: blur(18px);
        }

        .page-intro {
            position: relative;
            overflow: hidden;
            border-radius: var(--radius-xl);
            padding: 28px;
            display: flex;
            justify-content: space-between;
            gap: 24px;
            align-items: flex-start;
        }

        .page-intro::after {
            content: "";
            position: absolute;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(10, 132, 255, 0.12);
            top: -90px;
            right: -40px;
        }

        .page-intro.primary {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.12), rgba(255, 255, 255, 0.95));
            color: var(--text);
            box-shadow: var(--shadow-soft);
        }

        .page-intro.primary .page-kicker,
        .page-intro.primary .page-subtitle,
        .page-intro.primary .meta-text { color: var(--text-soft); }

        .page-title {
            margin: 6px 0 10px;
            font-size: clamp(1.65rem, 3vw, 2.6rem);
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        .page-subtitle { max-width: 720px; line-height: 1.7; color: var(--text-soft); margin: 0; }

        .intro-actions,
        .chip-row,
        .action-row,
        .meta-row,
        .toolbar,
        .summary-grid,
        .card-actions,
        .button-row { display: flex; flex-wrap: wrap; gap: 12px; }

        .chip,
        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border-radius: 999px;
            font-weight: 700;
        }

        .chip {
            padding: 10px 14px;
            font-size: 0.9rem;
            border: 1px solid var(--line);
            background: rgba(255, 255, 255, 0.76);
        }

        .chip.soft {
            background: var(--primary-soft);
            color: var(--primary-dark);
            border-color: rgba(10, 132, 255, 0.12);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 18px;
        }

        .stat-card { border-radius: 24px; padding: 20px; display: grid; gap: 10px; }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 18px;
            background: var(--primary-soft);
            color: var(--primary);
            font-size: 1.25rem;
        }

        .stat-value { font-size: 2rem; font-weight: 800; line-height: 1; }
        .stat-label { color: var(--text-soft); font-weight: 600; }

        .panel,
        .form-shell,
        .detail-card,
        .timeline-card,
        .summary-card { border-radius: 26px; padding: 24px; }

        .panel-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 18px;
        }

        .panel-title { margin: 0; font-size: 1.1rem; font-weight: 800; }
        .panel-subtitle { margin: 6px 0 0; font-size: 0.92rem; }

        .button,
        .button-light,
        .button-danger,
        .button-ghost {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 48px;
            border-radius: 16px;
            padding: 0 18px;
            border: 0;
            font-weight: 700;
            transition: 0.25s ease;
        }

        .button { background: linear-gradient(135deg, #2563eb, #1d4ed8); color: white; box-shadow: 0 12px 24px rgba(37, 99, 235, 0.2); }
        .button-light { background: white; color: var(--text); border: 1px solid var(--line); }
        .button-ghost { background: transparent; color: var(--primary-dark); border: 1px dashed rgba(37, 99, 235, 0.22); }
        .button-danger { background: rgba(239, 68, 68, 0.1); color: var(--danger); border: 1px solid rgba(239, 68, 68, 0.14); }
        .button:hover,
        .button-light:hover,
        .button-danger:hover,
        .button-ghost:hover { transform: translateY(-1px); }

        .grid-two,
        .grid-three,
        .detail-grid,
        .report-grid,
        .filter-grid,
        .form-grid,
        .upload-preview,
        .photo-strip { display: grid; gap: 18px; }

        .grid-two { grid-template-columns: minmax(0, 2fr) minmax(300px, 1fr); }
        .grid-three { grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); }
        .detail-grid { grid-template-columns: minmax(0, 1.6fr) minmax(290px, 0.8fr); }
        .report-grid {
            grid-template-columns: repeat(auto-fit, minmax(260px, 320px));
            justify-content: start;
        }
        .filter-grid { grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); }
        .form-grid.two { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .upload-preview { grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); }
        .photo-strip { grid-template-columns: repeat(auto-fit, minmax(96px, 1fr)); }

        .report-card {
            border-radius: 24px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100%;
            max-width: 360px;
        }

        .report-thumb { position: relative; height: 190px; background: linear-gradient(135deg, #dfeeff, #f7fbff); }
        .report-thumb img,
        .preview-card img,
        .media-card img,
        .hero-photo img { width: 100%; height: 100%; object-fit: cover; }
        .report-thumb .placeholder { width: 100%; height: 100%; display: grid; place-items: center; color: var(--text-faint); font-size: 2rem; }

        .report-body { padding: 18px; display: grid; gap: 14px; flex: 1; }
        .report-title { margin: 0; font-size: 1.05rem; font-weight: 800; line-height: 1.45; }
        .report-copy { margin: 0; color: var(--text-soft); line-height: 1.65; font-size: 0.94rem; }
        .mini-author { display: flex; gap: 10px; align-items: center; }

        .mini-avatar {
            width: 40px;
            height: 40px;
            border-radius: 14px;
            background: linear-gradient(135deg, #43d4ff, #0a84ff);
            color: white;
            font-weight: 800;
        }

        .status-pill { padding: 8px 12px; font-size: 0.82rem; }
        .status-menunggu { background: rgba(245, 158, 11, 0.12); color: #b45309; }
        .status-diproses, .status-dibaca, .status-ditinjau { background: rgba(10, 132, 255, 0.12); color: var(--primary-dark); }
        .status-selesai, .status-diterapkan { background: rgba(22, 163, 74, 0.12); color: #15803d; }
        .status-ditolak { background: rgba(239, 68, 68, 0.12); color: #b91c1c; }

        .field-group { display: grid; gap: 8px; }
        .field-label { font-size: 0.92rem; font-weight: 700; }

        .field-input,
        .field-select,
        .field-textarea {
            width: 100%;
            border-radius: 16px;
            border: 1px solid var(--line-strong);
            background: rgba(255, 255, 255, 0.94);
            color: var(--text);
            padding: 14px 16px;
            font: inherit;
            transition: 0.2s ease;
        }

        .field-input:focus,
        .field-select:focus,
        .field-textarea:focus {
            outline: none;
            border-color: rgba(10, 132, 255, 0.32);
            box-shadow: 0 0 0 4px rgba(10, 132, 255, 0.09);
        }

        .field-textarea { min-height: 150px; resize: vertical; }

        .upload-zone {
            border: 1.5px dashed rgba(10, 132, 255, 0.24);
            border-radius: 22px;
            background: linear-gradient(180deg, rgba(10, 132, 255, 0.06), rgba(255, 255, 255, 0.88));
            padding: 28px;
            text-align: center;
            cursor: pointer;
        }

        .upload-zone.is-dragover {
            border-color: rgba(10, 132, 255, 0.5);
            background: linear-gradient(180deg, rgba(10, 132, 255, 0.12), rgba(255, 255, 255, 0.95));
        }

        .preview-card,
        .media-card,
        .photo-thumb {
            position: relative;
            overflow: hidden;
            border-radius: 18px;
            min-height: 120px;
            background: #e7f0ff;
        }

        .remove-media {
            position: absolute;
            top: 10px;
            right: 10px;
            border: 0;
            width: 34px;
            height: 34px;
            border-radius: 999px;
            background: rgba(9, 17, 35, 0.76);
            color: white;
        }

        .gallery-photo { overflow: hidden; border-radius: 26px; background: var(--surface); }
        .hero-photo { min-height: 360px; background: linear-gradient(135deg, #dcecff, #f6fbff); }
        .photo-thumb { border: 2px solid transparent; cursor: pointer; min-height: 86px; }
        .photo-thumb.active { border-color: rgba(10, 132, 255, 0.36); }

        .info-item,
        .timeline-item {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            align-items: flex-start;
            padding-bottom: 14px;
            border-bottom: 1px solid rgba(140, 168, 202, 0.14);
        }

        .info-item:last-child,
        .timeline-item:last-child { border-bottom: 0; padding-bottom: 0; }

        .empty-state {
            background: var(--surface);
            border-radius: 28px;
            padding: 44px 28px;
            text-align: center;
        }

        .empty-icon {
            width: 76px;
            height: 76px;
            margin: 0 auto 18px;
            border-radius: 24px;
            font-size: 1.8rem;
            color: var(--primary);
            background: var(--primary-soft);
        }

        .flash { border-radius: 16px; padding: 14px 16px; display: flex; gap: 12px; align-items: flex-start; }
        .flash.success { background: rgba(22, 163, 74, 0.08); border: 1px solid rgba(22, 163, 74, 0.16); color: #116533; }
        .flash.error { background: rgba(239, 68, 68, 0.08); border: 1px solid rgba(239, 68, 68, 0.16); color: #9f1d1d; }

        .mobile-nav { display: none; }

        .pagination { gap: 8px; }
        .pagination .page-link { border: 0; color: var(--text); border-radius: 14px; padding: 10px 14px; box-shadow: var(--shadow-soft); }
        .pagination .page-item.active .page-link { background: var(--primary); color: white; }

        @media (max-width: 1199px) {
            .sidebar { display: none; }
            .main-shell { margin-left: 0; padding-bottom: 110px; }
        .mobile-nav {
            position: fixed;
            left: 16px;
            right: 16px;
            bottom: 14px;
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 8px;
            padding: 10px;
            background: rgba(255, 255, 255, 0.96);
            border-radius: 22px;
            backdrop-filter: blur(16px);
            z-index: 1030;
            box-shadow: var(--shadow-float);
            border: 1px solid var(--line);
        }
        .mobile-link {
            color: var(--text-soft);
            display: grid;
            justify-items: center;
            gap: 6px;
            padding: 10px 8px;
            border-radius: 14px;
            font-size: 0.74rem;
            font-weight: 700;
        }
        .mobile-link.active { background: rgba(37, 99, 235, 0.12); color: var(--primary-dark); }
        }

        @media (max-width: 991px) {
            .grid-two,
            .detail-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 767px) {
            .main-shell { padding: 16px 16px 110px; }
            .topbar { flex-direction: column; align-items: stretch; }
            .page-intro,
            .panel,
            .form-shell,
            .detail-card,
            .timeline-card,
            .summary-card { padding: 20px; border-radius: 22px; }
            .form-grid.two { grid-template-columns: 1fr; }
            .page-title { font-size: 1.8rem; }
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .page-content > * {
            animation: fadeUp 0.55s ease both;
        }

        .page-content > *:nth-child(2) { animation-delay: 0.05s; }
        .page-content > *:nth-child(3) { animation-delay: 0.1s; }
        .page-content > *:nth-child(4) { animation-delay: 0.15s; }

        @media (prefers-reduced-motion: reduce) {
            .page-content > * { animation: none; }
        }
    </style>
    @stack('styles')
</head>
<body>
@php
    $user = auth()->user();
    $avatarPath = $user?->avatar ? asset('storage/' . $user->avatar) : null;
@endphp
<div class="user-app">
    <aside class="sidebar">
        <div class="brand-box">
            <div class="brand-mark"><i class="fas fa-city"></i></div>
            <p class="page-kicker mb-2">Layanan Warga Digital</p>
            <h1 class="brand-title">Sipena Warga</h1>
            <p class="mb-0 mt-2">Tampilan warga kini dibuat lebih ringkas, modern, dan mudah dipakai seperti aplikasi layanan publik.</p>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('warga.dashboard') }}" class="nav-link-rail {{ request()->routeIs('warga.dashboard') ? 'active' : '' }}"><i class="fas fa-house"></i><span>Beranda</span></a>
            <a href="{{ route('warga.laporan.semua') }}" class="nav-link-rail {{ request()->routeIs('warga.laporan.semua') || request()->routeIs('warga.laporan.detail_umum') ? 'active' : '' }}"><i class="fas fa-compass"></i><span>Jelajah Laporan</span></a>
            <a href="{{ route('warga.laporan.index') }}" class="nav-link-rail {{ request()->routeIs('warga.laporan.index') || request()->routeIs('warga.laporan.show') || request()->routeIs('warga.laporan.edit') || request()->routeIs('warga.laporan.riwayat') ? 'active' : '' }}"><i class="fas fa-file-lines"></i><span>Laporan Saya</span></a>
            <a href="{{ route('warga.laporan.create') }}" class="nav-link-rail {{ request()->routeIs('warga.laporan.create') ? 'active' : '' }}"><i class="fas fa-plus"></i><span>Buat Laporan</span></a>
            <a href="{{ route('warga.saran.index') }}" class="nav-link-rail {{ request()->routeIs('warga.saran.*') ? 'active' : '' }}"><i class="fas fa-lightbulb"></i><span>Saran Warga</span></a>
            <a href="{{ route('warga.profile') }}" class="nav-link-rail {{ request()->routeIs('warga.profile*') ? 'active' : '' }}"><i class="fas fa-user-gear"></i><span>Profil</span></a>
        </nav>

        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn"><i class="fas fa-right-from-bracket me-2"></i> Keluar</button>
            </form>
        </div>
    </aside>

    <main class="main-shell">
        <div class="topbar">
            <div class="topbar-card topbar-greeting">
                <span class="page-kicker">Dashboard warga</span>
                <strong>{{ now()->translatedFormat('l, d F Y') }}</strong>
            </div>
            <div class="topbar-actions">
                <a href="{{ route('warga.profile') }}" class="icon-button" title="Profil"><i class="fas fa-user"></i></a>
                <a href="{{ route('warga.laporan.create') }}" class="button"><i class="fas fa-plus"></i><span>Buat Laporan</span></a>
            </div>
        </div>

        <div class="page-content">
            <div class="flash-stack">
                @if(session('success'))
                    <div class="flash success"><i class="fas fa-circle-check mt-1"></i><div>{{ session('success') }}</div></div>
                @endif
                @if(session('error'))
                    <div class="flash error"><i class="fas fa-circle-exclamation mt-1"></i><div>{{ session('error') }}</div></div>
                @endif
            </div>
            @yield('content')
        </div>
    </main>
</div>

<nav class="mobile-nav">
    <a href="{{ route('warga.dashboard') }}" class="mobile-link {{ request()->routeIs('warga.dashboard') ? 'active' : '' }}"><i class="fas fa-house"></i><span>Home</span></a>
    <a href="{{ route('warga.laporan.semua') }}" class="mobile-link {{ request()->routeIs('warga.laporan.semua') || request()->routeIs('warga.laporan.detail_umum') ? 'active' : '' }}"><i class="fas fa-compass"></i><span>Jelajah</span></a>
    <a href="{{ route('warga.laporan.create') }}" class="mobile-link {{ request()->routeIs('warga.laporan.create') ? 'active' : '' }}"><i class="fas fa-plus"></i><span>Lapor</span></a>
    <a href="{{ route('warga.saran.index') }}" class="mobile-link {{ request()->routeIs('warga.saran.*') ? 'active' : '' }}"><i class="fas fa-lightbulb"></i><span>Saran</span></a>
    <a href="{{ route('warga.profile') }}" class="mobile-link {{ request()->routeIs('warga.profile*') ? 'active' : '' }}"><i class="fas fa-user"></i><span>Profil</span></a>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@stack('scripts')
</body>
</html>
