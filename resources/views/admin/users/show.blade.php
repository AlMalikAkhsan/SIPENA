@extends('layouts.app')

@section('content')
<div class="admin-page">
    <section class="admin-header">
        <div>
            <h1>Profil User #{{ $user->id }}</h1>
            <p class="admin-subtitle">Detail data pengguna dan status akun.</p>
        </div>
        <div class="admin-actions">
            <a href="{{ route('admin.users.index') }}" class="admin-btn admin-btn-ghost">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
            <a href="{{ route('admin.users.edit', $user->id) }}" class="admin-btn admin-btn-primary">
                <i class="fas fa-pen"></i>
                Edit
            </a>
            @if(auth()->id() !== $user->id)
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="admin-btn admin-btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                </form>
            @endif
        </div>
    </section>

    <section class="panel">
        <h2 class="panel-title">Informasi Akun</h2>
        <div class="info-grid">
            <article class="info-item"><div class="info-label">Nama</div><div class="info-value">{{ $user->name }}</div></article>
            <article class="info-item"><div class="info-label">Email</div><div class="info-value">{{ $user->email }}</div></article>
            <article class="info-item"><div class="info-label">Username</div><div class="info-value">{{ $user->username ?: '-' }}</div></article>
            <article class="info-item"><div class="info-label">Role</div><div class="info-value">{{ ucfirst($user->role) }}</div></article>
            <article class="info-item"><div class="info-label">Verifikasi Email</div><div class="info-value">{{ $user->email_verified_at ? 'Terverifikasi' : 'Belum verifikasi' }}</div></article>
            <article class="info-item"><div class="info-label">Tanggal Daftar</div><div class="info-value">{{ $user->created_at->format('d M Y H:i') }} WIB</div></article>
        </div>
    </section>

    <section class="panel">
        <h2 class="panel-title">Profil Warga</h2>
        <div class="info-grid">
            <article class="info-item"><div class="info-label">NIK</div><div class="info-value">{{ $user->nik ?: '-' }}</div></article>
            <article class="info-item"><div class="info-label">No HP</div><div class="info-value">{{ $user->no_hp ?: '-' }}</div></article>
            <article class="info-item"><div class="info-label">Gender</div><div class="info-value">{{ $user->gender ?: '-' }}</div></article>
            <article class="info-item"><div class="info-label">Tanggal Lahir</div><div class="info-value">{{ $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('d M Y') : '-' }}</div></article>
            <article class="info-item"><div class="info-label">Kota</div><div class="info-value">{{ $user->city ?: '-' }}</div></article>
            <article class="info-item"><div class="info-label">RT / RW</div><div class="info-value">{{ ($user->rt || $user->rw) ? 'RT ' . ($user->rt ?: '-') . ' / RW ' . ($user->rw ?: '-') : '-' }}</div></article>
            <article class="info-item" style="grid-column: 1 / -1;"><div class="info-label">Alamat</div><div class="info-value">{{ $user->alamat ?: '-' }}</div></article>
        </div>
    </section>
</div>
@endsection
