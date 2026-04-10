@extends('layouts.user')

@section('title', 'Detail Laporan Warga - Sipena')

@section('content')
@php
    $photos = $laporan->fotos;
    $backUrl = route('warga.laporan.semua');
    $returnUrl = request()->query('return');

    if (is_string($returnUrl) && $returnUrl !== '') {
        if (\Illuminate\Support\Str::startsWith($returnUrl, url('/'))) {
            $backUrl = $returnUrl;
        } elseif (\Illuminate\Support\Str::startsWith($returnUrl, '/')) {
            $backUrl = url($returnUrl);
        }
    }
@endphp

<section class="page-intro">
    <div>
        <span class="page-kicker">Laporan warga</span>
        <h1 class="page-title">{{ $laporan->judul }}</h1>
        <p class="page-subtitle">Detail laporan publik yang dibagikan warga. Halaman ini dibuat seperti feed eksplorasi agar mudah dipantau pengguna lain.</p>
        <div class="chip-row mt-3">
            <span class="status-pill status-{{ $laporan->status }}">{{ ucfirst($laporan->status) }}</span>
            <span class="chip soft"><i class="fas fa-user"></i>{{ $laporan->user->name ?? 'Warga' }}</span>
            <span class="chip soft"><i class="fas fa-calendar"></i>{{ $laporan->created_at->format('d M Y H:i') }}</span>
        </div>
    </div>
    <div class="intro-actions">
        <a href="{{ $backUrl }}" class="button-light"><i class="fas fa-arrow-left"></i><span>Kembali ke jelajah</span></a>
    </div>
</section>

<section class="detail-grid">
    <div>
        <div class="gallery-photo">
            <div class="hero-photo">
                @if($photos->count())
                    <img src="{{ asset('storage/' . $photos->first()->foto_path) }}" alt="{{ $laporan->judul }}" id="mainPhoto">
                @else
                    <div class="placeholder" style="height: 360px;"><i class="fas fa-image"></i></div>
                @endif
            </div>
        </div>

        @if($photos->count() > 1)
            <div class="photo-strip mt-3">
                @foreach($photos as $index => $foto)
                    <div class="photo-thumb {{ $index === 0 ? 'active' : '' }}" onclick="changePhoto('{{ asset('storage/' . $foto->foto_path) }}', this)">
                        <img src="{{ asset('storage/' . $foto->foto_path) }}" alt="Foto {{ $index + 1 }}">
                    </div>
                @endforeach
            </div>
        @endif

        <section class="detail-card mt-4">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Deskripsi laporan</h2>
                    <p class="panel-subtitle">Ringkasan kejadian yang dibagikan warga.</p>
                </div>
            </div>
            <p class="report-copy" style="font-size: 1rem; white-space: pre-line;">{{ $laporan->isi }}</p>
        </section>
    </div>

    <div class="timeline-card">
        <div class="panel-header">
            <div>
                <h2 class="panel-title">Info cepat</h2>
                <p class="panel-subtitle">Informasi inti dari laporan publik ini.</p>
            </div>
        </div>
        <div class="info-list">
            <div class="info-item"><span class="helper-text">Pelapor</span><strong>{{ $laporan->user->name ?? 'Warga' }}</strong></div>
            <div class="info-item"><span class="helper-text">Lokasi</span><strong>{{ $laporan->lokasi ?: 'Belum dicantumkan' }}</strong></div>
            <div class="info-item"><span class="helper-text">Status</span><span class="status-pill status-{{ $laporan->status }}">{{ ucfirst($laporan->status) }}</span></div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    function changePhoto(src, element) {
        const mainPhoto = document.getElementById('mainPhoto');
        if (mainPhoto) mainPhoto.src = src;
        document.querySelectorAll('.photo-thumb').forEach((thumb) => thumb.classList.remove('active'));
        element.classList.add('active');
    }
</script>
@endpush
