<!DOCTYPE html>
<html>
<head>
    <title>Edit Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h3>Edit Laporan</h3>

    <form action="{{ route('warga.laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $laporan->judul }}" required>
        </div>

        <div class="mb-3">
            <label>Isi Laporan</label>
            <textarea name="isi" class="form-control" rows="4" required>{{ $laporan->isi }}</textarea>
        </div>

        <div class="mb-3">
            <label>Foto (Opsional)</label>
            <input type="file" name="foto" class="form-control">
            @if($laporan->foto)
                <img src="{{ asset('uploads/'.$laporan->foto) }}" width="150" class="mt-2">
            @endif
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('warga.laporan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</body>
</html>
