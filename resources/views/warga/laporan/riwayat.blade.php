@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    
    <!-- Page Header -->
    <div class="mb-4">
        <h2 class="fw-bold mb-1" style="color: var(--secondary-color);">
            <i class="fas fa-history me-2"></i>
            Riwayat Laporan
        </h2>
        <p class="text-muted mb-0">Laporan yang sudah selesai dan diarsipkan</p>
    </div>

    <!-- Stats Summary -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm" style="border-radius: 16px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                <div class="card-body text-white text-center py-4">
                    <i class="fas fa-archive fa-2x mb-3 opacity-75"></i>
                    <h2 class="fw-bold mb-1">{{ $laporan->total() }}</h2>
                    <p class="mb-0 opacity-75">Total Riwayat</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm" style="border-radius: 16px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body text-white text-center py-4">
                    <i class="fas fa-check-circle fa-2x mb-3 opacity-75"></i>
                    <h2 class="fw-bold mb-1">{{ $laporan->where('status', 'selesai')->count() }}</h2>
                    <p class="mb-0 opacity-75">Selesai</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm" style="border-radius: 16px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="card-body text-white text-center py-4">
                    <i class="fas fa-star fa-2x mb-3 opacity-75"></i>
                    <h2 class="fw-bold mb-1">{{ $laporan->whereHas('feedback')->count() }}</h2>
                    <p class="mb-0 opacity-75">Ada Feedback</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Laporan List -->
    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
        <div class="card-header bg-white py-3 border-0">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-folder-open text-primary me-2"></i>
                    Daftar Riwayat ({{ $laporan->count() }})
                </h5>
                <a href="{{ route('warga.laporan.index') }}" class="btn btn-sm btn-outline-primary" style="border-radius: 10px;">
                    <i class="fas fa-arrow-left me-1"></i>
                    Kembali ke Laporan Aktif
                </a>
            </div>
        </div>
        
        <div class="card-body p-0">
            @forelse($laporan as $item)
                <div class="border-bottom p-4 hover-bg">
                    <div class="row align-items-center">
                        <!-- Thumbnail -->
                        <div class="col-md-2">
                            @if($item->foto && file_exists(public_path('uploads/' . $item->foto)))
                                <img src="{{ asset('uploads/' . $item->foto) }}"
                                    class="img-fluid rounded"
                                    style="width:100%; height:100px; object-fit:cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                    style="width: 100%; height: 100px;">
                                    <i class="fas fa-image fa-2x text-muted"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Info -->
                        <div class="col-md-6">
                            <h5 class="fw-bold mb-2">{{ $item->judul }}</h5>
                            <p class="text-muted mb-2 small">
                                {{ Str::limit($item->isi, 100) }}
                            </p>
                            
                            <div class="d-flex gap-3 small text-muted">
                                <span>
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $item->created_at->format('d M Y') }}
                                </span>
                                <span>
                                    <i class="fas fa-archive me-1"></i>
                                    Diarsipkan: {{ $item->archived_at->format('d M Y') }}
                                </span>
                                @if($item->feedback)
                                <span class="text-warning">
                                    <i class="fas fa-star me-1"></i>
                                    Rating: {{ $item->feedback->rating }}/5
                                </span>
                                @endif
                            </div>
                        </div>

                        <!-- Status & Actions -->
                        <div class="col-md-4 text-end">
                            <div class="mb-3">
                                <span class="badge rounded-pill px-3 py-2
                                    @if($item->status == 'selesai') bg-success
                                    @else bg-secondary
                                    @endif
                                ">
                                    <i class="fas fa-check-circle me-1"></i>
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>

                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('warga.laporan.show', $item->id) }}" 
                                   class="btn btn-sm btn-outline-primary"
                                   style="border-radius: 8px;">
                                    <i class="fas fa-eye me-1"></i>
                                    Detail
                                </a>

                                <form action="{{ route('warga.laporan.unarchive', $item->id) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    <button type="submit" 
                                            class="btn btn-sm btn-outline-success"
                                            style="border-radius: 8px;"
                                            title="Kembalikan ke Laporan Aktif">
                                        <i class="fas fa-undo me-1"></i>
                                        Restore
                                    </button>
                                </form>

                                @if(!$item->feedback)
                                <button type="button" 
                                        class="btn btn-sm btn-outline-danger"
                                        style="border-radius: 8px;"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal{{ $item->id }}">
                                    <i class="fas fa-trash me-1"></i>
                                    Hapus
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Konfirmasi Hapus -->
                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="border-radius: 16px;">
                            <div class="modal-body text-center p-5">
                                <div class="mb-4">
                                    <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex p-4">
                                        <i class="fas fa-trash fa-3x text-danger"></i>
                                    </div>
                                </div>
                                <h4 class="fw-bold mb-3">Hapus Riwayat?</h4>
                                <p class="text-muted mb-4">
                                    Riwayat "<strong>{{ Str::limit($item->judul, 40) }}</strong>" akan dihapus permanen.
                                </p>
                                <div class="d-flex gap-3 justify-content-center">
                                    <button type="button" 
                                            class="btn btn-light px-4" 
                                            data-bs-dismiss="modal"
                                            style="border-radius: 10px;">
                                        Batal
                                    </button>
                                    <form action="{{ route('warga.laporan.destroy', $item->id) }}" 
                                          method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger px-4"
                                                style="border-radius: 10px;">
                                            <i class="fas fa-trash me-2"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted mb-2">Belum Ada Riwayat</h5>
                    <p class="text-muted small mb-4">Laporan yang sudah selesai akan muncul di sini</p>
                    <a href="{{ route('warga.laporan.index') }}" class="btn btn-primary" style="border-radius: 10px;">
                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali ke Laporan
                    </a>
                </div>
            @endforelse
        </div>

        @if($laporan->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            {{ $laporan->links() }}
        </div>
        @endif
    </div>
</div>

<style>
.hover-bg:hover {
    background-color: rgba(0, 0, 0, 0.02);
    transition: background-color 0.2s ease;
}

.btn-sm {
    transition: all 0.3s ease;
}

.btn-sm:hover {
    transform: translateY(-2px);
}
</style>
@endsection