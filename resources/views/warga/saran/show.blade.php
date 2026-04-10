@extends('layouts.user')

@section('title', 'Detail Saran - Sipena')

@section('content')
<section class="page-intro">
    <div>
        <span class="page-kicker">Detail saran</span>
        <h1 class="page-title">{{ $saran->judul }}</h1>
        <p class="page-subtitle">Lihat isi saran, status peninjauan, dan tanggapan pengurus dalam satu tampilan yang lebih rapi.</p>
        <div class="chip-row mt-3">
            <span class="status-pill status-{{ $saran->status }}">{{ ucfirst($saran->status) }}</span>
            <span class="chip soft"><i class="fas fa-calendar"></i>{{ $saran->created_at->format('d M Y H:i') }}</span>
        </div>
    </div>
    <div class="intro-actions">
        <a href="{{ route('warga.saran.index') }}" class="button-light"><i class="fas fa-arrow-left"></i><span>Kembali</span></a>
        @if(!$saran->tanggapan_admin)
            <a href="{{ route('warga.saran.edit', $saran->id) }}" class="button"><i class="fas fa-pen"></i><span>Edit</span></a>
        @endif
    </div>
</section>

<section class="grid-two">
    <div class="detail-card">
        <div class="panel-header">
            <div>
                <h2 class="panel-title">Isi saran</h2>
                <p class="panel-subtitle">Usulan lengkap yang Anda kirim.</p>
            </div>
        </div>
        <p class="report-copy" style="font-size: 1rem; white-space: pre-line;">{{ $saran->isi }}</p>

        @if($saran->tanggapan_admin)
            <div class="flash success mt-4">
                <i class="fas fa-reply mt-1"></i>
                <div>
                    <strong>Tanggapan admin</strong>
                    <div class="mt-2" style="white-space: pre-line;">{{ $saran->tanggapan_admin }}</div>
                    @if($saran->tanggapan_at)
                        <div class="meta-text mt-2">{{ $saran->tanggapan_at->format('d M Y H:i') }}</div>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <div class="timeline-card">
        <div class="panel-header">
            <div>
                <h2 class="panel-title">Status saran</h2>
                <p class="panel-subtitle">Ringkasan progres dan aksi yang masih tersedia.</p>
            </div>
        </div>
        <div class="info-list">
            <div class="info-item"><span class="helper-text">Status</span><span class="status-pill status-{{ $saran->status }}">{{ ucfirst($saran->status) }}</span></div>
            <div class="info-item"><span class="helper-text">Dikirim pada</span><strong>{{ $saran->created_at->format('d M Y H:i') }}</strong></div>
            <div class="info-item"><span class="helper-text">Update terakhir</span><strong>{{ $saran->updated_at->format('d M Y H:i') }}</strong></div>
        </div>

        <div class="button-row mt-4">
            @if(!$saran->tanggapan_admin)
                <a href="{{ route('warga.saran.edit', $saran->id) }}" class="button"><i class="fas fa-pen"></i><span>Edit saran</span></a>
                <form action="{{ route('warga.saran.destroy', $saran->id) }}" method="POST" onsubmit="return confirm('Hapus saran ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button-danger">Hapus</button>
                </form>
            @else
                <span class="chip soft"><i class="fas fa-lock"></i>Saran terkunci karena sudah ditanggapi</span>
            @endif
        </div>
    </div>
</section>
@endsection
