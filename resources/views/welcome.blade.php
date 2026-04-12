<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaporAja! - Layanan Pengaduan dan Aspirasi Warga</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root {
            --brand: #0f6cbd;
            --brand-deep: #0a4f8a;
            --brand-soft: #dff1ff;
            --accent: #14b8a6;
            --ink: #0f172a;
            --muted: #5b6b84;
            --line: rgba(148, 163, 184, 0.22);
            --card: rgba(255, 255, 255, 0.88);
            --shadow: 0 24px 70px rgba(15, 23, 42, 0.08);
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at top left, rgba(20, 184, 166, 0.12), transparent 28%),
                radial-gradient(circle at 85% 15%, rgba(15, 108, 189, 0.18), transparent 25%),
                linear-gradient(180deg, #eef7ff 0%, #f8fbff 30%, #ffffff 100%);
            overflow-x: hidden;
        }

        a { text-decoration: none; }
        .page-shell { min-height: 100vh; position: relative; }
        .container-xl { position: relative; z-index: 1; }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 30;
            backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.76);
            border-bottom: 1px solid rgba(255, 255, 255, 0.65);
        }

        .nav-wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 1rem 0;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 0.85rem;
            color: var(--ink);
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .brand-mark {
            width: 2.9rem;
            height: 2.9rem;
            border-radius: 1rem;
            display: grid;
            place-items: center;
            color: white;
            font-size: 1.1rem;
            background: linear-gradient(135deg, var(--brand), #3aa0e3);
            box-shadow: 0 12px 24px rgba(15, 108, 189, 0.28);
        }

        .brand-copy small {
            display: block;
            font-size: 0.74rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--brand);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .nav-link-lite {
            color: var(--muted);
            font-weight: 600;
            padding: 0.7rem 1rem;
            border-radius: 999px;
        }

        .nav-link-lite:hover {
            background: rgba(15, 108, 189, 0.08);
            color: var(--brand);
        }

        .btn-main, .btn-soft, .btn-outline-soft {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.7rem;
            border-radius: 1rem;
            font-weight: 700;
            padding: 0.95rem 1.35rem;
            transition: 0.25s ease;
        }

        .btn-main {
            color: white;
            background: linear-gradient(135deg, var(--brand), #2b8ad2);
            box-shadow: 0 16px 30px rgba(15, 108, 189, 0.22);
        }

        .btn-main:hover { color: white; transform: translateY(-2px); }

        .btn-soft {
            color: var(--brand);
            background: white;
            border: 1px solid rgba(15, 108, 189, 0.16);
        }

        .btn-outline-soft {
            color: var(--ink);
            border: 1px solid var(--line);
            background: rgba(255, 255, 255, 0.72);
        }

        .hero { padding: 4.5rem 0 3rem; }

        .hero-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.1fr) minmax(320px, 0.9fr);
            gap: 2rem;
            align-items: center;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.6rem 0.9rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.84);
            border: 1px solid rgba(15, 108, 189, 0.12);
            color: var(--brand);
            font-size: 0.9rem;
            font-weight: 700;
        }

        .hero h1 {
            margin: 1.2rem 0 1rem;
            font-size: clamp(2.45rem, 5vw, 4.6rem);
            line-height: 1.08;
            letter-spacing: -0.04em;
        }

        .hero h1 span { color: var(--brand); }

        .hero p, .section-head p, .service-card p, .step-card p, .stat-card span, .cta-card p {
            color: var(--muted);
            line-height: 1.8;
        }

        .hero-actions, .hero-meta {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        .meta-chip, .service-card, .step-card, .stat-card, .cta-card, .hero-card {
            border-radius: 1.5rem;
            background: var(--card);
            border: 1px solid rgba(255, 255, 255, 0.72);
            box-shadow: var(--shadow);
        }

        .meta-chip {
            min-width: 10.2rem;
            padding: 1rem 1.1rem;
        }

        .meta-chip strong { display: block; font-size: 1.2rem; margin-bottom: 0.25rem; }

        .hero-card { padding: 1.4rem; }

        .hero-panel {
            background: #ffffff;
            border-radius: 1.6rem;
            padding: 1.4rem;
            border: 1px solid rgba(148, 163, 184, 0.15);
        }

        .panel-top, .report-header, .report-footer, .footer-box, .cta-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .panel-badge, .report-tag, .status-pill {
            padding: 0.5rem 0.8rem;
            border-radius: 999px;
            font-weight: 700;
            font-size: 0.84rem;
        }

        .panel-badge, .report-tag {
            background: var(--brand-soft);
            color: var(--brand);
        }

        .status-pill {
            background: rgba(20, 184, 166, 0.12);
            color: #0f766e;
        }

        .report-card {
            padding: 1.2rem;
            border-radius: 1.2rem;
            background: linear-gradient(180deg, #f8fbff, #f2f8ff);
            border: 1px solid rgba(15, 108, 189, 0.1);
        }

        .report-card + .report-card { margin-top: 1rem; }
        .report-title { font-size: 1rem; font-weight: 700; margin-bottom: 0.45rem; }
        .report-text { font-size: 0.93rem; margin-bottom: 0.9rem; }

        .report-dot {
            width: 0.65rem;
            height: 0.65rem;
            border-radius: 50%;
            background: var(--accent);
            box-shadow: 0 0 0 0.3rem rgba(20, 184, 166, 0.12);
        }

        .section { padding: 2rem 0 0; }
        .section-head { max-width: 42rem; margin-bottom: 1.75rem; }
        .section-head span { display: inline-block; color: var(--brand); font-weight: 700; margin-bottom: 0.75rem; }
        .section-head h2, .cta-card h3 {
            letter-spacing: -0.03em;
            line-height: 1.15;
        }

        .section-head h2 { font-size: clamp(1.85rem, 3vw, 3rem); margin-bottom: 0.85rem; }
        .services-grid, .steps-grid, .stats-grid { display: grid; gap: 1.25rem; }
        .services-grid, .steps-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .stats-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); }

        .service-card, .step-card, .stat-card { padding: 1.5rem; }

        .icon-box, .step-number {
            width: 3.25rem;
            height: 3.25rem;
            border-radius: 1rem;
            display: inline-grid;
            place-items: center;
            margin-bottom: 1rem;
        }

        .icon-box {
            color: var(--brand);
            background: linear-gradient(135deg, #eef7ff, #dff1ff);
        }

        .step-number {
            background: linear-gradient(135deg, var(--brand), #3aa0e3);
            color: white;
            font-weight: 800;
        }

        .service-card h3, .step-card h3, .stat-card strong {
            font-size: 1.15rem;
            margin-bottom: 0.75rem;
            font-weight: 800;
        }

        .stats-band {
            margin-top: 2rem;
            padding: 1.6rem;
            border-radius: 2rem;
            background: linear-gradient(135deg, #0c5a99, #1080d3);
            color: white;
            box-shadow: 0 24px 60px rgba(15, 108, 189, 0.22);
        }

        .stats-band .stat-card {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.14);
            box-shadow: none;
        }

        .stats-band .stat-card strong, .stats-band .stat-card span { color: white; }

        .cta-card {
            margin-top: 2rem;
            padding: 2rem;
            background:
                radial-gradient(circle at top right, rgba(20, 184, 166, 0.14), transparent 24%),
                linear-gradient(180deg, rgba(255, 255, 255, 0.94), rgba(243, 248, 255, 0.95));
        }

        .footer { padding: 2.5rem 0 3rem; color: var(--muted); }
        .footer-box { padding-top: 1.5rem; border-top: 1px solid rgba(148, 163, 184, 0.18); }
        .footer-note { display: flex; align-items: center; gap: 0.75rem; font-weight: 600; color: var(--ink); }

        @media (max-width: 1199px) {
            .services-grid, .steps-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

        @media (max-width: 991px) {
            .nav-wrap { flex-direction: column; align-items: flex-start; }
            .nav-links { width: 100%; justify-content: flex-start; }
            .hero { padding-top: 2.25rem; }
            .hero-grid, .cta-card { grid-template-columns: 1fr; display: grid; }
        }

        @media (max-width: 767px) {
            .services-grid, .steps-grid, .stats-grid { grid-template-columns: 1fr; }
            .hero-actions, .nav-links { flex-direction: column; align-items: stretch; }
            .btn-main, .btn-soft, .btn-outline-soft { width: 100%; }
            .panel-top, .report-header, .report-footer, .footer-box { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>
    <div class="page-shell">
        <header class="topbar">
            <div class="container container-xl">
                <div class="nav-wrap">
                    <a href="/" class="brand">
                        <div class="brand-mark"><i class="fas fa-bullhorn"></i></div>
                        <div class="brand-copy">
                            <small>Portal Layanan Warga</small>
                            <span>LaporAja!</span>
                        </div>
                    </a>
                    <nav class="nav-links">
                        <a href="#layanan" class="nav-link-lite">Layanan</a>
                        <a href="#cara-kerja" class="nav-link-lite">Cara Kerja</a>
                        <a href="{{ route('laporan.publik') }}" class="nav-link-lite">Laporan Publik</a>
                        <a href="{{ route('login') }}" class="btn-outline-soft"><i class="fas fa-arrow-right-to-bracket"></i>Masuk</a>
                        <a href="{{ route('register') }}" class="btn-main"><i class="fas fa-user-plus"></i>Daftar Sekarang</a>
                    </nav>
                </div>
            </div>
        </header>

        <main>
            <section class="hero">
                <div class="container container-xl">
                    <div class="hero-grid">
                        <div>
                            <div class="eyebrow"><i class="fas fa-shield-heart"></i>Kanal aspirasi warga yang cepat, rapi, dan mudah diakses</div>
                            <h1>Layanan pengaduan warga yang <span>lebih modern</span> dan terasa dekat.</h1>
                            <p>SiPena membantu warga menyampaikan laporan, usulan, dan masukan dalam satu portal yang sederhana. Alurnya dibuat jelas seperti aplikasi layanan publik modern: kirim, pantau status, lalu lihat tindak lanjutnya.</p>
                            <div class="hero-actions">
                                <a href="{{ route('register') }}" class="btn-main"><i class="fas fa-paper-plane"></i>Buat Laporan Sekarang</a>
                                <a href="{{ route('laporan.publik') }}" class="btn-soft"><i class="fas fa-chart-line"></i>Lihat Laporan Publik</a>
                            </div>
                            <div class="hero-meta">
                                <div class="meta-chip"><strong>24/7</strong><span>Akses layanan kapan saja dari perangkat apa pun.</span></div>
                                <div class="meta-chip"><strong>Transparan</strong><span>Status laporan mudah dipantau tanpa proses berbelit.</span></div>
                                <div class="meta-chip"><strong>Responsif</strong><span>Tampilan nyaman dibuka di ponsel, tablet, maupun desktop.</span></div>
                            </div>
                        </div>

                        <div class="hero-card">
                            <div class="hero-panel">
                                <div class="panel-top">
                                    <div class="panel-badge">Dashboard Warga</div>
                                    <div class="status-pill"><i class="fas fa-circle-check"></i>Layanan Aktif</div>
                                </div>

                                <div class="report-card">
                                    <div class="report-header">
                                        <div class="d-flex align-items-center gap-2"><div class="report-dot"></div><strong>Drainase lingkungan tersumbat</strong></div>
                                        <span class="report-tag">Diproses</span>
                                    </div>
                                    <div class="report-text">Laporan masuk lengkap dengan lokasi, foto, dan kronologi sehingga tim dapat menindaklanjuti lebih cepat.</div>
                                    <div class="report-footer"><small class="text-secondary">Diperbarui 12 menit lalu</small><small class="text-secondary">RW 05</small></div>
                                </div>

                                <div class="report-card">
                                    <div class="report-header">
                                        <div><div class="report-title">Alur penanganan lebih mudah dipahami</div></div>
                                        <span class="report-tag">Terverifikasi</span>
                                    </div>
                                    <div class="report-text">Warga bisa melihat status, riwayat perubahan, dan hasil tindak lanjut dalam satu tampilan yang ringkas.</div>
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="panel-badge">Pengaduan</span>
                                        <span class="panel-badge">Saran</span>
                                        <span class="panel-badge">Riwayat Status</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section" id="layanan">
                <div class="container container-xl">
                    <div class="section-head">
                        <span>Layanan Utama</span>
                        <h2>Dirancang seperti portal layanan digital yang ringan, jelas, dan terpercaya.</h2>
                        <p>Fokus tampilan dibuat minimalis agar warga langsung paham ke mana harus melapor, bagaimana memantau prosesnya, dan bagaimana melihat hasil tindak lanjut dari admin atau petugas.</p>
                    </div>

                    <div class="services-grid">
                        <article class="service-card">
                            <div class="icon-box"><i class="fas fa-file-circle-plus"></i></div>
                            <h3>Kirim Laporan Lebih Cepat</h3>
                            <p>Form dirancang simpel dengan fokus pada isi laporan, lokasi, dan bukti pendukung agar proses input tidak melelahkan.</p>
                        </article>
                        <article class="service-card">
                            <div class="icon-box"><i class="fas fa-timeline"></i></div>
                            <h3>Pantau Status Secara Realistis</h3>
                            <p>Setiap laporan bisa dipantau tahapannya sehingga warga merasa terhubung dengan progres penanganan.</p>
                        </article>
                        <article class="service-card">
                            <div class="icon-box"><i class="fas fa-comments"></i></div>
                            <h3>Saran dan Aspirasi Terpusat</h3>
                            <p>Selain pengaduan, aspirasi dan usulan perbaikan lingkungan dapat dikumpulkan dalam kanal yang sama.</p>
                        </article>
                    </div>
                </div>
            </section>

            <section class="section" id="cara-kerja">
                <div class="container container-xl">
                    <div class="section-head">
                        <span>Cara Kerja</span>
                        <h2>Tiga langkah sederhana agar layanan publik terasa cepat dipahami.</h2>
                        <p>Pola interaksi dibuat familiar seperti aplikasi layanan kota modern: warga mengirim, sistem mencatat, lalu admin memproses dengan status yang mudah dibaca.</p>
                    </div>

                    <div class="steps-grid">
                        <article class="step-card">
                            <div class="step-number">01</div>
                            <h3>Masuk atau daftar akun</h3>
                            <p>Warga membuat akun dengan email aktif agar notifikasi dan verifikasi berjalan lancar.</p>
                        </article>
                        <article class="step-card">
                            <div class="step-number">02</div>
                            <h3>Kirim pengaduan atau saran</h3>
                            <p>Isi formulir secara singkat, tambahkan detail penting, lalu kirim dari ponsel atau laptop.</p>
                        </article>
                        <article class="step-card">
                            <div class="step-number">03</div>
                            <h3>Lihat progres dan tindak lanjut</h3>
                            <p>Status laporan diperbarui dari waktu ke waktu sehingga komunikasi terasa lebih terbuka.</p>
                        </article>
                    </div>

                    <div class="stats-band">
                        <div class="stats-grid">
                            <article class="stat-card"><strong>Portal Satu Pintu</strong><span>Pengaduan, saran, dan riwayat laporan ada dalam satu pengalaman yang konsisten.</span></article>
                            <article class="stat-card"><strong>Mobile Friendly</strong><span>Tata letak fleksibel untuk layar kecil tanpa mengorbankan kenyamanan baca.</span></article>
                            <article class="stat-card"><strong>Visual Lebih Bersih</strong><span>Komponen modern dengan ruang kosong yang cukup agar informasi lebih mudah dipindai.</span></article>
                            <article class="stat-card"><strong>Nuansa Layanan</strong><span>Bahasa visual dibuat dekat dengan portal kota digital seperti JAKI, namun tetap ringan.</span></article>
                        </div>
                    </div>

                    <div class="cta-card">
                        <div>
                            <h3>Mulai bangun komunikasi warga yang lebih cepat dan transparan.</h3>
                            <p>Gunakan LaporAja! untuk menghubungkan laporan warga dengan proses tindak lanjut yang lebih tertata. Tampilan baru ini menonjolkan rasa percaya, kemudahan, dan aksesibilitas di semua perangkat.</p>
                        </div>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('login') }}" class="btn-outline-soft"><i class="fas fa-user-check"></i>Saya Sudah Punya Akun</a>
                            <a href="{{ route('register') }}" class="btn-main"><i class="fas fa-arrow-up-right-from-square"></i>Daftar dan Mulai</a>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="footer">
            <div class="container container-xl">
                <div class="footer-box">
                    <div class="footer-note">
                        <div class="brand-mark"><i class="fas fa-bullhorn"></i></div>
                        <div>
                            <div>LaporAja!</div>
                            <small class="text-secondary">Sistem Pengaduan dan Aspirasi Warga</small>
                        </div>
                    </div>
                    <div>Portal layanan warga yang responsif, modern, dan mudah dipahami.</div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
