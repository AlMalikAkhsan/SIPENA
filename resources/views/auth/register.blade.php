<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - SiPena</title>
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
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at top left, rgba(20, 184, 166, 0.14), transparent 24%),
                radial-gradient(circle at 92% 10%, rgba(15, 108, 189, 0.18), transparent 30%),
                linear-gradient(180deg, #eef7ff 0%, #f8fbff 50%, #ffffff 100%);
        }

        .register-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: minmax(330px, 0.95fr) minmax(340px, 0.9fr);
        }

        .register-side, .register-panel { padding: 2rem; }
        .register-side, .register-panel { display: flex; align-items: center; }
        .register-panel { justify-content: center; }
        .side-content { max-width: 39rem; }

        .back-link, .badge-top {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            color: var(--brand);
            font-weight: 700;
        }

        .back-link { margin-bottom: 2rem; }

        .badge-top {
            padding: 0.6rem 0.9rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(15, 108, 189, 0.12);
            font-size: 0.9rem;
        }

        h1 {
            margin: 1.2rem 0 1rem;
            font-size: clamp(2.3rem, 4vw, 4.2rem);
            line-height: 1.08;
            letter-spacing: -0.04em;
        }

        h1 span { color: var(--brand); }

        .lead-text, .info-card p, .card-inner > p, .tips-box, .helper-row {
            color: var(--muted);
            line-height: 1.85;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }

        .info-card {
            padding: 1rem 1.05rem;
            background: rgba(255, 255, 255, 0.76);
            border-radius: 1.2rem;
            border: 1px solid rgba(255, 255, 255, 0.86);
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.06);
        }

        .info-card i { color: var(--brand); margin-bottom: 0.7rem; font-size: 1.2rem; }
        .info-card strong { display: block; margin-bottom: 0.35rem; }

        .register-card {
            width: 100%;
            max-width: 33rem;
            padding: 1.2rem;
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
            display: grid;
            place-items: center;
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

        .tips-box {
            margin: 1rem 0 1.35rem;
            padding: 1rem;
            border-radius: 1rem;
            background: #f4f9fe;
            border: 1px solid rgba(15, 108, 189, 0.08);
            font-size: 0.92rem;
        }

        .tips-box strong { display: block; color: var(--ink); margin-bottom: 0.35rem; }

        .btn-main {
            width: 100%;
            height: 3.45rem;
            border: none;
            border-radius: 1rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.7rem;
            color: white;
            background: linear-gradient(135deg, var(--brand), #2b8ad2);
            box-shadow: 0 18px 30px rgba(15, 108, 189, 0.2);
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
            .register-shell { grid-template-columns: 1fr; }
            .register-side { padding-bottom: 0; }
        }

        @media (max-width: 767px) {
            .info-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 575px) {
            .register-side, .register-panel { padding: 1rem; }
            .card-inner { padding: 1.4rem; }
        }
    </style>
</head>
<body>
    <div class="register-shell">
        <section class="register-side">
            <div class="side-content">
                <a href="/" class="back-link"><i class="fas fa-arrow-left"></i>Kembali ke beranda</a>
                <div class="badge-top"><i class="fas fa-user-plus"></i>Pendaftaran warga</div>
                <h1>Buat akun <span>SiPena</span> dan mulai sampaikan aspirasi dengan lebih mudah.</h1>
                <p class="lead-text">Proses daftar dibuat singkat, bersih, dan ramah mobile supaya warga bisa langsung mengakses layanan pengaduan dan saran tanpa hambatan visual yang berlebihan.</p>

                <div class="info-grid">
                    <div class="info-card"><i class="fas fa-envelope-circle-check"></i><strong>Email terverifikasi</strong><p>Gunakan email aktif agar proses verifikasi dan pemberitahuan berjalan lancar.</p></div>
                    <div class="info-card"><i class="fas fa-file-shield"></i><strong>Akun warga otomatis</strong><p>Setelah daftar, akun akan diarahkan untuk verifikasi lalu siap dipakai sebagai warga.</p></div>
                    <div class="info-card"><i class="fas fa-pen-ruler"></i><strong>Form lebih rapi</strong><p>Komponen dirancang minimalis agar fokus tetap pada proses pendaftaran.</p></div>
                    <div class="info-card"><i class="fas fa-mobile-alt"></i><strong>Nyaman di layar kecil</strong><p>Tata letak mengikuti pendekatan responsif agar tetap enak dipakai di ponsel.</p></div>
                </div>
            </div>
        </section>

        <section class="register-panel">
            <div class="register-card">
                <div class="card-inner">
                    <div class="logo-mark"><i class="fas fa-bullhorn"></i></div>
                    <h2>Buat akun baru</h2>
                    <p>Lengkapi data berikut untuk mulai menggunakan portal layanan warga.</p>

                    @if ($errors->any())
                        <div class="alert-custom">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama lengkap</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="nama@email.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Minimal 8 karakter" required>
                        </div>
                        <div class="mb-2">
                            <label for="password_confirmation" class="form-label">Konfirmasi password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                        </div>

                        <div class="tips-box">
                            <strong>Catatan pendaftaran</strong>
                            Setelah akun dibuat, sistem akan mengirim tautan verifikasi ke email Anda sebelum akses warga digunakan sepenuhnya.
                        </div>

                        <button type="submit" class="btn-main"><i class="fas fa-user-check"></i>Daftar Sekarang</button>
                    </form>

                    <div class="helper-row">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
