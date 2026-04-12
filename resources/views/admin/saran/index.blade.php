@extends('layouts.app')

@section('content')
<div class="admin-page">
    <section class="admin-header">
        <div>
            <h1>Data Saran</h1>
            <p class="admin-subtitle">Pantau masukan warga dan berikan tindak lanjut.</p>
        </div>
    </section>

    <section class="stat-grid">
        <article class="stat-card"><span class="stat-label">Total</span><span class="stat-value">{{ $total }}</span></article>
        <article class="stat-card"><span class="stat-label">Menunggu</span><span class="stat-value">{{ $menunggu }}</span></article>
        <article class="stat-card"><span class="stat-label">Dibaca</span><span class="stat-value">{{ $dibaca }}</span></article>
        <article class="stat-card"><span class="stat-label">Ditinjau</span><span class="stat-value">{{ $ditinjau }}</span></article>
        <article class="stat-card"><span class="stat-label">Diterapkan</span><span class="stat-value">{{ $diterapkan }}</span></article>
        <article class="stat-card"><span class="stat-label">Ditolak</span><span class="stat-value">{{ $ditolak }}</span></article>
    </section>

    <section class="panel">
        <h2 class="panel-title">Filter Saran</h2>
        <form method="GET" class="admin-form-grid">
            <input type="text" class="admin-field" name="search" value="{{ request('search') }}" placeholder="Cari judul, isi, pengirim...">
            <select class="admin-select" name="status">
                <option value="">Semua Status</option>
                @foreach(['menunggu', 'dibaca', 'ditinjau', 'diterapkan', 'ditolak'] as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
            <select class="admin-select" name="sort">
                <option value="terbaru" @selected(request('sort', 'terbaru') === 'terbaru')>Terbaru</option>
                <option value="terlama" @selected(request('sort') === 'terlama')>Terlama</option>
            </select>
            <div class="admin-form-actions">
                <button type="submit" class="admin-btn admin-btn-primary"><i class="fas fa-search"></i> Terapkan</button>
                <a href="{{ route('admin.saran.index') }}" class="admin-btn admin-btn-ghost">Reset</a>
            </div>
        </form>
    </section>

    <section class="panel">
        <h2 class="panel-title">Daftar Saran</h2>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Pengirim</th>
                        <th>Status</th>
                        <th>Tanggapan Admin</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($saran as $item)
                        <tr>
                            <td>#{{ $item->id }}</td>
                            <td>
                                <strong>{{ $item->judul }}</strong>
                                <div class="admin-subtitle">{{ \Illuminate\Support\Str::limit($item->isi, 90) }}</div>
                            </td>
                            <td>{{ $item->user->name ?? 'Anonim' }}</td>
                            <td><span class="badge-status badge-{{ $item->status }}">{{ ucfirst($item->status) }}</span></td>
                            <td>{{ $item->tanggapan_admin ? \Illuminate\Support\Str::limit($item->tanggapan_admin, 70) : '-' }}</td>
                            <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <div class="admin-actions">
                                    <a href="{{ route('admin.saran.show', $item->id) }}" class="admin-btn admin-btn-ghost">Detail</a>
                                    <form action="{{ route('admin.saran.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus saran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="admin-btn admin-btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">Belum ada data saran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrap mt-3">{{ $saran->links() }}</div>
    </section>
</div>
@endsection
