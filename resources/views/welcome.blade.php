<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor Aja! - Sistem Pengaduan & Saran Warga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #2563eb;
            --secondary-blue: #3b82f6;
            --light-blue: #60a5fa;
            --lighter-blue: #dbeafe;
            --dark-blue: #1e40af;
            --gradient-start: #2563eb;
            --gradient-end: #1d4ed8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            overflow-x: hidden;
            color: #1e293b;
            background: #ffffff;
        }

        /* Navbar */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            padding: 1.2rem 0;
            transition: all 0.3s ease;
        }

        .navbar-custom.scrolled {
            padding: 0.8rem 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .btn-login {
            padding: 0.6rem 1.8rem;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            background: var(--primary-blue);
            color: white;
            text-decoration: none;
            display: inline-block;
        }

        .btn-login:hover {
            background: var(--dark-blue);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.3);
            color: white;
        }

        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            background: linear-gradient(135deg, #f0f9ff 0%, #ffffff 100%);
            position: relative;
            padding-top: 100px;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.08) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.06) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 4rem 0;
        }

        .hero-title {
            font-size: 3.8rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            letter-spacing: -0.02em;
        }

        .hero-title .highlight {
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: #64748b;
            margin-bottom: 2.5rem;
            line-height: 1.8;
            max-width: 600px;
        }

        .btn-hero-primary {
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            color: white;
            border: none;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.25);
        }

        .btn-hero-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(37, 99, 235, 0.35);
            color: white;
        }

        .btn-hero-secondary {
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 12px;
            background: white;
            color: var(--primary-blue);
            border: 2px solid var(--lighter-blue);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-hero-secondary:hover {
            border-color: var(--primary-blue);
            background: var(--lighter-blue);
            color: var(--dark-blue);
            transform: translateY(-3px);
        }

        /* Hero Illustration */
        .hero-illustration {
            position: relative;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .illustration-card {
            background: white;
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(37, 99, 235, 0.1);
        }

        /* Features Section */
        .features-section {
            padding: 6rem 0;
            background: white;
            position: relative;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: #64748b;
            margin-bottom: 4rem;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            height: 100%;
            transition: all 0.3s ease;
            border: 1px solid #f1f5f9;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(37, 99, 235, 0.15);
            border-color: var(--lighter-blue);
        }

        .feature-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, var(--lighter-blue), #bfdbfe);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .feature-icon i {
            font-size: 28px;
            color: var(--primary-blue);
        }

        .feature-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #0f172a;
        }

        .feature-text {
            color: #64748b;
            line-height: 1.8;
            font-size: 1rem;
        }

        /* Stats Section */
        .stats-section {
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            padding: 5rem 0;
            position: relative;
            overflow: hidden;
        }

        .stats-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1.5" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
        }

        .stat-item {
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .stat-number {
            font-size: 3.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .stat-label {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.95);
            font-weight: 500;
        }

        /* CTA Section */
        .cta-section {
            padding: 6rem 0;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }

        .cta-card {
            background: white;
            border-radius: 24px;
            padding: 4rem 3rem;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(37, 99, 235, 0.1);
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 1.5rem;
        }

        .cta-text {
            font-size: 1.2rem;
            color: #64748b;
            margin-bottom: 2.5rem;
        }

        /* Footer */
        .footer {
            background: #0f172a;
            color: white;
            padding: 3rem 0 1.5rem;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .footer-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-links {
            display: flex;
            gap: 2rem;
        }

        .footer-link {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1.5rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .hero-content {
                padding: 2rem 0;
            }

            .stat-number {
                font-size: 2.5rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .btn-hero-primary,
            .btn-hero-secondary {
                padding: 0.9rem 2rem;
                font-size: 1rem;
                width: 100%;
                justify-content: center;
            }

            .footer-content {
                flex-direction: column;
                gap: 1.5rem;
                text-align: center;
            }

            .footer-links {
                flex-direction: column;
                gap: 1rem;
            }

            .cta-card {
                padding: 3rem 2rem;
            }

            .cta-title {
                font-size: 2rem;
            }
        }

        /* Scroll animations */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <div class="brand-icon">
                    <i class="fas fa-bullhorn"></i>
                </div>
                LaporAja!
            </a>
            <div class="ms-auto">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-login">
                            <i class="fas fa-th-large me-2"></i>Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-login">
                            <i class="fas fa-sign-in-alt me-2"></i>Masuk
                        </a>
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
                    <h1 class="hero-title fade-in">
                        Sistem Pelaporan & Saran<br>
                        <span class="highlight">Warga Digital</span>
                    </h1>
                    <p class="hero-subtitle fade-in">
                        Laporkan masalah di lingkungan Anda dengan mudah dan cepat. 
                        Kami siap membantu mewujudkan lingkungan yang lebih baik untuk semua.
                    </p>
                    <div class="d-flex gap-3 flex-wrap fade-in">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn-hero-primary">
                                    <i class="fas fa-rocket"></i>
                                    Ke Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn-hero-primary">
                                    <i class="fas fa-user"></i>
                                    Masuk Sekarang
                                </a>
                                <a href="#features" class="btn-hero-secondary">
                                    <i class="fas fa-info-circle"></i>
                                    Pelajari Lebih Lanjut
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-illustration">
                        <div class="illustration-card">
                            <svg viewBox="0 0 500 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Background elements -->
                                <rect x="50" y="50" width="400" height="300" rx="20" fill="#f8fafc"/>
                                <rect x="70" y="70" width="360" height="260" rx="15" fill="white" stroke="#e2e8f0" stroke-width="2"/>
                                
                                <!-- Header -->
                                <rect x="90" y="90" width="120" height="30" rx="15" fill="#dbeafe"/>
                                <circle cx="390" cy="105" r="15" fill="#2563eb"/>
                                
                                <!-- Content lines -->
                                <rect x="90" y="150" width="320" height="12" rx="6" fill="#e2e8f0"/>
                                <rect x="90" y="175" width="280" height="12" rx="6" fill="#e2e8f0"/>
                                <rect x="90" y="200" width="250" height="12" rx="6" fill="#e2e8f0"/>
                                
                                <!-- Card elements -->
                                <rect x="90" y="240" width="150" height="70" rx="12" fill="#2563eb" opacity="0.1"/>
                                <circle cx="130" cy="275" r="20" fill="#2563eb"/>
                                <rect x="160" y="265" width="60" height="8" rx="4" fill="#2563eb" opacity="0.5"/>
                                <rect x="160" y="280" width="40" height="8" rx="4" fill="#2563eb" opacity="0.3"/>
                                
                                <rect x="260" y="240" width="150" height="70" rx="12" fill="#60a5fa" opacity="0.1"/>
                                <circle cx="300" cy="275" r="20" fill="#60a5fa"/>
                                <rect x="330" y="265" width="60" height="8" rx="4" fill="#60a5fa" opacity="0.5"/>
                                <rect x="330" y="280" width="40" height="8" rx="4" fill="#60a5fa" opacity="0.3"/>
                                
                                <!-- Floating elements -->
                                <circle cx="420" cy="140" r="25" fill="#2563eb" opacity="0.2">
                                    <animate attributeName="cy" values="140;130;140" dur="3s" repeatCount="indefinite"/>
                                </circle>
                                <circle cx="60" cy="250" r="20" fill="#60a5fa" opacity="0.2">
                                    <animate attributeName="cy" values="250;240;250" dur="4s" repeatCount="indefinite"/>
                                </circle>
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
                <h2 class="section-title fade-in">Kenapa Memilih Lapor Aja?</h2>
                <p class="section-subtitle fade-in">Solusi modern untuk pelaporan masalah di lingkungan Anda</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card fade-in">
                        <div class="feature-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h3 class="feature-title">Mudah & Cepat</h3>
                        <p class="feature-text">
                            Laporkan masalah hanya dalam hitungan menit dengan antarmuka yang sederhana dan intuitif. Tidak perlu proses rumit.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card fade-in">
                        <div class="feature-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3 class="feature-title">Transparan</h3>
                        <p class="feature-text">
                            Pantau status laporan Anda secara real-time dan lihat progres penanganan dari tim admin dengan jelas.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card fade-in">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3 class="feature-title">Responsif</h3>
                        <p class="feature-text">
                            Tim admin siap menanggapi dan menindaklanjuti setiap laporan yang masuk dengan cepat dan profesional.
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
                    <div class="stat-item fade-in">
                        <div class="stat-number">1000+</div>
                        <div class="stat-label">Laporan Ditangani</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item fade-in">
                        <div class="stat-number">95%</div>
                        <div class="stat-label">Tingkat Kepuasan</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item fade-in">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Pengguna Aktif</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-card fade-in">
                <h2 class="cta-title">Siap Membuat Perubahan?</h2>
                <p class="cta-text">Bergabunglah dengan ribuan warga yang telah mempercayai platform kami untuk menciptakan lingkungan yang lebih baik.</p>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-hero-primary">
                            <i class="fas fa-rocket"></i>
                            Mulai Sekarang
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-hero-primary">
                            <i class="fas fa-user-plus"></i>
                            Daftar Sekarang
                        </a>
                    @endauth
                @endif
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="brand-icon">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    LaporAja!
                </div>
                <div class="footer-links">
                    <a href="#" class="footer-link">Tentang Kami</a>
                    <a href="#features" class="footer-link">Fitur</a>
                    <a href="#" class="footer-link">Kontak</a>
                    <a href="#" class="footer-link">FAQ</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Lapor Aja!. All rights reserved. Sistem Pelaporan Warga Digital.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar-custom');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>