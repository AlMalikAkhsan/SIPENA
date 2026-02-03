@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: var(--secondary-color);">Saran Saya</h2>
            <p class="text-muted mb-0">Kelola dan pantau saran yang telah Anda kirimkan</p>
        </div>
        <a href="{{ route('warga.saran.create') }}" class="btn btn-primary btn-lg" style="border-radius: 12px;">
            <i class="fas fa-plus-circle me-2"></i>
            Buat Saran Baru
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #0d6efd; border-radius: 12px;">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Total Saran</p>
                            <h3 class="fw-bold mb-0">{{ $saran->total() }}</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-lightbulb text-primary fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #ffc107; border-radius: 12px;">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Menunggu</p>
                            <h3 class="fw-bold mb-0 text-warning">{{ $saran->where('status', 'menunggu')->count() }}</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-clock text-warning fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #198754; border-radius: 12px;">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Diterapkan</p>
                            <h3 class="fw-bold mb-0 text-success">{{ $saran->where('status', 'diterapkan')->count() }}</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-check-circle text-success fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #dc3545; border-radius: 12px;">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Ditolak</p>
                            <h3 class="fw-bold mb-0 text-danger">{{ $saran->where('status', 'ditolak')->count() }}</h3>
                        </div>
                        <div class="bg-danger bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-times-circle text-danger fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Saran List -->
    @if($saran->count() > 0)
        <div class="row g-4">
            @foreach($saran as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 hover-card" style="border-radius: 16px; transition: all 0.3s ease;">
                        <div class="card-body p-4">
                            <!-- Status Badge -->
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="badge px-3 py-2
                                    @if($item->status == 'menunggu') bg-warning
                                    @elseif($item->status == 'dibaca') bg-info
                                    @elseif($item->status == 'ditinjau') bg-purple
                                    @elseif($item->status == 'diterapkan') bg-success
                                    @else bg-danger
                                    @endif">
                                    {{ ucfirst($item->status) }}
                                </span>
                                
                                @if($item->tanggapan_admin)
                                    <span class="badge bg-success bg-opacity-10 text-success">
                                        <i class="fas fa-reply me-1"></i> Ada Tanggapan
                                    </span>
                                @endif
                            </div>

                            <!-- Title -->
                            <h5 class="fw-bold mb-2">{{ Str::limit($item->judul, 50) }}</h5>

                            <!-- Content Preview -->
                            <p class="text-muted small mb-3" style="height: 60px; overflow: hidden;">
                                {{ Str::limit($item->isi, 100) }}
                            </p>

                            <!-- Meta Info -->
                            <div class="d-flex align-items-center gap-3 mb-3 text-muted small">
                                <div>
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $item->created_at->format('d M Y') }}
                                </div>
                                <div>
                                    <i class="fas fa-clock me-1"></i>
                                    {{ $item->created_at->diffForHumans() }}
                                </div>
                            </div>

                            <!-- Tanggapan Preview -->
                            @if($item->tanggapan_admin)
                                <div class="alert alert-success border-0 mb-3 p-2" style="background: rgba(25, 135, 84, 0.1);">
                                    <small class="text-success fw-semibold">
                                        <i class="fas fa-comment-dots me-1"></i>
                                        Admin telah menanggapi saran Anda
                                    </small>
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="d-flex gap-2">
                                <a href="{{ route('warga.saran.show', $item->id) }}" 
                                   class="btn btn-primary btn-sm flex-grow-1" 
                                   style="border-radius: 8px;">
                                    <i class="fas fa-eye me-1"></i> Detail
                                </a>
                                
                                @if(!$item->tanggapan_admin)
                                    <a href="{{ route('warga.saran.edit', $item->id) }}" 
                                       class="btn btn-outline-warning btn-sm" 
                                       style="border-radius: 8px;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form action="{{ route('warga.saran.destroy', $item->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus saran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline-danger btn-sm" 
                                                style="border-radius: 8px;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    <span class="badge bg-secondary align-self-center px-2">
                                        <i class="fas fa-lock me-1"></i> Ditanggapi
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $saran->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-body text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-lightbulb fa-4x text-muted"></i>
                </div>
                <h5 class="fw-bold mb-2">Belum Ada Saran</h5>
                <p class="text-muted mb-4">Anda belum pernah mengirimkan saran. Mulai berikan ide atau masukan Anda!</p>
                <a href="{{ route('warga.saran.create') }}" class="btn btn-primary btn-lg" style="border-radius: 12px;">
                    <i class="fas fa-plus-circle me-2"></i>
                    Buat Saran Pertama
                </a>
            </div>
        </div>
    @endif
</div>

<style>
.hover-card {
    transition: all 0.3s ease;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15) !important;
}

.bg-purple {
    background-color: #6f42c1 !important;
}

.btn {
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-1px);
}
</style>
@endsection