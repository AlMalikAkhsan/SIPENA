@extends('layouts.user')

@section('title', 'Jelajah Laporan Warga - Sipena')

@section('content')
@php
    $statusMap = [
        'menunggu' => 'Menunggu',
        'diproses' => 'Diproses',
        'selesai' => 'Selesai',
        'ditolak' => 'Ditolak',
    ];
@endphp

<section class="page-intro">
    <div>
        <span class="page-kicker">Jelajah laporan</span>
        <h1 class="page-title">Lihat laporan warga lain dengan tampilan feed yang lebih informatif.</h1>
        <p class="page-subtitle">Halaman publik warga sekarang tampil seperti feed eksplorasi: ada filter, status, identitas pelapor, dan akses detail yang lebih rapi.</p>
    </div>
    <div class="intro-actions">
        <a href="{{ route('warga.laporan.index') }}" class="button-light"><i class="fas fa-file-lines"></i><span>Laporan saya</span></a>
    </div>
</section>

<section class="panel">
    <div class="panel-header">
        <div>
            <h2 class="panel-title">Filter jelajah</h2>
            <p class="panel-subtitle">Cari isu berdasarkan kata kunci, status, dan urutan waktu.</p>
        </div>
    </div>
    <form method="GET" action="{{ route('warga.laporan.semua') }}" class="filter-grid">
        <div class="field-group">
            <label class="field-label">Pencarian</label>
            <input type="text" name="search" class="field-input" value="{{ request('search') }}" placeholder="Cari judul atau isi laporan">
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
        <div class="field-group">
            <label class="field-label">Urutkan</label>
            <select name="sort" class="field-select">
                <option value="terbaru" @selected(request('sort', 'terbaru') === 'terbaru')>Terbaru</option>
                <option value="terlama" @selected(request('sort') === 'terlama')>Terlama</option>
            </select>
        </div>
        <div class="field-group" style="align-self: end;">
            <div class="button-row">
                <button type="submit" class="button">Terapkan</button>
                @if(request()->filled('search') || request()->filled('status') || request()->filled('sort'))
                    <a href="{{ route('warga.laporan.semua') }}" class="button-light">Reset</a>
                @endif
            </div>
        </div>
    </form>
    @if(request()->filled('search') || request()->filled('status') || request()->filled('sort'))
        <div class="chip-row mt-4">
            @if(request('search'))
                <span class="chip soft"><i class="fas fa-magnifying-glass"></i>{{ request('search') }}</span>
            @endif
            @if(request('status'))
                <span class="chip soft"><i class="fas fa-filter"></i>{{ ucfirst(request('status')) }}</span>
            @endif
            @if(request('sort'))
                <span class="chip soft"><i class="fas fa-arrow-down-wide-short"></i>{{ ucfirst(request('sort')) }}</span>
            @endif
        </div>
    @endif
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
                        <span class="status-pill status-{{ $item->status }}">{{ $statusMap[$item->status] ?? ucfirst($item->status) }}</span>
                        <span class="meta-text">{{ $item->created_at->diffForHumans() }}</span>
                    </div>
                    <h3 class="report-title">{{ $item->judul }}</h3>
                    <p class="report-copy">{{ \Illuminate\Support\Str::limit($item->isi, 120) }}</p>
                    <div class="mini-author">
                        <div class="mini-avatar">{{ strtoupper(substr($item->user->name ?? 'W', 0, 1)) }}</div>
                        <div>
                            <strong>{{ $item->user->name ?? 'Warga' }}</strong>
                            <div class="meta-text">{{ $item->lokasi ?: 'Lokasi belum diisi' }}</div>
                        </div>
                    </div>
                    <div class="card-actions">
                        <a href="{{ route('warga.laporan.detail_umum', ['id' => $item->id, 'return' => url()->full()]) }}" class="button-light">Lihat detail</a>
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
        <div class="empty-icon"><i class="fas fa-compass"></i></div>
        <h2 class="panel-title">Belum ada laporan yang cocok</h2>
        <p class="empty-copy">Coba ubah kata kunci atau reset filter untuk melihat lebih banyak laporan warga.</p>
        <div class="button-row justify-content-center">
            <a href="{{ route('warga.laporan.semua') }}" class="button-light">Reset filter</a>
            <a href="{{ route('warga.laporan.create') }}" class="button">Buat laporan</a>
        </div>
    </section>
@endif
@endsection
