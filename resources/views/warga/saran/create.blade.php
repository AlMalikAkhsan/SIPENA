@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    
    <!-- Page Header -->
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('warga.saran.index') }}" class="btn btn-light me-3" style="border-radius: 12px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h2 class="fw-bold mb-1" style="color: var(--secondary-color);">Buat Saran Baru</h2>
            <p class="text-muted mb-0">Sampaikan ide, masukan, atau usulan Anda untuk perbaikan layanan</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Form Card -->
            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <form action="{{ route('warga.saran.store') }}" method="POST">
                        @csrf

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
                                   value="{{ old('judul') }}"
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
                                      placeholder="Jelaskan saran Anda secara detail:&#10;• Apa yang ingin Anda usulkan?&#10;• Mengapa saran ini penting?&#10;• Bagaimana implementasinya?&#10;• Apa manfaatnya?"
                                      required
                                      style="border-radius: 12px; border: 2px solid #e9ecef;">{{ old('isi') }}</textarea>
                            @error('isi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Jelaskan saran Anda dengan detail agar mudah dipahami</small>
                        </div>

                        <!-- Info Box -->
                        <div class="alert alert-info border-0 mb-4" style="background: rgba(13, 202, 240, 0.1); border-radius: 12px;">
                            <div class="d-flex gap-3">
                                <i class="fas fa-info-circle text-info fa-lg mt-1"></i>
                                <div>
                                    <h6 class="fw-bold mb-2">Informasi Penting</h6>
                                    <ul class="mb-0 ps-3">
                                        <li class="mb-1">Saran Anda akan ditinjau oleh admin</li>
                                        <li class="mb-1">Anda akan mendapat notifikasi jika ada tanggapan</li>
                                        <li class="mb-1">Gunakan bahasa yang sopan dan konstruktif</li>
                                        <li class="mb-0">Saran yang sudah ditanggapi tidak dapat diedit</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-primary btn-lg px-5" style="border-radius: 12px; background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%); border: none;">
                                <i class="fas fa-paper-plane me-2"></i>
                                Kirim Saran
                            </button>
                            <a href="{{ route('warga.saran.index') }}" class="btn btn-outline-secondary btn-lg px-4" style="border-radius: 12px;">
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
            <!-- Tips Card -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body p-4 text-white">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-lightbulb me-2"></i>
                        Tips Membuat Saran
                    </h5>
                    <ul class="mb-0 ps-3">
                        <li class="mb-2">Sampaikan dengan jelas dan spesifik</li>
                        <li class="mb-2">Berikan alasan mengapa penting</li>
                        <li class="mb-2">Sertakan solusi atau usulan konkret</li>
                        <li class="mb-2">Gunakan bahasa yang sopan</li>
                        <li class="mb-2">Fokus pada perbaikan layanan</li>
                        <li class="mb-0">Hindari kritik tanpa solusi</li>
                    </ul>
                </div>
            </div>

            <!-- Example Card -->
            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">
                        <i class="fas fa-star text-warning me-2"></i>
                        Contoh Saran Baik
                    </h6>
                    
                    <div class="bg-light rounded-3 p-3 mb-3">
                        <p class="small fw-semibold mb-2">📌 Judul:</p>
                        <p class="small mb-0">"Usulan Penambahan Lampu Jalan di RT 05"</p>
                    </div>

                    <div class="bg-light rounded-3 p-3">
                        <p class="small fw-semibold mb-2">📝 Isi:</p>
                        <p class="small mb-0">
                            "Saya mengusulkan penambahan 3 lampu jalan di Jl. Mawar RT 05 karena area tersebut sangat gelap di malam hari. Hal ini membuat warga tidak nyaman dan rawan kecelakaan. Lampu bisa dipasang di depan rumah No. 10, 20, dan 30."
                        </p>
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