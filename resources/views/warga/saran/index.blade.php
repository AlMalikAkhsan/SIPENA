@extends('layouts.user')

@section('title', 'Saran Warga - Sipena')

@section('content')
@php $saranItems = collect($saran->items()); @endphp
<section class="page-intro">
    <div>
        <span class="page-kicker">Saran warga</span>
        <h1 class="page-title">Kelola ide dan usulan yang Anda kirim ke pengurus.</h1>
        <p class="page-subtitle">Tampilan saran dibuat lebih modern agar user mudah melihat status usulan, tanggapan admin, dan aksi edit yang masih tersedia.</p>
    </div>
    <div class="intro-actions">
        <a href="{{ route('warga.saran.create') }}" class="button"><i class="fas fa-plus"></i><span>Buat saran</span></a>
    </div>
</section>

<section class="stats-grid">
    <article class="stat-card"><div class="stat-icon"><i class="fas fa-lightbulb"></i></div><div class="stat-value">{{ $saran->total() }}</div><div class="stat-label">Total saran</div></article>
    <article class="stat-card"><div class="stat-icon" style="background: rgba(245, 158, 11, 0.12); color: #b45309;"><i class="fas fa-hourglass-half"></i></div><div class="stat-value">{{ $saranItems->where('status', 'menunggu')->count() }}</div><div class="stat-label">Menunggu</div></article>
    <article class="stat-card"><div class="stat-icon"><i class="fas fa-envelope-open-text"></i></div><div class="stat-value">{{ $saranItems->where('status', 'ditinjau')->count() + $saranItems->where('status', 'dibaca')->count() }}</div><div class="stat-label">Ditinjau</div></article>
    <article class="stat-card"><div class="stat-icon" style="background: rgba(22, 163, 74, 0.12); color: #15803d;"><i class="fas fa-circle-check"></i></div><div class="stat-value">{{ $saranItems->where('status', 'diterapkan')->count() }}</div><div class="stat-label">Diterapkan</div></article>
</section>

@if($saran->count())
    <section class="report-grid">
        @foreach($saran as $item)
            <article class="report-card">
                <div class="report-body">
                    <div class="meta-row">
                        <span class="status-pill status-{{ $item->status }}">{{ ucfirst($item->status) }}</span>
                        <span class="meta-text">{{ $item->created_at->diffForHumans() }}</span>
                    </div>
                    <h3 class="report-title">{{ $item->judul }}</h3>
                    <p class="report-copy">{{ \Illuminate\Support\Str::limit($item->isi, 130) }}</p>
                    @if($item->tanggapan_admin)
                        <div class="chip soft"><i class="fas fa-reply"></i>{{ \Illuminate\Support\Str::limit($item->tanggapan_admin, 70) }}</div>
                    @endif
                    <div class="card-actions">
                        <a href="{{ route('warga.saran.show', $item->id) }}" class="button-light">Detail</a>
                        @if(!$item->tanggapan_admin)
                            <a href="{{ route('warga.saran.edit', $item->id) }}" class="button-ghost">Edit</a>
                            <form action="{{ route('warga.saran.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus saran ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button-danger">Hapus</button>
                            </form>
                        @endif
                    </div>
                </div>
            </article>
        @endforeach
    </section>

    @if($saran->hasPages())
        <section class="panel">
            {{ $saran->appends(request()->query())->links('pagination::bootstrap-5') }}
        </section>
    @endif
@else
    <section class="empty-state">
        <div class="empty-icon"><i class="fas fa-lightbulb"></i></div>
        <h2 class="panel-title">Belum ada saran</h2>
        <p class="empty-copy">Kalau ada ide untuk lingkungan, kirim dari sini agar pengurus bisa meninjau dan menindaklanjuti.</p>
        <div class="button-row justify-content-center">
            <a href="{{ route('warga.saran.create') }}" class="button">Buat saran pertama</a>
        </div>
    </section>
@endif
@endsection
