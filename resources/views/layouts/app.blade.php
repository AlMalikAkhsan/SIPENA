<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIPENA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background: #f6f7fb;
        }
        .sidebar {
            min-height: 100vh;
            background: #ffffff;
            border-right: 1px solid #ddd;
        }
        .nav-link.active {
            background: #0d6efd;
            color: #fff !important;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold text-primary" href="#">SIPENA</a>

        <div class="d-flex align-items-center">
            <span class="me-3">{{ auth()->user()->name }}</span>
            <form action="/logout" method="POST">
                @csrf
                <button class="btn btn-outline-danger btn-sm">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-3">
            @if(auth()->user()->role == 'warga')
                <a href="/warga/dashboard" class="nav-link mb-2">🏠 Dashboard</a>
                <a href="{{ route('warga.laporan.index') }}" class="nav-link mb-2">📝 Laporan Saya</a>
            @endif

            @if(auth()->user()->role == 'admin')
                <a href="/admin/dashboard" class="nav-link mb-2">🏠 Dashboard</a>
                <a href="{{ route('admin.laporan.index') }}" class="nav-link mb-2">📂 Semua Laporan</a>
            @endif
        </div>

        <!-- Content -->
        <div class="col-md-10 p-4">
            @yield('content')
        </div>
    </div>
</div>

</body>
</html>
