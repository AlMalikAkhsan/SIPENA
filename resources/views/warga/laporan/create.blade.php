@extends('layouts.user')

@section('title', 'Buat Laporan Baru - Lapor Aja!')

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

    .form-card {
        background: var(--card-bg);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(129, 212, 250, 0.25);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-soft);
        overflow: hidden;
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

    .upload-area {
        border: 2px dashed rgba(129, 212, 250, 0.5);
        border-radius: 16px;
        padding: 3rem 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: rgba(227, 242, 253, 0.3);
    }

    .upload-area:hover, .upload-area.dragover {
        border-color: var(--primary);
        background: rgba(187, 222, 251, 0.4);
        box-shadow: 0 0 0 4px rgba(79, 195, 247, 0.1);
    }

    .preview-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .preview-item {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        aspect-ratio: 1 / 1;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .remove-btn {
        position: absolute;
        top: 8px;
        right: 8px;
        background: rgba(239, 68, 68, 0.9);
        color: white;
        border: none;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 0.9rem;
        transition: all 0.2s;
    }

    .remove-btn:hover {
        background: #ef4444;
        transform: scale(1.1);
    }

    .info-card, .tips-card {
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(129, 212, 250, 0.2);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-soft);
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
        box-shadow: 0 8px 24px rgba(79, 195, 247, 0.35);
    }

    @media (max-width: 992px) {
        .preview-container {
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">

    <!-- Page Header -->
    <div class="d-flex align-items-center mb-4 gap-3">
        <a href="{{ route('warga.laporan.index') }}" class="btn btn-light rounded-circle shadow-sm p-2" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h2 class="fw-bold mb-1" style="color: var(--primary-dark);">Buat Laporan Baru</h2>
            <p class="text-muted mb-0">Laporkan keluhan, kerusakan, atau aspirasi untuk RW 05</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Form -->
        <div class="col-lg-8">
            <div class="form-card p-4 p-md-5">
                <form action="{{ route('warga.laporan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Judul -->
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="fas fa-heading text-primary me-2"></i>Judul Laporan <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="judul" class="form-control form-control-lg @error('judul') is-invalid @enderror"
                               placeholder="Contoh: Lampu Jalan Mati di Gang Mawar" value="{{ old('judul') }}" required>
                        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="text-muted d-block mt-1">Buat judul yang jelas dan langsung ke intinya</small>
                    </div>

                    <!-- Isi / Deskripsi -->
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="fas fa-align-left text-primary me-2"></i>Detail Laporan <span class="text-danger">*</span>
                        </label>
                        <textarea name="isi" rows="6" class="form-control @error('isi') is-invalid @enderror"
                                  placeholder="Jelaskan apa yang terjadi, kapan, di mana, dan dampaknya..." required>{{ old('isi') }}</textarea>
                        @error('isi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="text-muted d-block mt-1">Minimal 20 karakter. Semakin detail semakin cepat ditangani</small>
                    </div>

                    <!-- Foto Upload -->
                    <div class="mb-5">
                        <label class="form-label">
                            <i class="fas fa-images text-primary me-2"></i>Foto Pendukung <span class="text-muted">(Maksimal 5 foto)</span>
                        </label>
                        <div class="upload-area" id="uploadArea">
                            <input type="file" name="fotos[]" id="fotoInput" class="d-none" accept="image/*" multiple>
                            <div id="uploadPlaceholder">
                                <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                <p class="fw-semibold mb-1">Klik atau tarik foto ke sini</p>
                                <small class="text-muted">JPG, PNG • Maks 5MB per foto • Hingga 5 foto</small>
                            </div>
                        </div>

                        <div id="previewContainer" class="preview-container"></div>

                        @error('fotos.*')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Lokasi -->
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>Lokasi Kejadian <span class="text-muted">(Opsional)</span>
                        </label>
                        <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
                               placeholder="Contoh: RT 03 / Gang Melati No. 45, RW 05" value="{{ old('lokasi') }}">
                        @error('lokasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="text-muted d-block mt-1">Sebutkan RT/RW atau patokan terdekat agar lebih mudah ditemukan</small>
                    </div>

                    <!-- Submit -->
                    <div class="d-flex flex-column flex-sm-row gap-3 mt-5">
                        <button type="submit" class="btn btn-primary btn-lg flex-fill btn-submit">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Laporan
                        </button>
                        <a href="{{ route('warga.laporan.index') }}" class="btn btn-outline-secondary btn-lg flex-fill">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar Tips & Info -->
        <div class="col-lg-4">
            <!-- Tips -->
            <div class="tips-card p-4 mb-4">
                <h5 class="fw-bold mb-3" style="color: var(--primary-dark);">
                    <i class="fas fa-lightbulb me-2 text-warning"></i>Tips Membuat Laporan Efektif
                </h5>
                <ul class="tips-list list-unstyled mb-0">
                    <li><i class="fas fa-check-circle"></i>Judul singkat tapi deskriptif</li>
                    <li><i class="fas fa-check-circle"></i>Jelaskan masalah + kronologi secara runtut</li>
                    <li><i class="fas fa-check-circle"></i>Lampirkan foto dari beberapa sudut</li>
                    <li><i class="fas fa-check-circle"></i>Maksimal 5 foto, ukuran < 5MB/foto</li>
                    <li><i class="fas fa-check-circle"></i>Tulis lokasi sejelas mungkin (RT, gang, patokan)</li>
                    <li><i class="fas fa-check-circle"></i>Gunakan bahasa sopan & faktual</li>
                </ul>
            </div>

            <!-- Informasi Penting -->
            <div class="info-card p-4">
                <h6 class="fw-bold mb-3" style="color: var(--primary-dark);">
                    <i class="fas fa-info-circle me-2 text-info"></i>Informasi Penting
                </h6>
                <div class="d-flex align-items-start mb-3">
                    <div class="bg-info bg-opacity-10 p-2 rounded me-3">
                        <i class="fas fa-clock text-info"></i>
                    </div>
                    <div>
                        <div class="fw-semibold small">Waktu Penanganan</div>
                        <small class="text-muted">Biasanya 1–3 hari kerja</small>
                    </div>
                </div>
                <div class="d-flex align-items-start mb-3">
                    <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                        <i class="fas fa-bell text-primary"></i>
                    </div>
                    <div>
                        <div class="fw-semibold small">Notifikasi</div>
                        <small class="text-muted">Update status via email & dashboard</small>
                    </div>
                </div>
                <div class="d-flex align-items-start">
                    <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                        <i class="fas fa-shield-alt text-success"></i>
                    </div>
                    <div>
                        <div class="fw-semibold small">Privasi & Transparansi</div>
                        <small class="text-muted">Data pribadi aman, laporan bisa dilihat publik (tanpa identitas)</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let selectedFiles = [];
const maxFiles = 5;
const uploadArea = document.getElementById('uploadArea');
const fotoInput = document.getElementById('fotoInput');
const previewContainer = document.getElementById('previewContainer');
const uploadPlaceholder = document.getElementById('uploadPlaceholder');

// Click to upload
uploadArea.addEventListener('click', () => fotoInput.click());

// Drag & Drop
uploadArea.addEventListener('dragover', e => {
    e.preventDefault();
    uploadArea.classList.add('dragover');
});
uploadArea.addEventListener('dragleave', e => {
    e.preventDefault();
    uploadArea.classList.remove('dragover');
});
uploadArea.addEventListener('drop', e => {
    e.preventDefault();
    uploadArea.classList.remove('dragover');
    handleFiles(e.dataTransfer.files);
});

// Handle files
fotoInput.addEventListener('change', e => handleFiles(e.target.files));

function handleFiles(files) {
    if (selectedFiles.length + files.length > maxFiles) {
        alert(`Maksimal ${maxFiles} foto. Sudah ada ${selectedFiles.length} foto.`);
        return;
    }

    Array.from(files).forEach(file => {
        if (file.type.startsWith('image/')) {
            selectedFiles.push(file);
        }
    });

    updateFileInput();
    renderPreviews();
}

function updateFileInput() {
    const dt = new DataTransfer();
    selectedFiles.forEach(file => dt.items.add(file));
    fotoInput.files = dt.files;
}

function renderPreviews() {
    previewContainer.innerHTML = '';
    if (selectedFiles.length === 0) {
        previewContainer.style.display = 'none';
        uploadPlaceholder.style.display = 'block';
        return;
    }

    previewContainer.style.display = 'grid';
    uploadPlaceholder.style.display = 'none';

    selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = e => {
            const div = document.createElement('div');
            div.className = 'preview-item';
            div.innerHTML = `
                <img src="${e.target.result}" alt="Preview ${index + 1}">
                <button type="button" class="remove-btn" onclick="removeFile(${index})">
                    <i class="fas fa-times"></i>
                </button>
            `;
            previewContainer.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
}

function removeFile(index) {
    selectedFiles.splice(index, 1);
    updateFileInput();
    renderPreviews();
}
</script>
@endsection