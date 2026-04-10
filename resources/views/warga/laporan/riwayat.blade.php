@extends('layouts.user')

@section('title', 'Riwayat Laporan - Sipena')

@section('content')
<section class="page-intro">
    <div>
        <span class="page-kicker">Riwayat arsip</span>
        <h1 class="page-title">Laporan selesai yang sudah Anda arsipkan.</h1>
        <p class="page-subtitle">Riwayat kini tampil konsisten dengan halaman warga lain, termasuk info rating feedback, tanggal arsip, dan tombol restore yang lebih jelas.</p>
    </div>
    <div class="intro-actions">
        <a href="{{ route('warga.laporan.index') }}" class="button-light"><i class="fas fa-arrow-left"></i><span>Kembali ke laporan aktif</span></a>
    </div>
</section>

@if($laporan->count())
    <section class="timeline-card">
        <div class="panel-header">
            <div>
                <h2 class="panel-title">Daftar arsip</h2>
                <p class="panel-subtitle">{{ $laporan->total() }} laporan ada di arsip.</p>
            </div>
        </div>

        <div class="timeline-list">
            @foreach($laporan as $item)
                @php
                    $foto = $item->fotos()->first();
                @endphp
                <div class="timeline-item">
                    <div class="mini-author" style="align-items: flex-start; width: 100%;">
                        <div class="mini-avatar" style="width: 72px; height: 72px; border-radius: 18px; overflow: hidden;">
                            @if($foto)
                                <img src="{{ asset('storage/' . $foto->foto_path) }}" alt="{{ $item->judul }}">
                            @else
                                <i class="fas fa-image"></i>
                            @endif
                        </div>
                        <div style="flex: 1;">
                            <h3 class="report-title mb-2">{{ $item->judul }}</h3>
                            <p class="report-copy mb-2">{{ \Illuminate\Support\Str::limit($item->isi, 120) }}</p>
                            <div class="chip-row">
                                <span class="status-pill status-{{ $item->status }}">{{ ucfirst($item->status) }}</span>
                                <span class="chip soft"><i class="fas fa-box-archive"></i>{{ optional($item->archived_at)->format('d M Y') }}</span>
                                @if($item->feedback)
                                    <span class="chip soft"><i class="fas fa-star"></i>Rating {{ $item->feedback->rating }}/5</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="button-row">
                        <a href="{{ route('warga.laporan.show', ['laporan' => $item->id, 'return' => url()->full()]) }}" class="button-light">Detail</a>
                        <form action="{{ route('warga.laporan.unarchive', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="button"><i class="fas fa-rotate-left"></i><span>Restore</span></button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    @if($laporan->hasPages())
        <section class="panel">
            {{ $laporan->links('pagination::bootstrap-5') }}
        </section>
    @endif
@else
    <section class="empty-state">
        <div class="empty-icon"><i class="fas fa-box-archive"></i></div>
        <h2 class="panel-title">Arsip masih kosong</h2>
        <p class="empty-copy">Laporan yang sudah selesai dan Anda arsipkan akan muncul di halaman ini.</p>
        <div class="button-row justify-content-center">
            <a href="{{ route('warga.laporan.index') }}" class="button">Lihat laporan aktif</a>
        </div>
    </section>
@endif
@endsection
