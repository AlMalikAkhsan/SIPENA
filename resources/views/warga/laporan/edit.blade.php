@extends('layouts.user')

@section('title', 'Edit Laporan - Lapor Aja!')

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

    .form-control, .form-select {
        border-radius: 12px;
        border: 1px solid rgba(129, 212, 250, 0.4);
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.25rem rgba(79, 195, 247, 0.15);
    }

    /* Galeri Foto Lama */
    .existing-photos {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .photo-item {
        position: relative;
        width: 120px;
        height: 120px;
        border-radius: 12px;
        overflow: hidden;
        border: 3px solid transparent;
        transition: all 0.3s ease;
    }

    .photo-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .photo-item:hover {
        border-color: var(--primary);
        transform: scale(1.05);
    }

    .delete-photo {
        position: absolute;
        top: 6px;
        right: 6px;
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

    .delete-photo:hover {
        background: #ef4444;
        transform: scale(1.1);
    }

    /* Upload Area */
    .upload-area {
        border: 2px dashed rgba(129, 212, 250, 0.5);
        border-radius: 16px;
        padding: 2.5rem 1.5rem;
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

    .preview-new {
        margin-top: 1.5rem;
        text-align: center;
    }

    .preview-new img {
        max-width: 100%;
        max-height: 300px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .sidebar-card {
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(129, 212, 250, 0.2);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-soft);
        padding: 1.5rem;
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
        .existing-photos { justify-content: center; }
        .photo-item { width: 100px; height: 100px; }
    }
</style>
@endpush

@section('content')
<div class="edit-container">

    <!-- Header -->
    <div class="header-section">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('warga.laporan.index') }}" class="btn btn-light rounded-circle shadow-sm p-3" style="width:48px;height:48px;display:flex;align-items:center;justify-content:center;">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="fw-bold mb-1" style="color: var(--primary-dark);">Edit Laporan</h2>
                <p class="text-muted mb-0">Perbarui informasi laporan Anda (hanya bisa jika masih menunggu)</p>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <span class="badge status-{{ $laporan->status }} px-3 py-2">
                {{ ucfirst($laporan->status) }}
            </span>
            <small class="text-muted">Dibuat: {{ $laporan->created_at->format('d M Y') }}</small>
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Form -->
        <div class="col-lg-8">
            <div class="form-card">
                <form action="{{ route('warga.laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Judul -->
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="fas fa-heading text-primary me-2"></i>Judul Laporan <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="judul" class="form-control form-control-lg @error('judul') is-invalid @enderror"
                               value="{{ old('judul', $laporan->judul) }}" required>
                        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Isi -->
                    <div class="mb-5">
                        <label class="form-label">
                            <i class="fas fa-align-left text-primary me-2"></i>Detail Laporan <span class="text-danger">*</span>
                        </label>
                        <textarea name="isi" rows="7" class="form-control @error('isi') is-invalid @enderror" required>
                            {{ old('isi', $laporan->isi) }}
                        </textarea>
                        @error('isi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="text-muted d-block mt-1">Minimal 20 karakter. Jelaskan detail agar lebih cepat ditangani</small>
                    </div>

                    <!-- Foto Lama -->
                    @if($laporan->fotos->isNotEmpty())
                        <div class="mb-5">
                            <label class="form-label">
                                <i class="fas fa-images text-primary me-2"></i>Foto Saat Ini ({{ $laporan->fotos->count() }} foto)
                            </label>
                            <div class="existing-photos">
                                @foreach($laporan->fotos as $foto)
                                    <div class="photo-item">
                                        <img src="{{ asset('storage/' . $foto->foto_path) }}" alt="Foto {{ $foto->urutan }}">
                                        <button type="button" class="delete-photo" 
                                                onclick="toggleDelete(this, {{ $foto->id }})">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <input type="hidden" name="hapus_foto[]" value="{{ $foto->id }}" class="delete-input" style="display:none;">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Upload Foto Baru -->
                    <div class="mb-5">
                        <label class="form-label">
                            <i class="fas fa-camera text-primary me-2"></i>Tambah Foto Baru <span class="text-muted">(Opsional, max 5MB/foto)</span>
                        </label>
                        <div class="upload-area" id="uploadArea">
                            <input type="file" name="fotos[]" id="fotoInput" class="d-none" accept="image/*" multiple>
                            <div id="uploadPlaceholder">
                                <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                <p class="fw-semibold mb-1">Klik atau tarik foto ke sini</p>
                                <small class="text-muted">JPG, PNG • Bisa upload beberapa sekaligus</small>
                            </div>
                            <div id="previewNew" class="preview-new d-none"></div>
                        </div>
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
                               value="{{ old('lokasi', $laporan->lokasi ?? '') }}"
                               placeholder="Contoh: RT 03 / Gang Melati No. 45">
                        @error('lokasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Submit -->
                    <div class="d-flex flex-column flex-sm-row gap-3 mt-5">
                        <button type="submit" class="btn btn-update btn-lg flex-fill">
                            <i class="fas fa-save me-2"></i> Update Laporan
                        </button>
                        <a href="{{ route('warga.laporan.index') }}" class="btn btn-outline-secondary btn-lg flex-fill">
                            <i class="fas fa-times me-2"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="sidebar-card mb-4">
                <h6 class="fw-bold mb-3" style="color: var(--primary-dark);">
                    <i class="fas fa-info-circle me-2"></i>Informasi Laporan
                </h6>
                <div class="mb-3 pb-3 border-bottom">
                    <small class="text-muted d-block mb-1">ID Laporan</small>
                    <span class="fw-semibold">#{{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="mb-3 pb-3 border-bottom">
                    <small class="text-muted d-block mb-1">Status</small>
                    <span class="badge status-{{ $laporan->status }} px-3 py-2">
                        {{ ucfirst($laporan->status) }}
                    </span>
                </div>
                <div class="mb-3 pb-3 border-bottom">
                    <small class="text-muted d-block mb-1">Dibuat</small>
                    <span class="fw-semibold">{{ $laporan->created_at->format('d M Y, H:i') }}</span>
                </div>
                <div>
                    <small class="text-muted d-block mb-1">Terakhir Diupdate</small>
                    <span class="fw-semibold">{{ $laporan->updated_at->format('d M Y, H:i') }}</span>
                </div>
            </div>

            <div class="sidebar-card">
                <h6 class="fw-bold mb-3 text-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>Perhatian
                </h6>
                <ul class="small text-muted mb-0 ps-3">
                    <li class="mb-2">Hanya bisa edit jika status masih <strong>Menunggu</strong></li>
                    <li class="mb-2">Foto lama bisa dihapus satu per satu</li>
                    <li class="mb-2">Foto baru akan ditambahkan ke daftar</li>
                    <li>Perubahan akan direview ulang oleh admin</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header bg-danger text-white border-0 rounded-top">
                <h5 class="modal-title fw-bold" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-4">
                <i class="fas fa-exclamation-triangle text-danger fa-4x mb-3"></i>
                <h5 class="fw-bold mb-3">Yakin hapus laporan ini?</h5>
                <p class="text-muted mb-4">Tindakan ini permanen dan tidak bisa dibatalkan.</p>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-4">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('warga.laporan.destroy', $laporan->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Upload & Preview Foto Baru
const uploadArea = document.getElementById('uploadArea');
const fotoInput = document.getElementById('fotoInput');
const previewNew = document.getElementById('previewNew');

uploadArea.addEventListener('click', () => fotoInput.click());

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
    fotoInput.files = e.dataTransfer.files;
    previewNewImage(e.dataTransfer.files);
});

fotoInput.addEventListener('change', e => previewNewImage(e.target.files));

function previewNewImage(files) {
    previewNew.innerHTML = '';
    previewNew.classList.remove('d-none');
    uploadArea.querySelector('#uploadPlaceholder')?.classList.add('d-none');

    Array.from(files).forEach(file => {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = e => {
                const div = document.createElement('div');
                div.style.margin = '10px auto';
                div.innerHTML = `
                    <img src="${e.target.result}" style="max-width:100%;max-height:250px;border-radius:12px;">
                    <button type="button" class="btn btn-sm btn-danger mt-2" onclick="this.parentElement.remove(); fotoInput.value='';">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                `;
                previewNew.appendChild(div);
            };
            reader.readAsDataURL(file);
        }
    });
}

// Toggle Hapus Foto Lama
function toggleDelete(btn, fotoId) {
    const input = btn.nextElementSibling;
    if (input.value) {
        input.remove();
        btn.style.background = 'rgba(239,68,68,0.9)';
    } else {
        const hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'hapus_foto[]';
        hidden.value = fotoId;
        hidden.className = 'delete-input';
        btn.parentElement.appendChild(hidden);
        btn.style.background = '#dc3545';
    }
}
</script>
@endsection