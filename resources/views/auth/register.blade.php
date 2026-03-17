<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - LaporAja!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary: #4fc3f7;
            --primary-dark: #0288d1;
            --primary-soft: #81d4fa;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --card-bg: rgba(255, 255, 255, 0.92);
            --shadow-soft: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #81d4fa 0%, #4fc3f7 100%);
            font-family: 'Segoe UI', system-ui, sans-serif;
            color: var(--text-dark);
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.12'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.18;
            pointer-events: none;
        }

        .register-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .register-card {
            width: 100%;
            max-width: 500px;
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow-soft);
            border: 1px solid rgba(129, 212, 250, 0.15);
        }

        .register-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 3rem 2rem 2rem;
            text-align: center;
            color: white;
            position: relative;
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            backdrop-filter: blur(8px);
            border: 2px solid rgba(255, 255, 255, 0.4);
        }

        .logo-circle i {
            font-size: 2.5rem;
        }

        .register-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .register-subtitle {
            font-size: 1rem;
            opacity: 0.9;
        }

        .register-body {
            padding: 2.5rem 2rem 2rem;
        }

        .form-floating > label {
            color: var(--text-muted);
        }

        .form-control {
            border-radius: 12px;
            border: 1px solid #d1d5db;
            padding: 1rem 1.25rem;
            height: calc(3.5rem + 2px);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(79, 195, 247, 0.15);
        }

        .form-control.is-invalid {
            border-color: #ef4444;
        }

        .btn-register {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: none;
            border-radius: 12px;
            padding: 0.85rem;
            font-weight: 600;
            font-size: 1.05rem;
            color: white;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(79, 195, 247, 0.4);
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .login-link a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .back-home {
            position: absolute;
            top: 2rem;
            left: 2rem;
            z-index: 10;
        }

        .btn-back {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            padding: 0.6rem 1.5rem;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateX(-4px);
        }

        .password-requirements {
            background: rgba(129, 212, 250, 0.1);
            border-radius: 12px;
            padding: 1rem;
            margin-top: 1rem;
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .password-requirements ul {
            margin: 0;
            padding-left: 1.25rem;
        }

        .password-requirements li {
            margin: 0.25rem 0;
        }

        @media (max-width: 576px) {
            body { padding: 1rem 0; }
            .register-body { padding: 2rem 1.5rem; }
            .register-header { padding: 2.5rem 1.5rem 1.5rem; }
            .back-home { top: 1rem; left: 1rem; }
        }
    </style>
</head>
<body>

    <a href="/" class="back-home btn-back">
        <i class="fas fa-home"></i> Beranda
    </a>

    <div class="register-wrapper">
        <div class="register-card">
            <div class="register-header">
                <div class="logo-circle">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <h1 class="register-title">Buat Akun Baru</h1>
                <p class="register-subtitle">Daftar untuk mulai melaporkan dan memberi saran</p>
            </div>

            <div class="register-body">

                <!-- Pesan Error -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-circle me-2"></i> Ada kesalahan:</strong>
                        <ul class="mb-0 mt-2 ps-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="/register">
                    @csrf

                    <div class="form-floating mb-4">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required autofocus>
                        <label for="name">Nama Lengkap</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="nama@email.com" value="{{ old('email') }}" required>
                        <label for="email">Email</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Konfirmasi Password" required>
                        <label for="password_confirmation">Konfirmasi Password</label>
                    </div>

                    <div class="password-requirements">
                        <strong class="d-block mb-2">Password harus memenuhi:</strong>
                        <ul>
                            <li>Minimal 8 karakter</li>
                            <li>Mengandung huruf besar & kecil (disarankan)</li>
                            <li>Mengandung angka atau simbol (disarankan)</li>
                        </ul>
                    </div>

                    <button type="submit" class="btn btn-register mt-4">
                        <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
                    </button>
                </form>

                <div class="login-link mt-4">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="fw-semibold">Masuk di sini</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>