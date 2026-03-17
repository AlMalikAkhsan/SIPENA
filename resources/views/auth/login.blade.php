<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LaporAja!</title>
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

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .login-card {
            width: 100%;
            max-width: 460px;
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow-soft);
            border: 1px solid rgba(129, 212, 250, 0.15);
        }

        .login-header {
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

        .login-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            font-size: 1rem;
            opacity: 0.9;
        }

        .login-body {
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

        .btn-login {
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

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(79, 195, 247, 0.4);
        }

        .btn-google {
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            padding: 0.85rem;
            font-weight: 600;
            color: #333;
            transition: all 0.3s ease;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .btn-google:hover {
            background: #f8fafc;
            border-color: var(--primary-soft);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 2rem 0;
            color: var(--text-muted);
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #d1d5db;
        }

        .divider span {
            padding: 0 1.5rem;
            font-size: 0.9rem;
        }

        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .register-link a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .register-link a:hover {
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

        @media (max-width: 576px) {
            .login-body { padding: 2rem 1.5rem; }
            .login-header { padding: 2.5rem 1.5rem 1.5rem; }
            .back-home { top: 1rem; left: 1rem; }
        }
    </style>
</head>
<body>

    <a href="/" class="back-home btn-back">
        <i class="fas fa-home"></i> Beranda
    </a>

    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-circle">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <h1 class="login-title">Selamat Datang</h1>
                <p class="login-subtitle">Masuk ke akun LaporAja! Anda</p>
            </div>

            <div class="login-body">

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

                <!-- Pesan Sukses -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-check-circle me-2"></i> Berhasil!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-floating mb-4">
                        <input type="email" name="email" class="form-control" id="email" placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                        <label for="email">Email</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label small" for="remember">Ingat saya</label>
                        </div>
                        <a href="#" class="small text-primary text-decoration-none">Lupa password?</a>
                    </div>

                    <button type="submit" class="btn btn-login mb-4">
                        <i class="fas fa-sign-in-alt me-2"></i> Masuk
                    </button>

                    <div class="divider">
                        <span>atau masuk dengan</span>
                    </div>

                    <a href="/auth/google" class="btn btn-google">
                        <img src="https://www.google.com/favicon.ico" alt="Google" width="20" height="20">
                        Google
                    </a>

                    <div class="register-link mt-4">
                        Belum punya akun? 
                        <a href="register" class="fw-semibold">Daftar sekarang</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>