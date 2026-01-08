<!DOCTYPE html>
<html>
<head>
    <title>Buat Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h3>Buat Laporan</h3>

    <form action="{{ route('warga.laporan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Isi Laporan</label>
            <textarea name="isi" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label>Foto (Opsional)</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button class="btn btn-primary">Kirim Laporan</button>
        <a href="{{ route('warga.laporan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</body>
</html>
