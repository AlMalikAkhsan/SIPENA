@extends('layouts.app')

@section('content')
@php
    $photoPaths = collect();

    if ($laporan->relationLoaded('fotos') && $laporan->fotos->count()) {
        $photoPaths = $photoPaths->merge($laporan->fotos->pluck('foto_path'));
    }

    $fotoValue = $laporan->foto;
    if (!is_array($fotoValue) && is_string($fotoValue)) {
        $decoded = json_decode($fotoValue, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            $fotoValue = $decoded;
        } elseif (trim($fotoValue) !== '') {
            $fotoValue = [$fotoValue];
        } else {
            $fotoValue = [];
        }
    }

    if (is_array($fotoValue)) {
        $photoPaths = $photoPaths->merge($fotoValue);
    }

    $photos = $photoPaths
        ->map(function ($item) {
            if (is_array($item)) {
                $item = $item['foto_path'] ?? $item['path'] ?? $item['url'] ?? null;
            }
            if (!$item || !is_string($item)) {
                return null;
            }

            $path = trim($item);
            if ($path === '') {
                return null;
            }

            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                return $path;
            }

            $path = ltrim($path, '/');
            if (str_starts_with($path, 'public/')) {
                $path = substr($path, 7);
            }
            if (str_starts_with($path, 'storage/')) {
                $path = substr($path, 8);
            }

            return asset('storage/' . $path);
        })
        ->filter()
        ->unique()
        ->values();
@endphp

<div class="admin-page">
    <section class="admin-header">
        <div>
            <h1>Detail Laporan #{{ $laporan->id }}</h1>
            <p class="admin-subtitle">Dikirim oleh {{ $laporan->user->name ?? 'Anonim' }} pada {{ $laporan->created_at->format('d M Y H:i') }} WIB.</p>
        </div>
        <div class="admin-actions">
            <a href="{{ route('admin.laporan.index') }}" class="admin-btn admin-btn-ghost">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
            <form action="{{ route('admin.laporan.destroy', $laporan->id) }}" method="POST" onsubmit="return confirm('Hapus laporan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="admin-btn admin-btn-danger"><i class="fas fa-trash"></i> Hapus</button>
            </form>
        </div>
    </section>

    @if(session('success'))
        <div class="alert-admin success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-admin error">{{ session('error') }}</div>
    @endif

    <section class="panel">
        <h2 class="panel-title">Informasi Laporan</h2>
        <div class="info-grid">
            <article class="info-item">
                <div class="info-label">Judul</div>
                <div class="info-value">{{ $laporan->judul }}</div>
            </article>
            <article class="info-item">
                <div class="info-label">Status</div>
                <div class="info-value"><span class="badge-status badge-{{ $laporan->status }}">{{ ucfirst($laporan->status) }}</span></div>
            </article>
            <article class="info-item">
                <div class="info-label">Pelapor</div>
                <div class="info-value">{{ $laporan->user->name ?? 'Anonim' }} ({{ $laporan->user->email ?? '-' }})</div>
            </article>
            <article class="info-item">
                <div class="info-label">Lokasi</div>
                <div class="info-value">{{ $laporan->lokasi ?: '-' }}</div>
            </article>
            <article class="info-item" style="grid-column: 1 / -1;">
                <div class="info-label">Isi Laporan</div>
                <div class="info-value">{{ $laporan->isi }}</div>
            </article>
        </div>
    </section>

    <section class="panel">
        <h2 class="panel-title">Foto Laporan</h2>
        @if($photos->count())
            <div class="media-grid">
                @foreach($photos as $photo)
                    <a href="{{ $photo }}" target="_blank" rel="noopener">
                        <img src="{{ $photo }}" alt="Foto laporan {{ $loop->iteration }}">
                    </a>
                @endforeach
            </div>
        @else
            <p class="admin-subtitle">Belum ada foto pada laporan ini.</p>
        @endif
    </section>

    <section class="panel-grid">
        <article class="panel">
            <h2 class="panel-title">Perbarui Status</h2>
            @if($laporan->status !== 'ditolak')
                <form action="{{ route('admin.laporan.status', $laporan->id) }}" method="POST" class="admin-page">
                    @csrf
                    <select name="status" class="admin-select">
                        @foreach(['menunggu', 'diproses', 'selesai'] as $status)
                            <option value="{{ $status }}" @selected($laporan->status === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                    <div class="admin-form-actions">
                        <button type="submit" class="admin-btn admin-btn-primary">Simpan Status</button>
                    </div>
                </form>

                <hr>

                <h3 class="panel-title">Tolak Laporan</h3>
                <form action="{{ route('admin.laporan.reject', $laporan->id) }}" method="POST" class="admin-page">
                    @csrf
                    <textarea name="alasan_penolakan" class="admin-textarea" placeholder="Tulis alasan penolakan (minimal 10 karakter)">{{ old('alasan_penolakan') }}</textarea>
                    @error('alasan_penolakan') <small class="text-danger">{{ $message }}</small> @enderror
                    <div class="admin-form-actions">
                        <button type="submit" class="admin-btn admin-btn-danger">Tolak Laporan</button>
                    </div>
                </form>
            @else
                <div class="alert-admin error">
                    <strong>Laporan ini sudah ditolak.</strong><br>
                    {{ $laporan->alasan_penolakan ?: 'Tidak ada alasan penolakan.' }}
                </div>
            @endif
        </article>

        <article class="panel">
            <h2 class="panel-title">Tanggapan Admin</h2>

            <div class="timeline">
                @forelse($laporan->tanggapans as $tanggapan)
                    <div class="timeline-item">
                        <div class="timeline-meta">
                            {{ $tanggapan->user->name ?? 'Admin' }} · {{ $tanggapan->created_at->format('d M Y H:i') }} WIB
                        </div>
                        <div>{{ $tanggapan->isi }}</div>
                    </div>
                @empty
                    <div class="timeline-item">Belum ada tanggapan.</div>
                @endforelse
            </div>

            @if($laporan->status !== 'ditolak')
                <hr>
                <form action="{{ route('admin.tanggapan.store') }}" method="POST" class="admin-page">
                    @csrf
                    <input type="hidden" name="laporan_id" value="{{ $laporan->id }}">
                    <textarea name="isi" class="admin-textarea" placeholder="Tulis tanggapan untuk warga...">{{ old('isi') }}</textarea>
                    @error('isi') <small class="text-danger">{{ $message }}</small> @enderror
                    <div class="admin-form-actions">
                        <button type="submit" class="admin-btn admin-btn-primary">Kirim Tanggapan</button>
                    </div>
                </form>
            @endif
        </article>
    </section>
</div>
@endsection
