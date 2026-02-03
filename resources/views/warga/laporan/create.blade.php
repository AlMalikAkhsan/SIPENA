@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    
    <!-- Page Header -->
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('warga.laporan.index') }}" class="btn btn-light me-3" style="border-radius: 12px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h2 class="fw-bold mb-1" style="color: var(--secondary-color);">Buat Laporan Baru</h2>
            <p class="text-muted mb-0">Laporkan keluhan atau aspirasi Anda kepada pemerintah</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Form Card -->
            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <form action="{{ route('warga.laporan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Judul Laporan -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold mb-2">
                                <i class="fas fa-heading text-primary me-2"></i>
                                Judul Laporan <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="judul" 
                                   class="form-control form-control-lg @error('judul') is-invalid @enderror" 
                                   placeholder="Contoh: Jalan Rusak di Depan Pasar"
                                   value="{{ old('judul') }}"
                                   required
                                   style="border-radius: 12px; border: 2px solid #e9ecef;">
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Berikan judul yang jelas dan singkat</small>
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
                                      placeholder="Jelaskan detail laporan Anda secara lengkap..."
                                      required
                                      style="border-radius: 12px; border: 2px solid #e9ecef;">{{ old('isi') }}</textarea>
                            @error('isi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Minimal 20 karakter. Jelaskan masalah dengan detail.</small>
                        </div>

                        <!-- Upload Multiple Foto -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold mb-2">
                                <i class="fas fa-camera text-primary me-2"></i>
                                Foto Pendukung <span class="text-muted">(Opsional, Max 5 foto)</span>
                            </label>
                            
                            <div class="upload-area" id="uploadArea" style="border: 2px dashed #dee2e6; border-radius: 12px; padding: 2rem; text-align: center; cursor: pointer; transition: all 0.3s ease;">
                                <input type="file" 
                                       name="fotos[]" 
                                       id="fotoInput" 
                                       class="d-none" 
                                       accept="image/*"
                                       multiple
                                       onchange="handleFiles(this.files)">
                                
                                <div id="uploadPlaceholder">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                    <p class="mb-2 fw-semibold">Klik atau drag & drop untuk upload foto</p>
                                    <small class="text-muted">Anda bisa upload hingga 5 foto sekaligus</small>
                                    <p class="text-muted small mt-2 mb-0">Format: JPG, PNG, JPEG (Max: 5MB per foto)</p>
                                </div>
                            </div>

                            <!-- Preview Container -->
                            <div id="previewContainer" class="row g-3 mt-3" style="display: none;"></div>

                            @error('fotos.*')
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
                                   placeholder="Contoh: Jl. Sudirman No. 123, Jakarta Pusat"
                                   value="{{ old('lokasi') }}"
                                   style="border-radius: 12px; border: 2px solid #e9ecef;">
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Sebutkan lokasi spesifik kejadian</small>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-primary btn-lg px-5" style="border-radius: 12px; background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%); border: none;">
                                <i class="fas fa-paper-plane me-2"></i>
                                Kirim Laporan
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

        <!-- Sidebar Info -->
        <div class="col-lg-4">
            <!-- Tips Card -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body p-4 text-white">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-lightbulb me-2"></i>
                        Tips Membuat Laporan
                    </h5>
                    <ul class="mb-0 ps-3">
                        <li class="mb-2">Gunakan judul yang jelas dan ringkas</li>
                        <li class="mb-2">Jelaskan kronologi secara detail</li>
                        <li class="mb-2">Lampirkan foto dari berbagai sudut</li>
                        <li class="mb-2">Upload hingga 5 foto pendukung</li>
                        <li class="mb-2">Cantumkan lokasi yang spesifik</li>
                        <li class="mb-0">Gunakan bahasa yang sopan</li>
                    </ul>
                </div>
            </div>

            <!-- Status Info -->
            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">
                        <i class="fas fa-info-circle text-info me-2"></i>
                        Informasi Penting
                    </h6>
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-warning bg-opacity-10 p-2 rounded-3 me-3">
                            <i class="fas fa-clock text-warning"></i>
                        </div>
                        <div>
                            <small class="fw-semibold d-block">Waktu Proses</small>
                            <small class="text-muted">1-3 hari kerja</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-info bg-opacity-10 p-2 rounded-3 me-3">
                            <i class="fas fa-bell text-info"></i>
                        </div>
                        <div>
                            <small class="fw-semibold d-block">Notifikasi</small>
                            <small class="text-muted">Anda akan mendapat update via email</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-start">
                        <div class="bg-success bg-opacity-10 p-2 rounded-3 me-3">
                            <i class="fas fa-check-circle text-success"></i>
                        </div>
                        <div>
                            <small class="fw-semibold d-block">Transparansi</small>
                            <small class="text-muted">Laporan dapat dilihat publik</small>
                        </div>
                    </div>
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

.preview-item {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    height: 200px;
}

.preview-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.preview-item .remove-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(220, 53, 69, 0.9);
    color: white;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.preview-item .remove-btn:hover {
    background: #dc3545;
    transform: scale(1.1);
}

.preview-item .file-number {
    position: absolute;
    bottom: 10px;
    left: 10px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
}
</style>

<script>
let selectedFiles = [];
const maxFiles = 5;

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
    handleFiles(files);
});

// Handle Multiple Files
function handleFiles(files) {
    if (selectedFiles.length + files.length > maxFiles) {
        alert(`Maksimal ${maxFiles} foto. Anda sudah memilih ${selectedFiles.length} foto.`);
        return;
    }

    for (let file of files) {
        if (file.type.startsWith('image/')) {
            selectedFiles.push(file);
        }
    }

    updateFileInput();
    displayPreviews();
}

// Update File Input
function updateFileInput() {
    const dataTransfer = new DataTransfer();
    selectedFiles.forEach(file => {
        dataTransfer.items.add(file);
    });
    document.getElementById('fotoInput').files = dataTransfer.files;
}

// Display Previews
function displayPreviews() {
    const container = document.getElementById('previewContainer');
    const placeholder = document.getElementById('uploadPlaceholder');
    
    if (selectedFiles.length === 0) {
        container.style.display = 'none';
        placeholder.style.display = 'block';
        return;
    }

    container.style.display = 'flex';
    placeholder.style.display = 'none';
    container.innerHTML = '';

    selectedFiles.forEach((file, index) => {
        const col = document.createElement('div');
        col.className = 'col-md-4 col-sm-6';
        
        const reader = new FileReader();
        reader.onload = function(e) {
            col.innerHTML = `
                <div class="preview-item">
                    <img src="${e.target.result}" alt="Preview ${index + 1}">
                    <button type="button" class="remove-btn" onclick="removeFile(${index})">
                        <i class="fas fa-times"></i>
                    </button>
                    <span class="file-number">Foto ${index + 1}</span>
                </div>
            `;
        };
        reader.readAsDataURL(file);
        
        container.appendChild(col);
    });
}

// Remove File
function removeFile(index) {
    selectedFiles.splice(index, 1);
    updateFileInput();
    displayPreviews();
}
</script>
@endsection