@extends('layouts.user')

@section('title', 'Edit Saran - Lapor Aja!')

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

    .edit-container {
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

    .form-control {
        border-radius: 12px;
        border: 1px solid rgba(129, 212, 250, 0.4);
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.25rem rgba(79, 195, 247, 0.15);
    }

    .warning-box {
        background: rgba(249, 115, 22, 0.08);
        border-radius: 12px;
        padding: 1.25rem;
        margin-bottom: 2rem;
        border-left: 4px solid #f97316;
    }

    .sidebar-card {
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(129, 212, 250, 0.2);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-soft);
        padding: 1.5rem;
    }

    .status-badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        color: white;
    }

    .btn-update {
        background: var(--primary);
        border: none;
        border-radius: 12px;
        padding: 0.85rem 2.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-update:hover {
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
<div class="edit-container">

    <!-- Header -->
    <div class="header-section">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('warga.saran.index', $saran->id) }}" class="btn btn-light rounded-circle shadow-sm p-3" style="width:48px;height:48px;display:flex;align-items:center;justify-content:center;">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="fw-bold mb-1" style="color: var(--primary-dark);">Edit Saran</h2>
                <p class="text-muted mb-0">Perbarui detail saran Anda (hanya bisa jika belum ditanggapi)</p>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <span class="status-badge status-{{ $saran->status }} px-3 py-2">
                {{ ucfirst($saran->status) }}
            </span>
            <small class="text-muted">Dibuat: {{ $saran->created_at->format('d M Y') }}</small>
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Form -->
        <div class="col-lg-8">
            <div class="form-card">
                <form action="{{ route('warga.saran.update', $saran->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Judul Saran -->
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="fas fa-heading text-primary me-2"></i>Judul Saran <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="judul" class="form-control form-control-lg @error('judul') is-invalid @enderror"
                               value="{{ old('judul', $saran->judul) }}" required>
                        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="text-muted d-block mt-1">Buat judul yang jelas dan langsung ke intinya</small>
                    </div>

                    <!-- Isi Saran -->
                    <div class="mb-5">
                        <label class="form-label">
                            <i class="fas fa-align-left text-primary me-2"></i>Detail Saran <span class="text-danger">*</span>
                        </label>
                        <textarea name="isi" rows="8" class="form-control @error('isi') is-invalid @enderror" required>
                            {{ old('isi', $saran->isi) }}
                        </textarea>
                        @error('isi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="text-muted d-block mt-1">Jelaskan saran Anda dengan detail agar mudah dipahami dan ditindaklanjuti</small>
                    </div>

                    <!-- Peringatan -->
                    <div class="warning-box">
                        <h6 class="fw-bold mb-2" style="color: #c2410c;">
                            <i class="fas fa-exclamation-triangle me-2"></i>Perhatian
                        </h6>
                        <p class="small mb-0">
                            Setelah admin memberikan tanggapan, Anda tidak akan bisa mengedit saran ini lagi. 
                            Pastikan informasi sudah lengkap dan akurat sebelum menyimpan perubahan.
                        </p>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="d-flex flex-column flex-sm-row gap-3 mt-5">
                        <button type="submit" class="btn btn-update btn-lg flex-fill">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('warga.saran.show', $saran->id) }}" class="btn btn-outline-secondary btn-lg flex-fill">
                            <i class="fas fa-times me-2"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Info Card -->
            <div class="sidebar-card mb-4">
                <h6 class="fw-bold mb-3" style="color: var(--primary-dark);">
                    <i class="fas fa-info-circle me-2"></i>Informasi Saran
                </h6>

                <div class="mb-3 pb-3 border-bottom">
                    <small class="text-muted d-block mb-1">ID Saran</small>
                    <span class="fw-semibold">#{{ str_pad($saran->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>

                <div class="mb-3 pb-3 border-bottom">
                    <small class="text-muted d-block mb-1">Status</small>
                    <span class="badge status-{{ $saran->status }} px-3 py-2">
                        {{ ucfirst($saran->status) }}
                    </span>
                </div>

                <div class="mb-3 pb-3 border-bottom">
                    <small class="text-muted d-block mb-1">Dibuat pada</small>
                    <span class="fw-semibold">{{ $saran->created_at->format('d M Y, H:i') }}</span>
                </div>

                <div>
                    <small class="text-muted d-block mb-1">Terakhir diupdate</small>
                    <span class="fw-semibold">{{ $saran->updated_at->format('d M Y, H:i') }}</span>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="sidebar-card">
                <h5 class="fw-bold mb-3" style="color: var(--primary-dark);">
                    <i class="fas fa-lightbulb me-2 text-warning"></i>Tips Edit Saran
                </h5>
                <ul class="tips-list list-unstyled mb-0">
                    <li><i class="fas fa-check-circle"></i>Periksa kembali ejaan dan tata bahasa</li>
                    <li><i class="fas fa-check-circle"></i>Pastikan informasi sudah lengkap & akurat</li>
                    <li><i class="fas fa-check-circle"></i>Tambahkan detail yang mungkin terlewat sebelumnya</li>
                    <li><i class="fas fa-check-circle"></i>Gunakan bahasa yang jelas dan sopan</li>
                    <li><i class="fas fa-check-circle"></i>Fokus pada solusi, bukan hanya masalah</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection 