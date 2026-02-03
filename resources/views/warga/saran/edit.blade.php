@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    
    <!-- Page Header -->
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('warga.saran.show', $saran->id) }}" class="btn btn-light me-3" style="border-radius: 12px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h2 class="fw-bold mb-1" style="color: var(--secondary-color);">Edit Saran</h2>
            <p class="text-muted mb-0">Perbarui detail saran Anda</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Form Card -->
            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <form action="{{ route('warga.saran.update', $saran->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Judul Saran -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold mb-2">
                                <i class="fas fa-heading text-primary me-2"></i>
                                Judul Saran <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="judul" 
                                   class="form-control form-control-lg @error('judul') is-invalid @enderror" 
                                   placeholder="Contoh: Usulan Penambahan Tempat Sampah di Taman"
                                   value="{{ old('judul', $saran->judul) }}"
                                   required
                                   style="border-radius: 12px; border: 2px solid #e9ecef;">
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Berikan judul yang jelas dan ringkas untuk saran Anda</small>
                        </div>

                        <!-- Isi Saran -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold mb-2">
                                <i class="fas fa-align-left text-primary me-2"></i>
                                Detail Saran <span class="text-danger">*</span>
                            </label>
                            <textarea name="isi" 
                                      class="form-control @error('isi') is-invalid @enderror" 
                                      rows="8" 
                                      placeholder="Jelaskan saran Anda secara detail..."
                                      required
                                      style="border-radius: 12px; border: 2px solid #e9ecef;">{{ old('isi', $saran->isi) }}</textarea>
                            @error('isi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Jelaskan saran Anda dengan detail agar mudah dipahami</small>
                        </div>

                        <!-- Info Box -->
                        <div class="alert alert-warning border-0 mb-4" style="background: rgba(255, 193, 7, 0.1); border-radius: 12px;">
                            <div class="d-flex gap-3">
                                <i class="fas fa-exclamation-triangle text-warning fa-lg mt-1"></i>
                                <div>
                                    <h6 class="fw-bold mb-2">Perhatian</h6>
                                    <p class="mb-0 small">Setelah admin memberikan tanggapan, Anda tidak akan bisa mengedit saran ini lagi. Pastikan informasi yang Anda berikan sudah lengkap dan akurat.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-primary btn-lg px-5" style="border-radius: 12px; background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%); border: none;">
                                <i class="fas fa-save me-2"></i>
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('warga.saran.show', $saran->id) }}" class="btn btn-outline-secondary btn-lg px-4" style="border-radius: 12px;">
                                <i class="fas fa-times me-2"></i>
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="col-lg-4">
            <!-- Current Status Card -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
                <div class="card-header bg-primary bg-opacity-10 border-0 p-3">
                    <h6 class="fw-bold mb-0 text-primary">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Saran
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">ID Saran</small>
                        <span class="fw-semibold">#{{ str_pad($saran->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">Status</small>
                        <span class="badge
                            @if($saran->status == 'menunggu') bg-warning
                            @elseif($saran->status == 'dibaca') bg-info
                            @else bg-success
                            @endif">
                            {{ ucfirst($saran->status) }}
                        </span>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">Dibuat pada</small>
                        <span class="fw-semibold">{{ $saran->created_at->format('d M Y') }}</span>
                    </div>

                    <div>
                        <small class="text-muted d-block mb-1">Terakhir diupdate</small>
                        <span class="fw-semibold">{{ $saran->updated_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body p-4 text-white">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-lightbulb me-2"></i>
                        Tips Edit Saran
                    </h5>
                    <ul class="mb-0 ps-3">
                        <li class="mb-2">Periksa kembali ejaan dan tata bahasa</li>
                        <li class="mb-2">Pastikan informasi sudah lengkap</li>
                        <li class="mb-2">Tambahkan detail yang mungkin terlewat</li>
                        <li class="mb-2">Gunakan bahasa yang jelas</li>
                        <li class="mb-0">Fokus pada solusi, bukan hanya masalah</li>
                    </ul>
                </div>
            </div>

            <!-- Preview Changes Card -->
            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">
                        <i class="fas fa-history text-warning me-2"></i>
                        Riwayat Perubahan
                    </h6>
                    <div class="small">
                        <div class="d-flex gap-2 mb-2">
                            <i class="fas fa-circle text-success" style="font-size: 8px; margin-top: 6px;"></i>
                            <div>
                                <div class="fw-semibold">Dibuat</div>
                                <div class="text-muted">{{ $saran->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                        @if($saran->created_at != $saran->updated_at)
                            <div class="d-flex gap-2">
                                <i class="fas fa-circle text-info" style="font-size: 8px; margin-top: 6px;"></i>
                                <div>
                                    <div class="fw-semibold">Terakhir Diupdate</div>
                                    <div class="text-muted">{{ $saran->updated_at->format('d M Y, H:i') }}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.15);
}

.btn-primary {
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 107, 53, 0.3);
}

.card {
    transition: all 0.3s ease;
}
</style>
@endsection