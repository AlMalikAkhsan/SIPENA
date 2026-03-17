@extends('layouts.user')

@section('title', 'Buat Saran Baru - Lapor Aja!')

@push('styles')
<style>
    :root {
        --primary: #4fc3f7;
        --primary-dark: #0288d1;
        --primary-soft: #81d4fa;
        --text-dark: #1e293b;
        --text-muted: #64748b;
        --card-bg: rgba(255, 255, 255, 0.78);
        --shadow-soft: 0 8px 32px rgba(79, 195, 247, 0.12);
        --shadow-hover: 0 12px 40px rgba(79, 195, 247, 0.22);
        --radius-lg: 20px;
        --radius-md: 16px;
    }

    .create-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1.5rem 1rem 5rem;
    }

    .header-section {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-bottom: 2.5rem;
    }

    @media (min-width: 768px) {
        .header-section {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }
    }

    .form-card {
        background: var(--card-bg);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(129, 212, 250, 0.2);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-soft);
        padding: 2rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--text-dark);
    }

    .form-control, .form-select {
        border-radius: 12px;
        border: 1px solid rgba(129, 212, 250, 0.4);
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.25rem rgba(79, 195, 247, 0.15);
    }

    .info-box {
        background: rgba(79, 195, 247, 0.08);
        border-radius: 12px;
        padding: 1.25rem;
        margin-bottom: 2rem;
        border-left: 4px solid var(--primary);
    }

    .sidebar-card {
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(129, 212, 250, 0.2);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-soft);
        padding: 1.5rem;
    }

    .tips-list li {
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
        color: var(--text-muted);
    }

    .tips-list li i {
        color: var(--primary);
        margin-right: 8px;
    }

    .btn-submit {
        background: var(--primary);
        border: none;
        border-radius: 12px;
        padding: 0.85rem 2.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        background: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: var(--shadow-hover);
    }

    @media (max-width: 992px) {
        .sidebar-card { margin-top: 1.5rem; }
    }
</style>
@endpush

@section('content')
<div class="create-container">

    <!-- Header -->
    <div class="header-section">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('warga.saran.index') }}" class="btn btn-light rounded-circle shadow-sm p-3" style="width:48px;height:48px;display:flex;align-items:center;justify-content:center;">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="fw-bold mb-1" style="color: var(--primary-dark);">Buat Saran Baru</h2>
                <p class="text-muted mb-0">Sampaikan ide, masukan, atau usulan untuk perbaikan RW 05</p>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Form -->
        <div class="col-lg-8">
            <div class="form-card">
                <form action="{{ route('warga.saran.store') }}" method="POST">
                    @csrf

                    <!-- Judul Saran -->
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="fas fa-heading text-primary me-2"></i>Judul Saran <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="judul" class="form-control form-control-lg @error('judul') is-invalid @enderror"
                               placeholder="Contoh: Usulan Penambahan Tempat Sampah di Taman RW 05"
                               value="{{ old('judul') }}" required>
                        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="text-muted d-block mt-1">Buat judul yang jelas dan langsung ke intinya</small>
                    </div>

                    <!-- Isi Saran -->
                    <div class="mb-5">
                        <label class="form-label">
                            <i class="fas fa-align-left text-primary me-2"></i>Detail Saran <span class="text-danger">*</span>
                        </label>
                        <textarea name="isi" rows="8" class="form-control @error('isi') is-invalid @enderror" required
                                  placeholder="Jelaskan saran Anda secara detail:&#10;• Apa yang ingin diusulkan?&#10;• Mengapa ini penting?&#10;• Bagaimana cara implementasinya?&#10;• Apa manfaatnya bagi warga?">{{ old('isi') }}</textarea>
                        @error('isi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="text-muted d-block mt-1">Semakin detail saran Anda, semakin mudah ditindaklanjuti oleh pengurus RW</small>
                    </div>

                    <!-- Info Box -->
                    <div class="info-box">
                        <h6 class="fw-bold mb-2" style="color: var(--primary-dark);">
                            <i class="fas fa-info-circle me-2"></i>Informasi Penting
                        </h6>
                        <ul class="small mb-0 ps-3">
                            <li class="mb-1">Saran Anda akan ditinjau oleh pengurus RW</li>
                            <li class="mb-1">Anda akan mendapat notifikasi jika ada tanggapan</li>
                            <li class="mb-1">Gunakan bahasa yang sopan dan konstruktif</li>
                            <li class="mb-0">Saran yang sudah ditanggapi tidak dapat diedit lagi</li>
                        </ul>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="d-flex flex-column flex-sm-row gap-3 mt-5">
                        <button type="submit" class="btn btn-submit btn-lg flex-fill">
                            <i class="fas fa-paper-plane me-2"></i> Kirim Saran
                        </button>
                        <a href="{{ route('warga.saran.index') }}" class="btn btn-outline-secondary btn-lg flex-fill">
                            <i class="fas fa-times me-2"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar Tips & Contoh -->
        <div class="col-lg-4">
            <!-- Tips Card -->
            <div class="sidebar-card mb-4">
                <h5 class="fw-bold mb-3" style="color: var(--primary-dark);">
                    <i class="fas fa-lightbulb me-2 text-warning"></i>Tips Membuat Saran Efektif
                </h5>
                <ul class="tips-list list-unstyled mb-0">
                    <li><i class="fas fa-check-circle"></i>Sampaikan dengan jelas dan spesifik</li>
                    <li><i class="fas fa-check-circle"></i>Berikan alasan mengapa saran ini penting</li>
                    <li><i class="fas fa-check-circle"></i>Sertakan solusi atau usulan konkret</li>
                    <li><i class="fas fa-check-circle"></i>Gunakan bahasa yang sopan & faktual</li>
                    <li><i class="fas fa-check-circle"></i>Fokus pada perbaikan bersama, bukan kritik personal</li>
                    <li><i class="fas fa-check-circle"></i>Hindari saran yang terlalu umum atau emosional</li>
                </ul>
            </div>

            <!-- Contoh Saran Baik -->
            <div class="sidebar-card">
                <h6 class="fw-bold mb-3" style="color: var(--primary-dark);">
                    <i class="fas fa-star me-2 text-warning"></i>Contoh Saran Baik
                </h6>

                <div class="bg-light rounded-3 p-3 mb-3">
                    <p class="small fw-semibold mb-2">📌 Judul:</p>
                    <p class="small mb-0">"Usulan Penambahan Lampu Jalan di Gang Mawar RT 05"</p>
                </div>

                <div class="bg-light rounded-3 p-3">
                    <p class="small fw-semibold mb-2">📝 Isi:</p>
                    <p class="small mb-0">
                        "Saya mengusulkan penambahan 3 lampu jalan di Gang Mawar RT 05 karena area tersebut sangat gelap setelah pukul 19.00. Hal ini membuat warga, terutama anak-anak dan lansia, merasa tidak aman saat pulang malam. Usulan: lampu dipasang di depan rumah No. 10, 20, dan 30. Manfaat: meningkatkan keamanan dan kenyamanan warga malam hari."
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection