@extends('layouts.app')

@section('content')
<div class="admin-page">
    <section class="admin-header">
        <div>
            <h1>Detail Saran #{{ $saran->id }}</h1>
            <p class="admin-subtitle">Dikirim oleh {{ $saran->user->name ?? 'Anonim' }} pada {{ $saran->created_at->format('d M Y H:i') }} WIB.</p>
        </div>
        <div class="admin-actions">
            <a href="{{ route('admin.saran.index') }}" class="admin-btn admin-btn-ghost">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
            <form action="{{ route('admin.saran.destroy', $saran->id) }}" method="POST" onsubmit="return confirm('Hapus saran ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="admin-btn admin-btn-danger"><i class="fas fa-trash"></i> Hapus</button>
            </form>
        </div>
    </section>

    @if(session('success'))
        <div class="alert-admin success">{{ session('success') }}</div>
    @endif

    <section class="panel">
        <h2 class="panel-title">Informasi Saran</h2>
        <div class="info-grid">
            <article class="info-item">
                <div class="info-label">Judul</div>
                <div class="info-value">{{ $saran->judul }}</div>
            </article>
            <article class="info-item">
                <div class="info-label">Status</div>
                <div class="info-value"><span class="badge-status badge-{{ $saran->status }}">{{ ucfirst($saran->status) }}</span></div>
            </article>
            <article class="info-item">
                <div class="info-label">Pengirim</div>
                <div class="info-value">{{ $saran->user->name ?? 'Anonim' }} ({{ $saran->user->email ?? '-' }})</div>
            </article>
            <article class="info-item">
                <div class="info-label">Waktu Tanggapan</div>
                <div class="info-value">{{ $saran->tanggapan_at ? $saran->tanggapan_at->format('d M Y H:i') . ' WIB' : '-' }}</div>
            </article>
            <article class="info-item" style="grid-column: 1 / -1;">
                <div class="info-label">Isi Saran</div>
                <div class="info-value">{{ $saran->isi }}</div>
            </article>
            @if($saran->tanggapan_admin)
                <article class="info-item" style="grid-column: 1 / -1;">
                    <div class="info-label">Tanggapan Admin Saat Ini</div>
                    <div class="info-value">{{ $saran->tanggapan_admin }}</div>
                </article>
            @endif
        </div>
    </section>

    <section class="panel-grid">
        <article class="panel">
            <h2 class="panel-title">Ubah Status</h2>
            <form action="{{ route('admin.saran.status', $saran->id) }}" method="POST" class="admin-page">
                @csrf
                <select name="status" class="admin-select">
                    @foreach(['menunggu', 'dibaca', 'ditinjau', 'diterapkan', 'ditolak'] as $status)
                        <option value="{{ $status }}" @selected($saran->status === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
                <div class="admin-form-actions">
                    <button type="submit" class="admin-btn admin-btn-primary">Simpan Status</button>
                </div>
            </form>
        </article>

        <article class="panel">
            <h2 class="panel-title">Kirim Tanggapan</h2>
            <form action="{{ route('admin.saran.tanggapi', $saran->id) }}" method="POST" class="admin-page">
                @csrf
                <select name="status" class="admin-select" required>
                    <option value="">Pilih Status Lanjutan</option>
                    @foreach(['ditinjau', 'diterapkan', 'ditolak'] as $status)
                        <option value="{{ $status }}" @selected(old('status', $saran->status) === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
                <textarea name="tanggapan_admin" class="admin-textarea" placeholder="Tulis tanggapan untuk warga..." required>{{ old('tanggapan_admin', $saran->tanggapan_admin) }}</textarea>
                @error('tanggapan_admin') <small class="text-danger">{{ $message }}</small> @enderror
                <div class="admin-form-actions">
                    <button type="submit" class="admin-btn admin-btn-primary">Kirim Tanggapan</button>
                </div>
            </form>
        </article>
    </section>
</div>
@endsection
