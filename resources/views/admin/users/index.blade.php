@extends('layouts.app')

@section('content')
@php
    $stats = [
        'total' => \App\Models\User::count(),
        'admin' => \App\Models\User::where('role', 'admin')->count(),
        'warga' => \App\Models\User::where('role', 'warga')->count(),
        'verified' => \App\Models\User::whereNotNull('email_verified_at')->count(),
    ];
@endphp

<div class="admin-page">
    <section class="admin-header">
        <div>
            <h1>Manajemen User</h1>
            <p class="admin-subtitle">Kelola akun admin dan warga dalam satu panel.</p>
        </div>
    </section>

    <section class="stat-grid">
        <article class="stat-card"><span class="stat-label">Total User</span><span class="stat-value">{{ $stats['total'] }}</span></article>
        <article class="stat-card"><span class="stat-label">Admin</span><span class="stat-value">{{ $stats['admin'] }}</span></article>
        <article class="stat-card"><span class="stat-label">Warga</span><span class="stat-value">{{ $stats['warga'] }}</span></article>
        <article class="stat-card"><span class="stat-label">Terverifikasi</span><span class="stat-value">{{ $stats['verified'] }}</span></article>
    </section>

    <section class="panel">
        <h2 class="panel-title">Filter User</h2>
        <form method="GET" class="admin-form-grid">
            <input type="text" class="admin-field" name="search" value="{{ request('search') }}" placeholder="Cari nama, email, username, NIK, no hp">
            <select name="role" class="admin-select">
                <option value="">Semua Role</option>
                <option value="admin" @selected(request('role') === 'admin')>Admin</option>
                <option value="warga" @selected(request('role') === 'warga')>Warga</option>
            </select>
            <div class="admin-form-actions">
                <button type="submit" class="admin-btn admin-btn-primary"><i class="fas fa-search"></i> Terapkan</button>
                <a href="{{ route('admin.users.index') }}" class="admin-btn admin-btn-ghost">Reset</a>
            </div>
        </form>
    </section>

    <section class="panel">
        <h2 class="panel-title">Daftar User</h2>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Verifikasi</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>#{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username ?? '-' }}</td>
                            <td>{{ $user->email }}</td>
                            <td><span class="badge-status badge-{{ $user->role === 'admin' ? 'ditinjau' : 'dibaca' }}">{{ ucfirst($user->role) }}</span></td>
                            <td>
                                @if($user->email_verified_at)
                                    <span class="badge-status badge-diterapkan">Terverifikasi</span>
                                @else
                                    <span class="badge-status badge-menunggu">Belum</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="admin-actions">
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="admin-btn admin-btn-ghost">Detail</a>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="admin-btn admin-btn-primary">Edit</a>
                                    @if(auth()->id() !== $user->id)
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="admin-btn admin-btn-danger">Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">Belum ada data user.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrap mt-3">{{ $users->withQueryString()->links() }}</div>
    </section>
</div>
@endsection
