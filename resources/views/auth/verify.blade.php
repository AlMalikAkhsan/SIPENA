<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - LaporAja!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary: #4fc3f7;
            --primary-dark: #0288d1;
        }
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #81d4fa 0%, #4fc3f7 100%);
            font-family: 'Segoe UI', system-ui, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .verify-card {
            max-width: 480px;
            width: 100%;
            background: rgba(255,255,255,0.93);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }
        .verify-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 3rem 2rem 2rem;
            text-align: center;
            color: white;
        }
        .icon-circle {
            width: 80px; height: 80px;
            background: rgba(255,255,255,0.25);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.5rem;
            border: 2px solid rgba(255,255,255,0.4);
        }
        .btn-verify {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: none; border-radius: 12px;
            padding: 0.85rem 2rem;
            font-weight: 600; color: white;
            transition: all 0.3s ease;
        }
        .btn-verify:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(79,195,247,0.4);
            color: white;
        }
    </style>
</head>
<body>
    <div class="verify-card">
        <div class="verify-header">
            <div class="icon-circle">
                <i class="fas fa-envelope-open-text fa-2x"></i>
            </div>
            <h2 class="fw-700 mb-2">Verifikasi Email Kamu</h2>
            <p class="mb-0 opacity-90">Satu langkah lagi sebelum mulai!</p>
        </div>

        <div class="p-4 p-md-5">
            @if (session('message'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>{{ session('message') }}
                </div>
            @endif

            <p class="text-muted mb-4">
                Kami telah mengirim link verifikasi ke email <strong>{{ auth()->user()->email }}</strong>.
                Cek inbox atau folder <em>spam</em> kamu, lalu klik link tersebut untuk mengaktifkan akun.
            </p>

            <div class="d-grid mb-3">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-verify w-100">
                        <i class="fas fa-paper-plane me-2"></i> Kirim Ulang Email Verifikasi
                    </button>
                </form>
            </div>

            <div class="text-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link text-muted text-decoration-none">
                        <i class="fas fa-sign-out-alt me-1"></i> Keluar dan gunakan akun lain
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>