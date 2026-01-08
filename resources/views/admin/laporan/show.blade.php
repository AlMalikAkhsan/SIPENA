<!DOCTYPE html>
<html>
<head>
    <title>Detail Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h3>Detail Laporan</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $laporan->user->name }}</p>
            <p><strong>Judul:</strong> {{ $laporan->judul }}</p>
            <p><strong>Isi:</strong> {{ $laporan->isi }}</p>
            <p><strong>Status:</strong> {{ $laporan->status }}</p>

            @if($laporan->foto)
                <img src="{{ asset('uploads/'.$laporan->foto) }}" width="300">
            @endif
        </div>
    </div>

    <form action="{{ route('admin.laporan.status', $laporan->id) }}" method="POST" class="mb-3">
        @csrf
        <label>Ubah Status</label>
        <select name="status" class="form-control w-25">
            <option value="menunggu">Menunggu</option>
            <option value="diproses">Diproses</option>
            <option value="selesai">Selesai</option>
        </select>
        <button class="btn btn-primary mt-2">Update Status</button>
    </form>

    <hr>

    <h5>Tanggapan Admin</h5>

    @if($tanggapan)
        <div class="alert alert-info">
            {{ $tanggapan->isi_tanggapan }}
        </div>
    @else
        <form action="{{ route('admin.laporan.tanggapan', $laporan->id) }}" method="POST">
            @csrf
            <textarea name="isi_tanggapan" class="form-control" rows="3" required></textarea>
            <button class="btn btn-success mt-2">Kirim Tanggapan</button>
        </form>
    @endif

    <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>

</body>
</html>
