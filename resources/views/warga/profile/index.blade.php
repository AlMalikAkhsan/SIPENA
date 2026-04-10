@extends('layouts.user')

@section('title', 'Profil Saya - Sipena')

@section('content')
@php $user = auth()->user(); @endphp

<section class="page-intro">
    <div>
        <span class="page-kicker">Profil warga</span>
        <h1 class="page-title">Semua identitas akun ditata lebih ringkas dan mudah dibaca.</h1>
        <p class="page-subtitle">Halaman profil dirancang ulang seperti kartu profil aplikasi layanan publik, dengan pemisahan info pribadi, kontak, dan akses cepat edit.</p>
    </div>
    <div class="intro-actions">
        <a href="{{ route('warga.profile.edit') }}" class="button"><i class="fas fa-pen"></i><span>Edit profil</span></a>
    </div>
</section>

<section class="grid-two">
    <div class="detail-card">
        <div class="mini-author mb-4">
            <div class="avatar-badge" style="width: 84px; height: 84px; border-radius: 26px;">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}">
                @else
                    {{ strtoupper(substr($user->name ?? 'W', 0, 1)) }}
                @endif
            </div>
            <div>
                <h2 class="panel-title mb-2" style="font-size: 1.5rem;">{{ $user->name }}</h2>
                <div class="chip-row">
                    <span class="chip soft"><i class="fas fa-envelope"></i>{{ $user->email }}</span>
                    <span class="chip soft"><i class="fas fa-user-shield"></i>{{ ucfirst($user->role ?? 'warga') }}</span>
                </div>
            </div>
        </div>

        <div class="info-list">
            <div class="info-item"><span class="helper-text">Username</span><strong>{{ $user->username ?: '-' }}</strong></div>
            <div class="info-item"><span class="helper-text">NIK</span><strong>{{ $user->nik ?: '-' }}</strong></div>
            <div class="info-item"><span class="helper-text">Tanggal lahir</span><strong>{{ $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('d M Y') : '-' }}</strong></div>
            <div class="info-item"><span class="helper-text">Jenis kelamin</span><strong>{{ $user->gender ?: '-' }}</strong></div>
        </div>
    </div>

    <div class="timeline-card">
        <div class="panel-header">
            <div>
                <h2 class="panel-title">Kontak dan wilayah</h2>
                <p class="panel-subtitle">Info yang membantu pengurus menindaklanjuti laporan dan saran.</p>
            </div>
        </div>
        <div class="info-list">
            <div class="info-item"><span class="helper-text">No. HP</span><strong>{{ $user->no_hp ?: '-' }}</strong></div>
            <div class="info-item"><span class="helper-text">Alamat</span><strong>{{ $user->alamat ?: '-' }}</strong></div>
            <div class="info-item"><span class="helper-text">RT / RW</span><strong>{{ ($user->rt ?: '-') . ' / ' . ($user->rw ?: '-') }}</strong></div>
            <div class="info-item"><span class="helper-text">Verifikasi email</span><strong>{{ $user->email_verified_at ? 'Sudah terverifikasi' : 'Belum terverifikasi' }}</strong></div>
        </div>
    </div>
</section>
@endsection
