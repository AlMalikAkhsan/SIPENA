@extends('layouts.user')

@section('title', 'Beranda Warga - Sipena')

@section('content')
@php
    $feedItems = collect($laporan->items())->take(5);
    $statusMap = [
        'menunggu' => ['icon' => 'fa-regular fa-clock', 'label' => 'Menunggu'],
        'diproses' => ['icon' => 'fa-solid fa-spinner', 'label' => 'Diproses'],
        'selesai' => ['icon' => 'fa-solid fa-circle-check', 'label' => 'Selesai'],
        'ditolak' => ['icon' => 'fa-solid fa-circle-xmark', 'label' => 'Ditolak'],
    ];
@endphp

<section class="page-intro primary">
    <div>
        <span class="page-kicker">Layanan warga yang lebih modern</span>
        <h1 class="page-title">Halo, {{ auth()->user()->name }}. Semua kebutuhan warga sekarang lebih cepat dipantau.</h1>
        <p class="page-subtitle">Tampilan warga disusun ulang agar terasa seperti aplikasi layanan kota: ringkas, visual, dan fokus ke aksi utama seperti bikin laporan, cek progres, dan kirim saran.</p>
        <div class="intro-actions mt-4">
            <a href="{{ route('warga.laporan.create') }}" class="button-light"><i class="fas fa-plus"></i><span>Buat Laporan Baru</span></a>
            <a href="{{ route('warga.saran.create') }}" class="button-ghost"><i class="fas fa-lightbulb"></i><span>Kirim Saran</span></a>
        </div>
    </div>
    <div class="chip-row">
        <span class="chip"><i class="fas fa-wave-square"></i> Ringkasan real-time</span>
        <span class="chip"><i class="fas fa-mobile-screen"></i> Mobile friendly</span>
        <span class="chip"><i class="fas fa-shield-heart"></i> Mudah dipahami warga</span>
    </div>
</section>

<section class="stats-grid">
    <article class="stat-card">
        <div class="stat-icon"><i class="fas fa-file-circle-plus"></i></div>
        <div class="stat-value">{{ $total }}</div>
        <div class="stat-label">Total laporan saya</div>
    </article>
    <article class="stat-card">
        <div class="stat-icon" style="background: rgba(245, 158, 11, 0.12); color: #b45309;"><i class="fas fa-hourglass-half"></i></div>
        <div class="stat-value">{{ $menunggu }}</div>
        <div class="stat-label">Menunggu review</div>
    </article>
    <article class="stat-card">
        <div class="stat-icon"><i class="fas fa-gears"></i></div>
        <div class="stat-value">{{ $diproses }}</div>
        <div class="stat-label">Sedang diproses</div>
    </article>
    <article class="stat-card">
        <div class="stat-icon" style="background: rgba(22, 163, 74, 0.12); color: #15803d;"><i class="fas fa-badge-check"></i></div>
        <div class="stat-value">{{ $selesai }}</div>
        <div class="stat-label">Sudah selesai</div>
    </article>
    <article class="stat-card">
        <div class="stat-icon" style="background: rgba(239, 68, 68, 0.12); color: #b91c1c;"><i class="fas fa-triangle-exclamation"></i></div>
        <div class="stat-value">{{ $ditolak }}</div>
        <div class="stat-label">Perlu diperbaiki</div>
    </article>
</section>

<section class="grid-two">
    <div class="panel">
        <div class="panel-header">
            <div>
                <h2 class="panel-title">Laporan terbaru</h2>
                <p class="panel-subtitle">Tiga laporan paling baru dari akun Anda.</p>
            </div>
            <a href="{{ route('warga.laporan.index') }}" class="button-light">Lihat semua</a>
        </div>

        @if($latest->count())
            <div class="report-grid">
                @foreach($latest as $item)
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
                            <p class="report-copy">{{ \Illuminate\Support\Str::limit($item->isi, 110) }}</p>
                            <div class="card-actions">
                                <a href="{{ route('warga.laporan.show', $item->id) }}" class="button-light">Detail</a>
                                @if($item->status === 'menunggu')
                                    <a href="{{ route('warga.laporan.edit', $item->id) }}" class="button-ghost">Edit</a>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon"><i class="fas fa-file-circle-plus"></i></div>
                <h3 class="panel-title">Belum ada laporan</h3>
                <p class="empty-copy">Mulai dari laporan pertama agar pengurus bisa melihat kebutuhan warga lebih cepat.</p>
                <div class="button-row justify-content-center">
                    <a href="{{ route('warga.laporan.create') }}" class="button">Buat laporan</a>
                </div>
            </div>
        @endif
    </div>

    <div class="panel">
        <div class="panel-header">
            <div>
                <h2 class="panel-title">Aksi cepat</h2>
                <p class="panel-subtitle">Shortcut utama yang paling sering dipakai warga.</p>
            </div>
        </div>
        <div class="grid-three">
            <a href="{{ route('warga.laporan.create') }}" class="summary-card">
                <span class="chip soft"><i class="fas fa-plus"></i> Lapor cepat</span>
                <h3 class="report-title mt-3 mb-2">Buat laporan baru</h3>
                <p class="report-copy">Kirim foto, lokasi, dan detail kejadian dalam satu alur yang lebih rapi.</p>
            </a>
            <a href="{{ route('warga.laporan.semua') }}" class="summary-card">
                <span class="chip soft"><i class="fas fa-compass"></i> Pantau sekitar</span>
                <h3 class="report-title mt-3 mb-2">Lihat laporan warga</h3>
                <p class="report-copy">Jelajahi laporan publik untuk tahu isu yang sedang ramai di lingkungan.</p>
            </a>
            <a href="{{ route('warga.saran.index') }}" class="summary-card">
                <span class="chip soft"><i class="fas fa-lightbulb"></i> Ide warga</span>
                <h3 class="report-title mt-3 mb-2">Kelola saran</h3>
                <p class="report-copy">Pantau usulan, ide, dan tanggapan admin dari satu tempat.</p>
            </a>
        </div>
    </div>
</section>

<section class="panel">
    <div class="panel-header">
        <div>
            <h2 class="panel-title">Feed laporan saya</h2>
            <p class="panel-subtitle">Ringkasan aktivitas laporan terbaru pada dashboard.</p>
        </div>
    </div>

    @if($feedItems->count())
        <div class="timeline-list">
            @foreach($feedItems as $item)
                <div class="timeline-item">
                    <div>
                        <div class="meta-row mb-2">
                            <span class="status-pill status-{{ $item->status }}">
                                <i class="{{ $statusMap[$item->status]['icon'] ?? 'fa-solid fa-circle' }}"></i>
                                {{ $statusMap[$item->status]['label'] ?? ucfirst($item->status) }}
                            </span>
                            <span class="meta-text">{{ $item->created_at->format('d M Y H:i') }}</span>
                        </div>
                        <h3 class="report-title mb-2">{{ $item->judul }}</h3>
                        <p class="report-copy mb-0">{{ \Illuminate\Support\Str::limit($item->isi, 150) }}</p>
                    </div>
                    <div class="button-row">
                        <a href="{{ route('warga.laporan.show', $item->id) }}" class="button-light">Detail</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-inbox"></i></div>
            <h3 class="panel-title">Belum ada aktivitas</h3>
            <p class="empty-copy">Begitu Anda mengirim laporan, progresnya akan muncul di sini.</p>
        </div>
    @endif
</section>
@endsection
