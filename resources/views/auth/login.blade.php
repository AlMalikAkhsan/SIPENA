<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SiPena</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root {
            --brand: #0f6cbd;
            --ink: #0f172a;
            --muted: #62748d;
            --line: rgba(148, 163, 184, 0.22);
            --brand-soft: #e5f2ff;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 0% 0%, rgba(20, 184, 166, 0.14), transparent 26%),
                radial-gradient(circle at 100% 10%, rgba(15, 108, 189, 0.18), transparent 28%),
                linear-gradient(180deg, #edf6ff 0%, #f8fbff 45%, #ffffff 100%);
        }

        .auth-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: minmax(320px, 0.95fr) minmax(340px, 0.85fr);
        }

        .auth-side, .auth-panel { padding: 2rem; }
        .auth-side, .auth-panel { display: flex; align-items: center; }
        .auth-panel { justify-content: center; }
        .side-card { max-width: 38rem; }

        .back-link, .badge-top {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            font-weight: 700;
        }

        .back-link { color: var(--brand); margin-bottom: 2rem; }

        .badge-top {
            padding: 0.6rem 0.9rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(15, 108, 189, 0.12);
            color: var(--brand);
            font-size: 0.9rem;
        }

        h1 {
            margin: 1.2rem 0 1rem;
            font-size: clamp(2.3rem, 4vw, 4.2rem);
            line-height: 1.08;
            letter-spacing: -0.04em;
        }

        h1 span { color: var(--brand); }

        .lead-text, .feature-item p, .card-inner > p, .helper-row {
            color: var(--muted);
            line-height: 1.85;
        }

        .feature-stack {
            display: grid;
            gap: 1rem;
            margin-top: 2rem;
        }

        .feature-item {
            display: flex;
            gap: 1rem;
            align-items: flex-start;
            padding: 1rem 1.1rem;
            background: rgba(255, 255, 255, 0.74);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 1.2rem;
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.06);
        }

        .feature-icon, .logo-mark {
            display: grid;
            place-items: center;
            color: var(--brand);
            background: var(--brand-soft);
        }

        .feature-icon {
            width: 2.9rem;
            height: 2.9rem;
            border-radius: 0.95rem;
            flex-shrink: 0;
        }

        .feature-item strong { display: block; margin-bottom: 0.35rem; font-size: 1rem; }

        .auth-card {
            width: 100%;
            max-width: 31rem;
            padding: 1.25rem;
            border-radius: 2rem;
            background: rgba(255, 255, 255, 0.86);
            border: 1px solid rgba(255, 255, 255, 0.85);
            box-shadow: 0 24px 70px rgba(15, 23, 42, 0.09);
            backdrop-filter: blur(18px);
        }

        .card-inner {
            border-radius: 1.55rem;
            background: #ffffff;
            border: 1px solid rgba(148, 163, 184, 0.14);
            padding: 2rem;
        }

        .logo-mark {
            width: 3.2rem;
            height: 3.2rem;
            border-radius: 1rem;
            margin-bottom: 1rem;
            color: white;
            background: linear-gradient(135deg, var(--brand), #39a0e4);
        }

        .card-inner h2 {
            margin-bottom: 0.55rem;
            font-size: 1.7rem;
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        .form-label { font-size: 0.92rem; font-weight: 700; margin-bottom: 0.55rem; }

        .form-control {
            height: 3.35rem;
            border-radius: 1rem;
            border: 1px solid var(--line);
            padding: 0.9rem 1rem;
            box-shadow: none;
        }

        .form-control:focus {
            border-color: rgba(15, 108, 189, 0.45);
            box-shadow: 0 0 0 0.25rem rgba(15, 108, 189, 0.08);
        }

        .btn-main, .btn-google {
            width: 100%;
            height: 3.45rem;
            border-radius: 1rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.7rem;
            transition: 0.25s ease;
        }

        .btn-main {
            border: none;
            color: white;
            background: linear-gradient(135deg, var(--brand), #2b8ad2);
            box-shadow: 0 18px 30px rgba(15, 108, 189, 0.2);
        }

        .btn-google {
            background: #fff;
            color: var(--ink);
            border: 1px solid var(--line);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--muted);
            font-size: 0.9rem;
            margin: 1.2rem 0;
        }

        .divider::before, .divider::after {
            content: "";
            height: 1px;
            flex: 1;
            background: var(--line);
        }

        .alert-custom {
            margin-bottom: 1rem;
            padding: 0.95rem 1rem;
            border-radius: 1rem;
            border: 1px solid #fecdd3;
            background: #fff1f2;
            color: #be123c;
            font-size: 0.92rem;
        }

        .helper-row { margin-top: 1.25rem; text-align: center; font-size: 0.94rem; }
        .helper-row a { color: var(--brand); font-weight: 700; }

        @media (max-width: 991px) {
            .auth-shell { grid-template-columns: 1fr; }
            .auth-side { padding-bottom: 0; }
        }

        @media (max-width: 575px) {
            .auth-side, .auth-panel { padding: 1rem; }
            .card-inner { padding: 1.4rem; }
        }
    </style>
</head>
<body>
    <div class="auth-shell">
        <section class="auth-side">
            <div class="side-card">
                <a href="/" class="back-link"><i class="fas fa-arrow-left"></i>Kembali ke beranda</a>
                <div class="badge-top"><i class="fas fa-city"></i>Akses layanan warga</div>
                <h1>Masuk ke <span>SiPena</span> untuk memantau laporan dengan lebih rapi.</h1>
                <p class="lead-text">Tampilan dibuat lebih modern dan nyaman di ponsel agar warga bisa mengakses pengaduan, saran, dan progres penanganan tanpa kebingungan.</p>

                <div class="feature-stack">
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fas fa-bolt"></i></div>
                        <div><strong>Akses cepat</strong><p>Masuk dengan email aktif dan lanjutkan aktivitas layanan warga dari perangkat apa pun.</p></div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fas fa-list-check"></i></div>
                        <div><strong>Status mudah dipahami</strong><p>Riwayat dan progres laporan tampil lebih jelas sehingga tindak lanjut lebih mudah diikuti.</p></div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fas fa-mobile-screen-button"></i></div>
                        <div><strong>Responsif di mobile</strong><p>Komponen penting tetap nyaman dipakai di layar kecil seperti pengalaman aplikasi layanan modern.</p></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="auth-panel">
            <div class="auth-card">
                <div class="card-inner">
                    <div class="logo-mark"><i class="fas fa-bullhorn"></i></div>
                    <h2>Masuk ke akun Anda</h2>
                    <p>Gunakan akun terdaftar untuk membuka dashboard warga atau admin.</p>

                    @if ($errors->any())
                        <div class="alert-custom">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    @if (session('message'))
                        <div class="alert alert-success rounded-4 border-0 mb-3">{{ session('message') }}</div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
                        </div>
                        <button type="submit" class="btn-main"><i class="fas fa-arrow-right-to-bracket"></i>Masuk</button>
                    </form>

                    <div class="divider">atau</div>
                    <a href="{{ route('google.redirect') }}" class="btn-google"><i class="fab fa-google"></i>Lanjutkan dengan Google</a>
                    <div class="helper-row">Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
