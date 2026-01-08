<!DOCTYPE html>
<html>
<head>
    <title>Detail Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h3>Detail Laporan</h3>

    <div class="card">
        <div class="card-body">
            <h5>{{ $laporan->judul }}</h5>
            <p>{{ $laporan->isi }}</p>

            <p>Status:
                <span class="badge bg-secondary">{{ $laporan->status }}</span>
            </p>

            <hr>
            <h5>Tanggapan Admin</h5>
             @if($laporan->tanggapan)
                <div class="alert alert-info">
                    {{ $laporan->tanggapan->isi_tanggapan }}
                </div>
            @else
                <p class="text-muted">Belum ada tanggapan.</p>
            @endif


            @if($laporan->foto)
                <img src="{{ asset('uploads/'.$laporan->foto) }}" width="300">
            @endif
        </div>
    </div>

    <a href="{{ route('warga.laporan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>

</body>
</html>
