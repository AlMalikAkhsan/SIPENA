@extends('layouts.user')

@section('title', 'Laporan Saya - Sipena')

@section('content')
@php
    $statusMap = [
        'menunggu' => ['icon' => 'fa-regular fa-clock', 'label' => 'Menunggu'],
        'diproses' => ['icon' => 'fa-solid fa-spinner', 'label' => 'Diproses'],
        'selesai' => ['icon' => 'fa-solid fa-circle-check', 'label' => 'Selesai'],
        'ditolak' => ['icon' => 'fa-solid fa-circle-xmark', 'label' => 'Ditolak'],
    ];
@endphp

<section class="page-intro">
    <div>
        <span class="page-kicker">Laporan saya</span>
        <h1 class="page-title">Pantau semua laporan yang pernah Anda kirim.</h1>
        <p class="page-subtitle">Filter, status, dan aksi utama sekarang dibuat lebih rapi agar user bisa memahami progres laporannya dengan cepat seperti pola aplikasi JAKI.</p>
    </div>
    <div class="intro-actions">
        <a href="{{ route('warga.laporan.create') }}" class="button"><i class="fas fa-plus"></i><span>Laporan baru</span></a>
        <a href="{{ route('warga.laporan.riwayat') }}" class="button-light"><i class="fas fa-box-archive"></i><span>Riwayat arsip</span></a>
    </div>
</section>

<section class="stats-grid">
    <article class="stat-card"><div class="stat-icon"><i class="fas fa-file-lines"></i></div><div class="stat-value">{{ $stats['total'] }}</div><div class="stat-label">Total laporan</div></article>
    <article class="stat-card"><div class="stat-icon" style="background: rgba(245, 158, 11, 0.12); color: #b45309;"><i class="fas fa-hourglass-half"></i></div><div class="stat-value">{{ $stats['menunggu'] }}</div><div class="stat-label">Menunggu</div></article>
    <article class="stat-card"><div class="stat-icon"><i class="fas fa-gears"></i></div><div class="stat-value">{{ $stats['diproses'] }}</div><div class="stat-label">Diproses</div></article>
    <article class="stat-card"><div class="stat-icon" style="background: rgba(22, 163, 74, 0.12); color: #15803d;"><i class="fas fa-circle-check"></i></div><div class="stat-value">{{ $stats['selesai'] }}</div><div class="stat-label">Selesai</div></article>
    <article class="stat-card"><div class="stat-icon" style="background: rgba(239, 68, 68, 0.12); color: #b91c1c;"><i class="fas fa-circle-xmark"></i></div><div class="stat-value">{{ $stats['ditolak'] }}</div><div class="stat-label">Ditolak</div></article>
</section>

<section class="panel">
    <div class="panel-header">
        <div>
            <h2 class="panel-title">Cari laporan</h2>
            <p class="panel-subtitle">Gunakan kata kunci atau status untuk mempersempit daftar laporan.</p>
        </div>
    </div>

    <form method="GET" action="{{ route('warga.laporan.index') }}" class="filter-grid">
        <div class="field-group">
            <label class="field-label">Cari judul atau isi</label>
            <input type="text" name="search" class="field-input" value="{{ request('search') }}" placeholder="Mis. lampu jalan, saluran air, sampah">
        </div>
        <div class="field-group">
            <label class="field-label">Status</label>
            <select name="status" class="field-select">
                <option value="">Semua status</option>
                @foreach(['menunggu', 'diproses', 'selesai', 'ditolak'] as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>
        <div class="field-group" style="align-self: end;">
            <div class="button-row">
                <button type="submit" class="button"><i class="fas fa-magnifying-glass"></i><span>Terapkan</span></button>
                @if(request()->filled('search') || request()->filled('status'))
                    <a href="{{ route('warga.laporan.index') }}" class="button-light">Reset</a>
                @endif
            </div>
        </div>
    </form>
</section>

@if($laporan->count())
    <section class="report-grid">
        @foreach($laporan as $item)
            <article class="report-card">
                <div class="report-thumb">
                    @if($item->fotos->count())
                        <img src="{{ asset('storage/' . $item->fotos->first()->foto_path) }}" alt="{{ $item->judul }}">
                    @else
                        <div class="placeholder"><i class="fas fa-image"></i></div>
                    @endif
                </div>
                <div class="report-body">
                    <div class="meta-row">
                        <span class="status-pill status-{{ $item->status }}">
                            <i class="{{ $statusMap[$item->status]['icon'] ?? 'fa-solid fa-circle' }}"></i>
                            {{ $statusMap[$item->status]['label'] ?? ucfirst($item->status) }}
                        </span>
                        <span class="meta-text">{{ $item->created_at->diffForHumans() }}</span>
                    </div>

                    <h3 class="report-title">{{ $item->judul }}</h3>
                    <p class="report-copy">{{ \Illuminate\Support\Str::limit($item->isi, 130) }}</p>

                    <div class="info-list">
                        <div class="info-item">
                            <span class="helper-text">Lokasi</span>
                            <strong>{{ $item->lokasi ?: 'Belum dicantumkan' }}</strong>
                        </div>
                        <div class="info-item">
                            <span class="helper-text">Dibuat</span>
                            <strong>{{ $item->created_at->format('d M Y H:i') }}</strong>
                        </div>
                    </div>

                    <div class="card-actions">
                        <a href="{{ route('warga.laporan.show', ['laporan' => $item->id, 'return' => url()->full()]) }}" class="button-light">Detail</a>
                        @if($item->status === 'menunggu')
                            <a href="{{ route('warga.laporan.edit', $item->id) }}" class="button-ghost">Edit</a>
                            <form action="{{ route('warga.laporan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus laporan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button-danger">Hapus</button>
                            </form>
                        @elseif($item->status === 'selesai' && !$item->isArchived())
                            <form action="{{ route('warga.laporan.archive', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="button-ghost"><i class="fas fa-box-archive"></i><span>Arsipkan</span></button>
                            </form>
                        @endif
                    </div>
                </div>
            </article>
        @endforeach
    </section>

    @if($laporan->hasPages())
        <section class="panel">
            {{ $laporan->appends(request()->query())->links('pagination::bootstrap-5') }}
        </section>
    @endif
@else
    <section class="empty-state">
        <div class="empty-icon"><i class="fas fa-folder-open"></i></div>
        <h2 class="panel-title">Belum ada laporan yang cocok</h2>
        <p class="empty-copy">Kalau filter aktif, coba reset. Kalau belum pernah melapor, kirim laporan pertama Anda sekarang.</p>
        <div class="button-row justify-content-center">
            @if(request()->filled('search') || request()->filled('status'))
                <a href="{{ route('warga.laporan.index') }}" class="button-light">Reset filter</a>
            @endif
            <a href="{{ route('warga.laporan.create') }}" class="button">Buat laporan</a>
        </div>
    </section>
@endif
@endsection
