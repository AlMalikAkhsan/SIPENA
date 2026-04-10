@extends('layouts.user')

@section('title', 'Detail Laporan - Sipena')

@section('content')
@php
    $statusCopy = [
        'menunggu' => 'Laporan sedang menunggu verifikasi awal dari admin.',
        'diproses' => 'Laporan sudah masuk tahap tindak lanjut dan sedang dikerjakan.',
        'selesai' => 'Laporan telah selesai ditangani.',
        'ditolak' => 'Laporan belum dapat diproses. Silakan lihat tanggapan atau perbaikan yang dibutuhkan.',
    ];
    $photos = $laporan->fotos;
    $backUrl = route('warga.laporan.index');
    $returnUrl = request()->query('return');

    if (is_string($returnUrl) && $returnUrl !== '') {
        if (\Illuminate\Support\Str::startsWith($returnUrl, url('/'))) {
            $backUrl = $returnUrl;
        } elseif (\Illuminate\Support\Str::startsWith($returnUrl, '/')) {
            $backUrl = url($returnUrl);
        }
    } else {
        $previousUrl = url()->previous();
        if ($previousUrl !== url()->current()) {
            $backUrl = $previousUrl;
        }
    }
@endphp

<section class="page-intro">
    <div>
        <span class="page-kicker">Detail laporan</span>
        <h1 class="page-title">{{ $laporan->judul }}</h1>
        <p class="page-subtitle">{{ $statusCopy[$laporan->status] ?? 'Pantau progres laporan Anda dari halaman ini.' }}</p>
        <div class="chip-row mt-3">
            <span class="status-pill status-{{ $laporan->status }}"><i class="fas fa-circle"></i>{{ ucfirst($laporan->status) }}</span>
            <span class="chip soft"><i class="fas fa-calendar"></i>{{ $laporan->created_at->format('d M Y H:i') }}</span>
            <span class="chip soft"><i class="fas fa-hashtag"></i>ID #{{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</span>
        </div>
    </div>
    <div class="intro-actions">
        <a href="{{ $backUrl }}" class="button-light"><i class="fas fa-arrow-left"></i><span>Kembali</span></a>
        @if($laporan->status === 'menunggu')
            <a href="{{ route('warga.laporan.edit', ['laporan' => $laporan->id, 'return' => $backUrl]) }}" class="button"><i class="fas fa-pen"></i><span>Edit</span></a>
        @endif
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
                    <h2 class="panel-title">Informasi laporan</h2>
                    <p class="panel-subtitle">Keterangan utama yang dikirim saat membuat laporan.</p>
                </div>
            </div>
            <div class="info-list">
                <div class="info-item"><span class="helper-text">Lokasi</span><strong>{{ $laporan->lokasi ?: 'Belum dicantumkan' }}</strong></div>
                <div class="info-item"><span class="helper-text">Deskripsi</span><strong style="max-width: 70%; text-align: right;">{{ $laporan->isi }}</strong></div>
            </div>
        </section>

        @if($laporan->response)
            <section class="detail-card mt-4">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Tanggapan admin</h2>
                        <p class="panel-subtitle">Balasan terbaru dari pengurus untuk laporan ini.</p>
                    </div>
                </div>
                <p class="report-copy mb-3" style="font-size: 1rem; white-space: pre-line;">{{ $laporan->response }}</p>
                @if($laporan->responded_at)
                    <span class="chip soft"><i class="fas fa-clock"></i>{{ $laporan->responded_at->format('d M Y H:i') }}</span>
                @endif
            </section>
        @endif
    </div>

    <div class="timeline-card">
        <div class="panel-header">
            <div>
                <h2 class="panel-title">Ringkasan progres</h2>
                <p class="panel-subtitle">Status, waktu, dan aksi yang masih tersedia.</p>
            </div>
        </div>
        <div class="info-list">
            <div class="info-item"><span class="helper-text">Status</span><span class="status-pill status-{{ $laporan->status }}">{{ ucfirst($laporan->status) }}</span></div>
            <div class="info-item"><span class="helper-text">Terakhir diperbarui</span><strong>{{ $laporan->updated_at->format('d M Y H:i') }}</strong></div>
            <div class="info-item"><span class="helper-text">Jumlah foto</span><strong>{{ $photos->count() }} foto</strong></div>
        </div>

        <div class="button-row mt-4">
            @if($laporan->status === 'menunggu')
                <a href="{{ route('warga.laporan.edit', ['laporan' => $laporan->id, 'return' => $backUrl]) }}" class="button"><i class="fas fa-pen"></i><span>Edit laporan</span></a>
                <form action="{{ route('warga.laporan.destroy', $laporan->id) }}" method="POST" onsubmit="return confirm('Hapus laporan ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button-danger">Hapus</button>
                </form>
            @elseif($laporan->status === 'selesai' && !$laporan->isArchived())
                <form action="{{ route('warga.laporan.archive', $laporan->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="button"><i class="fas fa-box-archive"></i><span>Arsipkan laporan</span></button>
                </form>
            @endif
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    function changePhoto(src, element) {
        const mainPhoto = document.getElementById('mainPhoto');
        if (mainPhoto) {
            mainPhoto.src = src;
        }
        document.querySelectorAll('.photo-thumb').forEach((thumb) => thumb.classList.remove('active'));
        element.classList.add('active');
    }
</script>
@endpush
