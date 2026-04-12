@extends('layouts.app')

@section('content')
@php
    $statusCounts = [
        'menunggu' => \App\Models\Laporan::where('status', 'menunggu')->count(),
        'diproses' => \App\Models\Laporan::where('status', 'diproses')->count(),
        'selesai' => \App\Models\Laporan::where('status', 'selesai')->count(),
        'ditolak' => \App\Models\Laporan::where('status', 'ditolak')->count(),
    ];
@endphp

<div class="admin-page">
    <section class="admin-header">
        <div>
            <h1>Data Laporan</h1>
            <p class="admin-subtitle">Verifikasi, tindak lanjut, dan monitor semua laporan warga.</p>
        </div>
        <div class="admin-actions">
            <a href="{{ route('admin.laporan.export.pdf', request()->query()) }}" class="admin-btn admin-btn-primary">
                <i class="fas fa-file-pdf"></i>
                Export PDF
            </a>
        </div>
    </section>

    <section class="stat-grid">
        <article class="stat-card"><span class="stat-label">Total</span><span class="stat-value">{{ $laporan->total() }}</span></article>
        <article class="stat-card"><span class="stat-label">Menunggu</span><span class="stat-value">{{ $statusCounts['menunggu'] }}</span></article>
        <article class="stat-card"><span class="stat-label">Diproses</span><span class="stat-value">{{ $statusCounts['diproses'] }}</span></article>
        <article class="stat-card"><span class="stat-label">Selesai</span><span class="stat-value">{{ $statusCounts['selesai'] }}</span></article>
        <article class="stat-card"><span class="stat-label">Ditolak</span><span class="stat-value">{{ $statusCounts['ditolak'] }}</span></article>
    </section>

    <section class="panel">
        <h2 class="panel-title">Filter Laporan</h2>
        <form method="GET" class="admin-form-grid">
            <input type="text" class="admin-field" name="search" value="{{ request('search') }}" placeholder="Cari judul, isi, pelapor...">
            <select class="admin-select" name="status">
                <option value="">Semua Status</option>
                @foreach(['menunggu', 'diproses', 'selesai', 'ditolak'] as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
            <select class="admin-select" name="sort">
                <option value="terbaru" @selected(request('sort', 'terbaru') === 'terbaru')>Terbaru</option>
                <option value="terlama" @selected(request('sort') === 'terlama')>Terlama</option>
            </select>
            <div class="admin-form-actions">
                <button type="submit" class="admin-btn admin-btn-primary"><i class="fas fa-search"></i> Terapkan</button>
                <a href="{{ route('admin.laporan.index') }}" class="admin-btn admin-btn-ghost">Reset</a>
            </div>
        </form>
    </section>

    <section class="panel">
        <h2 class="panel-title">Daftar Laporan</h2>

        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Pelapor</th>
                        <th>Status</th>
                        <th>Update Status</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporan as $item)
                        <tr>
                            <td>#{{ $item->id }}</td>
                            <td>
                                <strong>{{ $item->judul }}</strong>
                                <div class="admin-subtitle">{{ \Illuminate\Support\Str::limit($item->isi, 90) }}</div>
                            </td>
                            <td>{{ $item->user->name ?? 'Anonim' }}</td>
                            <td><span class="badge-status badge-{{ $item->status }}">{{ ucfirst($item->status) }}</span></td>
                            <td>
                                @if($item->status !== 'ditolak')
                                    <form action="{{ route('admin.laporan.status', $item->id) }}" method="POST" class="d-flex gap-2">
                                        @csrf
                                        <select name="status" class="admin-select">
                                            @foreach(['menunggu', 'diproses', 'selesai'] as $status)
                                                <option value="{{ $status }}" @selected($item->status === $status)>{{ ucfirst($status) }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="admin-btn admin-btn-ghost">Simpan</button>
                                    </form>
                                @else
                                    <span class="admin-subtitle">Tidak tersedia</span>
                                @endif
                            </td>
                            <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <div class="admin-actions">
                                    <a href="{{ route('admin.laporan.show', $item->id) }}" class="admin-btn admin-btn-ghost">Detail</a>
                                    <form action="{{ route('admin.laporan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus laporan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="admin-btn admin-btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">Belum ada data laporan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrap mt-3">{{ $laporan->links() }}</div>
    </section>
</div>
@endsection
