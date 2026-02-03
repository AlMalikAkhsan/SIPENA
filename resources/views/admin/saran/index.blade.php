@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    
    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Kelola Saran Warga</h2>
            <p class="text-muted mb-0">Lihat dan tanggapi saran dari warga</p>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="row g-3 mb-4">
        {{-- Total Saran --}}
        <div class="col-md-2">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #0d6efd;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Total Saran</p>
                            <h3 class="fw-bold mb-0">{{ $total }}</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-lightbulb text-primary fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Menunggu --}}
        <div class="col-md-2">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #ffc107;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Menunggu</p>
                            <h3 class="fw-bold mb-0 text-warning">{{ $menunggu }}</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-clock text-warning fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Dibaca --}}
        <div class="col-md-2">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #0dcaf0;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Dibaca</p>
                            <h3 class="fw-bold mb-0 text-info">{{ $dibaca }}</h3>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-eye text-info fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Ditinjau --}}
        <div class="col-md-2">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #6f42c1;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Ditinjau</p>
                            <h3 class="fw-bold mb-0" style="color: #6f42c1;">{{ $ditinjau }}</h3>
                        </div>
                        <div class="p-3 rounded-circle" style="background: rgba(111, 66, 193, 0.1);">
                            <i class="fas fa-search" style="color: #6f42c1;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Diterapkan --}}
        <div class="col-md-2">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #198754;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Diterapkan</p>
                            <h3 class="fw-bold mb-0 text-success">{{ $diterapkan }}</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-check-circle text-success fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Ditolak --}}
        <div class="col-md-2">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #dc3545;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Ditolak</p>
                            <h3 class="fw-bold mb-0 text-danger">{{ $ditolak }}</h3>
                        </div>
                        <div class="bg-danger bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-times-circle text-danger fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter & Search --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('admin.saran.index') }}" method="GET">
                <div class="row g-3">
                    {{-- Search --}}
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input 
                                type="text" 
                                name="search" 
                                class="form-control border-start-0" 
                                placeholder="Cari judul, isi, atau nama warga..."
                                value="{{ request('search') }}"
                            >
                        </div>
                    </div>

                    {{-- Filter Status --}}
                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>
                                Menunggu
                            </option>
                            <option value="dibaca" {{ request('status') == 'dibaca' ? 'selected' : '' }}>
                                Dibaca
                            </option>
                            <option value="ditinjau" {{ request('status') == 'ditinjau' ? 'selected' : '' }}>
                                Ditinjau
                            </option>
                            <option value="diterapkan" {{ request('status') == 'diterapkan' ? 'selected' : '' }}>
                                Diterapkan
                            </option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>
                                Ditolak
                            </option>
                        </select>
                    </div>

                    {{-- Sorting --}}
                    <div class="col-md-2">
                        <select name="sort" class="form-select">
                            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>
                                Terbaru
                            </option>
                            <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>
                                Terlama
                            </option>
                        </select>
                    </div>

                    {{-- Buttons --}}
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-filter me-1"></i> Filter
                        </button>
                        <a href="{{ route('admin.saran.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-redo me-1"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Saran List --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if($saran->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3" width="5%">No</th>
                                <th class="py-3" width="35%">Judul & Pemberi Saran</th>
                                <th class="py-3" width="15%">Status</th>
                                <th class="py-3" width="15%">Tanggal</th>
                                <th class="py-3" width="15%">Tanggapan</th>
                                <th class="py-3 text-center" width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($saran as $index => $item)
                                <tr>
                                    {{-- No --}}
                                    <td class="px-4">
                                        {{ $saran->firstItem() + $index }}
                                    </td>

                                    {{-- Judul & Pemberi Saran --}}
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 flex-shrink-0">
                                                <i class="fas fa-lightbulb text-primary"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold mb-1">
                                                    {{ Str::limit($item->judul, 50) }}
                                                </div>
                                                <small class="text-muted">
                                                    <i class="fas fa-user me-1"></i>
                                                    {{ $item->user->name ?? 'Anonim' }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Status --}}
                                    <td>
                                        <span class="badge px-3 py-2
                                            @if($item->status == 'menunggu') bg-warning
                                            @elseif($item->status == 'dibaca') bg-info
                                            @elseif($item->status == 'ditinjau') bg-purple
                                            @elseif($item->status == 'diterapkan') bg-success
                                            @else bg-danger
                                            @endif">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>

                                    {{-- Tanggal --}}
                                    <td>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $item->created_at->format('d M Y') }}
                                        </small>
                                        <div>
                                            <small class="text-muted">
                                                {{ $item->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                    </td>

                                    {{-- Tanggapan --}}
                                    <td>
                                        @if($item->tanggapan_admin)
                                            <span class="badge bg-success">
                                                <i class="fas fa-check me-1"></i>
                                                Sudah Ditanggapi
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                <i class="fas fa-minus me-1"></i>
                                                Belum
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="text-center">
                                        <a 
                                            href="{{ route('admin.saran.show', $item->id) }}" 
                                            class="btn btn-sm btn-primary"
                                        >
                                            <i class="fas fa-eye me-1"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="p-4 border-top">
                    {{ $saran->links() }}
                </div>
            @else
                {{-- Empty State --}}
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <p class="text-muted mb-0">Belum ada saran dari warga</p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.bg-purple {
    background-color: #6f42c1 !important;
}

.card {
    transition: transform 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
}

.table tbody tr {
    transition: background-color 0.2s ease;
}

.table tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.02);
}
</style>
@endsection