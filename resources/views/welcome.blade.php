<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor Aja! - Sistem Pengaduan & saran Warga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            overflow-x: hidden;
        }

        .hero-section {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }

        .navbar-custom {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 8rem 0 4rem;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 2.5rem;
            font-weight: 300;
        }

        .btn-hero {
            padding: 1rem 3rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .btn-primary-custom {
            background: white;
            color: #667eea;
            border: none;
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            color: #667eea;
        }

        .btn-outline-custom {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-outline-custom:hover {
            background: white;
            color: #667eea;
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .features-section {
            padding: 6rem 0;
            background: #f8f9fa;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            height: 100%;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.08);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .feature-icon svg {
            width: 35px;
            height: 35px;
            color: white;
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #2d3748;
        }

        .feature-text {
            color: #718096;
            line-height: 1.8;
        }

        .stats-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 4rem 0;
            color: white;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .hero-illustration {
            position: relative;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        .illustration-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .hero-content {
                padding: 4rem 0 2rem;
            }

            .stat-number {
                font-size: 2rem;
            }
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: #2d3748;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: #718096;
            margin-bottom: 3rem;
        }

        .footer {
            background: #2d3748;
            color: white;
            padding: 3rem 0 1.5rem;
        }

        .footer-text {
            opacity: 0.8;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <svg width="32" height="32" fill="currentColor">
                    <path d="M16 2L2 9v13c0 7.33 5.06 14.19 12 16 6.94-1.81 12-8.67 12-16V9L16 2zm0 14.99h9.5c-.73 5.44-4.31 10.28-9.5 11.8V16H7V11h9V2.99c5.19 1.52 8.77 6.36 9.5 11.8H16v2.2z"/>
                </svg>
                Lapor Aja!
            </a>
            <div class="ms-auto">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary-custom">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary-custom">Login</a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="hero-title">
                        Sistem Pelaporan<br>
                        <span style="color: #ffd700;">Warga Digital</span>
                    </h1>
                    <p class="hero-subtitle">
                        Laporkan masalah di lingkungan Anda dengan mudah dan cepat. 
                        Kami siap membantu mewujudkan lingkungan yang lebih baik.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary-custom">
                                    <svg width="20" height="20" fill="currentColor" class="me-2" style="vertical-align: text-bottom;">
                                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                                    </svg>
                                    Ke Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary-custom">
                                    <svg width="20" height="20" fill="currentColor" class="me-2" style="vertical-align: text-bottom;">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                                    </svg>
                                    Masuk Sekarang
                                </a>
                                <a href="#features" class="btn btn-outline-custom">
                                    Pelajari Lebih Lanjut
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-illustration">
                        <div class="illustration-card">
                            <svg viewBox="0 0 400 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Illustration -->
                                <rect x="50" y="50" width="300" height="200" rx="10" fill="white" opacity="0.9"/>
                                <circle cx="100" cy="100" r="30" fill="#667eea"/>
                                <rect x="150" y="80" width="150" height="15" rx="7.5" fill="#667eea" opacity="0.3"/>
                                <rect x="150" y="110" width="100" height="15" rx="7.5" fill="#764ba2" opacity="0.3"/>
                                <rect x="70" y="160" width="260" height="60" rx="8" fill="#f8f9fa"/>
                                <circle cx="320" cy="190" r="20" fill="#ffd700"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Kenapa Memilih Lapor Aja?</h2>
                <p class="section-subtitle">Solusi modern untuk pelaporan masalah di lingkungan Anda</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        </div>
                        <h3 class="feature-title">Mudah & Cepat</h3>
                        <p class="feature-text">
                            Laporkan masalah hanya dalam hitungan menit dengan antarmuka yang sederhana dan intuitif.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                            </svg>
                        </div>
                        <h3 class="feature-title">Transparan</h3>
                        <p class="feature-text">
                            Pantau status laporan Anda secara real-time dan lihat laporan dari warga lainnya.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.61l-1.92-3.32c-.12-.22-.37-.29-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94L14.4 2.81c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22L2.74 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.05.3-.09.63-.09.94s.02.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/>
                            </svg>
                        </div>
                        <h3 class="feature-title">Responsif</h3>
                        <p class="feature-text">
                            Tim admin siap menanggapi dan menindaklanjuti setiap laporan yang masuk dengan cepat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">1000+</div>
                        <div class="stat-label">Laporan Ditangani</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">95%</div>
                        <div class="stat-label">Tingkat Kepuasan</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Pengguna Aktif</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <p class="footer-text mb-2">&copy; 2025 Lapor Aja!. All rights reserved.</p>
            <p class="footer-text small">Sistem Pelaporan Warga Digital</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>