<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - JAKI</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            min-height: 100vh;
            color: #1e293b;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #0288d1 0%, #01579b 100%);
            padding: 1rem 2rem;
            box-shadow: 0 4px 20px rgba(2, 136, 209, 0.3);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .logo i {
            font-size: 2rem;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .notification-btn {
            position: relative;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s;
        }

        .notification-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.05);
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef5350;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .user-info:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0288d1;
            font-weight: 600;
        }

        .user-name {
            color: white;
            font-weight: 500;
        }

        /* Main Container */
        .container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        /* Welcome Section */
        .welcome-section {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .welcome-text h1 {
            font-size: 2rem;
            color: #0288d1;
            margin-bottom: 0.5rem;
        }

        .welcome-text p {
            color: #64748b;
            font-size: 1.1rem;
        }

        .welcome-illustration {
            font-size: 5rem;
            color: #0288d1;
            opacity: 0.8;
        }

        /* Quick Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
            transition: all 0.3s;
            border-left: 4px solid;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .stat-card.blue {
            border-color: #0288d1;
        }

        .stat-card.green {
            border-color: #66bb6a;
        }

        .stat-card.orange {
            border-color: #ffa726;
        }

        .stat-card.purple {
            border-color: #ab47bc;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stat-card.blue .stat-icon {
            background: #e3f2fd;
            color: #0288d1;
        }

        .stat-card.green .stat-icon {
            background: #e8f5e9;
            color: #66bb6a;
        }

        .stat-card.orange .stat-icon {
            background: #fff3e0;
            color: #ffa726;
        }

        .stat-card.purple .stat-icon {
            background: #f3e5f5;
            color: #ab47bc;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #64748b;
            font-size: 0.9rem;
        }

        /* Quick Actions */
        .quick-actions {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .section-title {
            font-size: 1.5rem;
            color: #1e293b;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: #0288d1;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .action-btn {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border: 2px solid #90caf9;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(2, 136, 209, 0.2);
            background: linear-gradient(135deg, #bbdefb 0%, #90caf9 100%);
        }

        .action-btn i {
            font-size: 2.5rem;
            color: #0288d1;
            margin-bottom: 0.5rem;
        }

        .action-btn span {
            display: block;
            font-weight: 600;
            color: #1e293b;
        }

        /* Recent Activity */
        .recent-activity {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 12px;
            transition: all 0.3s;
        }

        .activity-item:hover {
            background: #e3f2fd;
            transform: translateX(5px);
        }

        .activity-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .activity-icon.success {
            background: #e8f5e9;
            color: #66bb6a;
        }

        .activity-icon.info {
            background: #e3f2fd;
            color: #0288d1;
        }

        .activity-icon.warning {
            background: #fff3e0;
            color: #ffa726;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .activity-time {
            color: #64748b;
            font-size: 0.85rem;
        }

        /* Services Grid */
        .services-section {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .service-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 2px solid #e3f2fd;
            border-radius: 16px;
            padding: 1.5rem;
            transition: all 0.3s;
            cursor: pointer;
        }

        .service-card:hover {
            border-color: #90caf9;
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(2, 136, 209, 0.15);
        }

        .service-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .service-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            background: linear-gradient(135deg, #0288d1 0%, #01579b 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }

        .service-info h3 {
            color: #1e293b;
            font-size: 1.1rem;
            margin-bottom: 0.25rem;
        }

        .service-status {
            font-size: 0.85rem;
            color: #66bb6a;
            font-weight: 500;
        }

        .service-description {
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .service-action {
            background: linear-gradient(135deg, #0288d1 0%, #01579b 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
        }

        .service-action:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 15px rgba(2, 136, 209, 0.3);
        }

        /* Footer */
        .footer {
            background: white;
            padding: 2rem;
            text-align: center;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            color: #64748b;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 0 1rem;
            }

            .welcome-section {
                flex-direction: column;
                text-align: center;
            }

            .welcome-text h1 {
                font-size: 1.5rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .actions-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .services-grid {
                grid-template-columns: 1fr;
            }

            .header-content {
                padding: 0;
            }

            .logo {
                font-size: 1.2rem;
            }

            .user-name {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <div class="logo">
                <i class="fas fa-city"></i>
                <span>JAKI User</span>
            </div>
            <div class="user-menu">
                <button class="notification-btn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </button>
                <div class="user-info">
                    <div class="user-avatar">JD</div>
                    <span class="user-name">John Doe</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <div class="container">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <div class="welcome-text">
                <h1>Selamat Datang Kembali! 👋</h1>
                <p>Kelola semua layanan Jakarta dalam satu tempat</p>
            </div>
            <div class="welcome-illustration">
                <i class="fas fa-city"></i>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="stats-grid">
            <div class="stat-card blue">
                <div class="stat-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stat-value">12</div>
                <div class="stat-label">Total Pengaduan</div>
            </div>
            <div class="stat-card green">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-value">8</div>
                <div class="stat-label">Pengaduan Selesai</div>
            </div>
            <div class="stat-card orange">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-value">3</div>
                <div class="stat-label">Dalam Proses</div>
            </div>
            <div class="stat-card purple">
                <div class="stat-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-value">4.8</div>
                <div class="stat-label">Rating Kepuasan</div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <h2 class="section-title">
                <i class="fas fa-bolt"></i>
                Aksi Cepat
            </h2>
            <div class="actions-grid">
                <a href="#" class="action-btn">
                    <i class="fas fa-plus-circle"></i>
                    <span>Buat Pengaduan</span>
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-search"></i>
                    <span>Lacak Pengaduan</span>
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-file-invoice"></i>
                    <span>Cek Tagihan</span>
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Jadwalkan Layanan</span>
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="recent-activity">
            <h2 class="section-title">
                <i class="fas fa-history"></i>
                Aktivitas Terbaru
            </h2>
            <div class="activity-list">
                <div class="activity-item">
                    <div class="activity-icon success">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Pengaduan Jalan Berlubang Selesai</div>
                        <div class="activity-time">2 jam yang lalu</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon info">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Pengaduan Lampu Jalan dalam Proses</div>
                        <div class="activity-time">5 jam yang lalu</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon warning">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Tagihan PBB Jatuh Tempo dalam 3 Hari</div>
                        <div class="activity-time">1 hari yang lalu</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Services Section -->
        <div class="services-section">
            <h2 class="section-title">
                <i class="fas fa-th-large"></i>
                Layanan Tersedia
            </h2>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <div class="service-info">
                            <h3>Pengaduan Masyarakat</h3>
                            <span class="service-status">● Aktif</span>
                        </div>
                    </div>
                    <p class="service-description">
                        Sampaikan keluhan atau aspirasi Anda tentang berbagai masalah di Jakarta
                    </p>
                    <button class="service-action">Akses Layanan</button>
                </div>

                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <div class="service-info">
                            <h3>Pembayaran Pajak</h3>
                            <span class="service-status">● Aktif</span>
                        </div>
                    </div>
                    <p class="service-description">
                        Bayar PBB, pajak kendaraan, dan pajak lainnya dengan mudah
                    </p>
                    <button class="service-action">Akses Layanan</button>
                </div>

                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <div class="service-info">
                            <h3>Administrasi Kependudukan</h3>
                            <span class="service-status">● Aktif</span>
                        </div>
                    </div>
                    <p class="service-description">
                        Urus KTP, KK, dan dokumen kependudukan lainnya secara online
                    </p>
                    <button class="service-action">Akses Layanan</button>
                </div>

                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="service-info">
                            <h3>Izin Usaha & Bangunan</h3>
                            <span class="service-status">● Aktif</span>
                        </div>
                    </div>
                    <p class="service-description">
                        Ajukan dan kelola perizinan usaha dan bangunan Anda
                    </p>
                    <button class="service-action">Akses Layanan</button>
                </div>

                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <div class="service-info">
                            <h3>Layanan Kesehatan</h3>
                            <span class="service-status">● Aktif</span>
                        </div>
                    </div>
                    <p class="service-description">
                        Akses informasi kesehatan, jadwal vaksinasi, dan layanan medis
                    </p>
                    <button class="service-action">Akses Layanan</button>
                </div>

                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="service-info">
                            <h3>Pendidikan</h3>
                            <span class="service-status">● Aktif</span>
                        </div>
                    </div>
                    <p class="service-description">
                        Informasi sekolah, pendaftaran siswa baru, dan beasiswa
                    </p>
                    <button class="service-action">Akses Layanan</button>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>© 2024 JAKI - Jakarta Kini. Semua hak dilindungi.</p>
            <p style="margin-top: 0.5rem; font-size: 0.9rem;">
                <i class="fas fa-shield-alt"></i> Data Anda aman dan terlindungi
            </p>
        </div>
    </div>

    <script>
        // Add smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add click animations
        document.querySelectorAll('.action-btn, .service-action').forEach(btn => {
            btn.addEventListener('click', function(e) {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });

        // Notification button animation
        document.querySelector('.notification-btn').addEventListener('click', function() {
            alert('Anda memiliki 3 notifikasi baru!');
        });

        // User menu dropdown
        document.querySelector('.user-info').addEventListener('click', function() {
            alert('Menu profil user akan ditampilkan di sini');
        });
    </script>
</body>
</html>