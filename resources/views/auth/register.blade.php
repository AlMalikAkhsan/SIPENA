<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - LaporAja!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            position: relative;
            padding: 2rem 0;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }

        .register-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 500px;
            padding: 0 20px;
            margin: 0 auto;
        }

        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            border: none;
        }

        .register-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2.5rem 2rem;
            text-align: center;
            color: white;
        }

        .register-logo {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            backdrop-filter: blur(10px);
        }

        .register-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0 0 0.5rem;
        }

        .register-subtitle {
            font-size: 0.95rem;
            opacity: 0.95;
            margin: 0;
        }

        .register-body {
            padding: 2.5rem 2rem;
        }

        .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-control.is-invalid {
            border-color: #ef4444;
        }

        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 0.85rem;
            font-weight: 600;
            font-size: 1rem;
            color: white;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #718096;
        }

        .login-link a {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #764ba2;
        }

        .alert {
            border: none;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .alert-danger {
            background: #fee;
            color: #c53030;
        }

        .alert-danger ul {
            margin: 0;
            padding-left: 1.25rem;
        }

        .alert-danger li {
            margin: 0.25rem 0;
        }

        .back-home {
            position: absolute;
            top: 2rem;
            left: 2rem;
            z-index: 2;
        }

        .btn-back {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            padding: 0.5rem 1.25rem;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            transform: translateX(-5px);
        }

        .password-requirements {
            background: #f7fafc;
            border-radius: 10px;
            padding: 1rem;
            margin-top: 1rem;
            font-size: 0.875rem;
            color: #4a5568;
        }

        .password-requirements ul {
            margin: 0;
            padding-left: 1.25rem;
        }

        .password-requirements li {
            margin: 0.25rem 0;
        }

        @media (max-width: 576px) {
            body {
                padding: 1rem 0;
            }

            .register-body {
                padding: 2rem 1.5rem;
            }

            .register-header {
                padding: 2rem 1.5rem;
            }

            .back-home {
                top: 1rem;
                left: 1rem;
            }
        }
    </style>
</head>
<body>

    <a href="/" class="back-home btn-back">
        <svg width="20" height="20" fill="currentColor">
            <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
        </svg>
        Kembali
    </a>

    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <div class="register-logo">
                    <svg width="35" height="35" fill="white">
                        <path d="M17.5 2L2 9v13c0 7.33 5.06 14.19 12 16 6.94-1.81 12-8.67 12-16V9L17.5 2zm0 14.99h9.5c-.73 5.44-4.31 10.28-9.5 11.8V16H7V11h10.5V2.99c5.19 1.52 8.77 6.36 9.5 11.8H17.5v2.2z"/>
                    </svg>
                </div>
                <h1 class="register-title">Buat Akun Baru</h1>
                <p class="register-subtitle">Daftar untuk menggunakan LaporAja!</p>
            </div>

            <div class="register-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>
                            <svg width="16" height="16" fill="currentColor" style="vertical-align: text-bottom;" class="me-1">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                            </svg>
                            Terjadi kesalahan:
                        </strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="/register">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" 
                               name="name" 
                               class="form-control @error('name') is-invalid @enderror" 
                               placeholder="Masukkan nama lengkap" 
                               value="{{ old('name') }}" 
                               required 
                               autofocus>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" 
                               name="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               placeholder="nama@email.com" 
                               value="{{ old('email') }}" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" 
                               name="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               placeholder="Minimal 8 karakter" 
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" 
                               name="password_confirmation" 
                               class="form-control" 
                               placeholder="Ketik ulang password" 
                               required>
                    </div>

                    <div class="password-requirements">
                        <strong class="d-block mb-2">Password harus memenuhi:</strong>
                        <ul>
                            <li>Minimal 8 karakter</li>
                            <li>Kombinasi huruf dan angka lebih baik</li>
                        </ul>
                    </div>

                    <button type="submit" class="btn btn-register mt-4">
                        <svg width="18" height="18" fill="currentColor" style="vertical-align: text-bottom;" class="me-2">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                        Daftar Sekarang
                    </button>
                </form>

                <div class="login-link">
                    Sudah punya akun? <a href="/login">Masuk di sini</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>