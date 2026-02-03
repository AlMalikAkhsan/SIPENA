@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    
    <!-- Page Header -->
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('warga.laporan.index') }}" class="btn btn-light me-3" style="border-radius: 12px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h2 class="fw-bold mb-1" style="color: var(--secondary-color);">Edit Laporan</h2>
            <p class="text-muted mb-0">Perbarui informasi laporan Anda</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Form Card -->
            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <form action="{{ route('warga.laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Status Badge -->
                        <div class="mb-4">
                            <span class="badge rounded-pill px-3 py-2
                                @if($laporan->status == 'menunggu') bg-warning bg-opacity-10 text-warning
                                @elseif($laporan->status == 'diproses') bg-info bg-opacity-10 text-info
                                @else bg-success bg-opacity-10 text-success
                                @endif
                            " style="font-size: 0.9rem;">
                                <i class="fas fa-circle-notch fa-spin" style="font-size: 0.7rem;"></i>
                                {{ ucfirst($laporan->status) }}
                            </span>
                            <small class="text-muted ms-2">
                                Dibuat: {{ $laporan->created_at->format('d M Y, H:i') }}
                            </small>
                        </div>

                        <!-- Judul Laporan -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold mb-2">
                                <i class="fas fa-heading text-primary me-2"></i>
                                Judul Laporan <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="judul" 
                                   class="form-control form-control-lg @error('judul') is-invalid @enderror" 
                                   value="{{ old('judul', $laporan->judul) }}"
                                   required
                                   style="border-radius: 12px; border: 2px solid #e9ecef;">
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Isi Laporan -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold mb-2">
                                <i class="fas fa-align-left text-primary me-2"></i>
                                Detail Laporan <span class="text-danger">*</span>
                            </label>
                            <textarea name="isi" 
                                      class="form-control @error('isi') is-invalid @enderror" 
                                      rows="6" 
                                      required
                                      style="border-radius: 12px; border: 2px solid #e9ecef;">{{ old('isi', $laporan->isi) }}</textarea>
                            @error('isi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Foto Saat Ini -->
                        @if($laporan->foto && file_exists(public_path('uploads/' . $laporan->foto)))
                        <div class="mb-4">
                            <label class="form-label fw-semibold mb-2">
                                <i class="fas fa-image text-primary me-2"></i>
                                Foto Saat Ini
                            </label>
                            <div class="position-relative" style="border-radius: 12px; overflow: hidden;">
                                <img src="{{ asset('uploads/' . $laporan->foto) }}" 
                                     alt="Foto Laporan" 
                                     class="img-fluid w-100"
                                     style="max-height: 400px; object-fit: cover;"
                                     id="currentImage">
                                <div class="position-absolute top-0 end-0 p-2">
                                    <button type="button" 
                                            class="btn btn-sm btn-danger"
                                            onclick="toggleDeletePhoto()"
                                            style="border-radius: 8px;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-check mt-2">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       name="delete_foto" 
                                       id="deleteFoto"
                                       value="1">
                                <label class="form-check-label text-danger" for="deleteFoto">
                                    Hapus foto ini
                                </label>
                            </div>
                        </div>
                        @endif

                        <!-- Upload Foto Baru -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold mb-2">
                                <i class="fas fa-camera text-primary me-2"></i>
                                {{ $laporan->foto ? 'Ganti Foto' : 'Upload Foto' }} <span class="text-muted">(Opsional)</span>
                            </label>
                            
                            <div class="upload-area" id="uploadArea" style="border: 2px dashed #dee2e6; border-radius: 12px; padding: 2rem; text-align: center; cursor: pointer; transition: all 0.3s ease;">
                                <input type="file" 
                                       name="foto" 
                                       id="fotoInput" 
                                       class="d-none @error('foto') is-invalid @enderror" 
                                       accept="image/*"
                                       onchange="previewImage(event)">
                                
                                <div id="uploadPlaceholder">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                    <p class="mb-2 fw-semibold">Klik untuk upload foto baru</p>
                                    <small class="text-muted">atau drag & drop file di sini</small>
                                    <p class="text-muted small mt-2 mb-0">Format: JPG, PNG, JPEG (Max: 5MB)</p>
                                </div>
                                
                                <div id="imagePreview" class="d-none">
                                    <img id="previewImg" src="" alt="Preview" style="max-width: 100%; max-height: 300px; border-radius: 12px;">
                                    <button type="button" class="btn btn-sm btn-danger mt-3" onclick="removeImage()">
                                        <i class="fas fa-trash"></i> Hapus Foto Baru
                                    </button>
                                </div>
                            </div>
                            @error('foto')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Lokasi -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold mb-2">
                                <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                Lokasi Kejadian <span class="text-muted">(Opsional)</span>
                            </label>
                            <input type="text" 
                                   name="lokasi" 
                                   class="form-control @error('lokasi') is-invalid @enderror" 
                                   value="{{ old('lokasi', $laporan->lokasi ?? '') }}"
                                   placeholder="Contoh: Jl. Sudirman No. 123, Jakarta Pusat"
                                   style="border-radius: 12px; border: 2px solid #e9ecef;">
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-success btn-lg px-5" style="border-radius: 12px;">
                                <i class="fas fa-check me-2"></i>
                                Update Laporan
                            </button>
                            <a href="{{ route('warga.laporan.index') }}" class="btn btn-outline-secondary btn-lg px-4" style="border-radius: 12px;">
                                <i class="fas fa-times me-2"></i>
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Info Card -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">
                        <i class="fas fa-info-circle text-info me-2"></i>
                        Informasi Laporan
                    </h6>
                    
                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-muted d-block mb-1">ID Laporan</small>
                        <span class="fw-semibold">#{{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    
                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-muted d-block mb-1">Status</small>
                        <span class="badge 
                            @if($laporan->status == 'menunggu') bg-warning
                            @elseif($laporan->status == 'diproses') bg-info
                            @else bg-success
                            @endif
                        ">
                            {{ ucfirst($laporan->status) }}
                        </span>
                    </div>
                    
                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-muted d-block mb-1">Dibuat</small>
                        <span class="fw-semibold">{{ $laporan->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    
                    <div class="mb-0">
                        <small class="text-muted d-block mb-1">Terakhir Diupdate</small>
                        <span class="fw-semibold">{{ $laporan->updated_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="card border-0 shadow-sm" style="border-radius: 16px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="card-body p-4 text-white">
                    <h6 class="fw-bold mb-3">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Perhatian
                    </h6>
                    <ul class="mb-0 ps-3 small">
                        <li class="mb-2">Pastikan informasi yang Anda ubah sudah benar</li>
                        <li class="mb-2">Foto lama akan terhapus jika Anda upload foto baru</li>
                        <li class="mb-0">Perubahan akan direview kembali oleh admin</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.upload-area:hover {
    border-color: var(--primary-color) !important;
    background: rgba(255, 107, 53, 0.02);
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.15);
}

.btn-success {
    background: linear-gradient(135deg, var(--success-color) 0%, #05C092 100%);
    border: none;
    transition: all 0.3s ease;
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(6, 214, 160, 0.3);
}

.card {
    transition: all 0.3s ease;
}
</style>

<script>
// Upload Area Click
document.getElementById('uploadArea').addEventListener('click', function() {
    document.getElementById('fotoInput').click();
});

// Drag and Drop
const uploadArea = document.getElementById('uploadArea');

uploadArea.addEventListener('dragover', function(e) {
    e.preventDefault();
    uploadArea.style.borderColor = 'var(--primary-color)';
    uploadArea.style.background = 'rgba(255, 107, 53, 0.05)';
});

uploadArea.addEventListener('dragleave', function(e) {
    e.preventDefault();
    uploadArea.style.borderColor = '#dee2e6';
    uploadArea.style.background = 'transparent';
});

uploadArea.addEventListener('drop', function(e) {
    e.preventDefault();
    uploadArea.style.borderColor = '#dee2e6';
    uploadArea.style.background = 'transparent';
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        document.getElementById('fotoInput').files = files;
        previewImage({ target: { files: files } });
    }
});

// Preview Image
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('uploadPlaceholder').classList.add('d-none');
            document.getElementById('imagePreview').classList.remove('d-none');
        }
        reader.readAsDataURL(file);
    }
}

// Remove New Image
function removeImage() {
    document.getElementById('fotoInput').value = '';
    document.getElementById('uploadPlaceholder').classList.remove('d-none');
    document.getElementById('imagePreview').classList.add('d-none');
}

// Toggle Delete Photo Checkbox
function toggleDeletePhoto() {
    const checkbox = document.getElementById('deleteFoto');
    checkbox.checked = !checkbox.checked;
}
</script>
@endsection