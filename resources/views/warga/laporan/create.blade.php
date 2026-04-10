@extends('layouts.user')

@section('title', 'Buat Laporan - Sipena')

@section('content')
<section class="page-intro">
    <div>
        <span class="page-kicker">Form laporan warga</span>
        <h1 class="page-title">Buat laporan baru dengan alur yang lebih simpel.</h1>
        <p class="page-subtitle">Isi kejadian, lokasi, dan unggah foto pendukung. Tampilan form sekarang dibuat lebih bersih supaya nyaman dipakai di desktop maupun ponsel.</p>
    </div>
    <div class="intro-actions">
        <a href="{{ route('warga.laporan.index') }}" class="button-light"><i class="fas fa-arrow-left"></i><span>Kembali</span></a>
    </div>
</section>

@if($errors->any())
    <section class="flash error">
        <i class="fas fa-circle-exclamation mt-1"></i>
        <div>
            <strong>Periksa lagi data laporan Anda.</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </section>
@endif

<form action="{{ route('warga.laporan.store') }}" method="POST" enctype="multipart/form-data" class="form-shell">
    @csrf
    <div class="panel-header">
        <div>
            <h2 class="panel-title">Detail laporan</h2>
            <p class="panel-subtitle">Semakin jelas isi dan foto yang Anda kirim, semakin cepat laporan dapat diproses.</p>
        </div>
    </div>

    <div class="form-grid two">
        <div class="field-group">
            <label class="field-label">Judul laporan</label>
            <input type="text" name="judul" class="field-input" value="{{ old('judul') }}" placeholder="Contoh: Lampu jalan mati di gang melati" required>
        </div>
        <div class="field-group">
            <label class="field-label">Lokasi</label>
            <input type="text" name="lokasi" class="field-input" value="{{ old('lokasi') }}" placeholder="Contoh: RT 03 / Gang Melati No. 4">
        </div>
    </div>

    <div class="field-group mt-3">
        <label class="field-label">Isi laporan</label>
        <textarea name="isi" class="field-textarea" placeholder="Jelaskan apa yang terjadi, kapan, di mana, serta dampaknya bagi warga." required>{{ old('isi') }}</textarea>
        <span class="form-note">Minimal 20 karakter agar laporan cukup informatif.</span>
    </div>

    <div class="field-group mt-4">
        <label class="field-label">Foto pendukung</label>
        <label class="upload-zone" id="uploadZone">
            <input type="file" name="fotos[]" id="fotoInput" accept="image/*" multiple hidden>
            <div class="empty-icon" style="margin-bottom: 12px;"><i class="fas fa-cloud-arrow-up"></i></div>
            <strong>Tarik foto ke sini atau klik untuk pilih file</strong>
            <p class="form-note mb-0 mt-2">Bisa upload beberapa foto sekaligus. Format JPG, JPEG, PNG. Maksimal 5MB per foto.</p>
        </label>
        <div class="upload-preview" id="previewList"></div>
    </div>

    <div class="button-row mt-4">
        <a href="{{ route('warga.laporan.index') }}" class="button-light">Batal</a>
        <button type="submit" class="button"><i class="fas fa-paper-plane"></i><span>Kirim laporan</span></button>
    </div>
</form>
@endsection

@push('scripts')
<script>
    const uploadZone = document.getElementById('uploadZone');
    const fotoInput = document.getElementById('fotoInput');
    const previewList = document.getElementById('previewList');

    function renderPreview(files) {
        previewList.innerHTML = '';
        Array.from(files).forEach((file) => {
            if (!file.type.startsWith('image/')) return;
            const reader = new FileReader();
            reader.onload = (event) => {
                const card = document.createElement('div');
                card.className = 'preview-card';
                card.innerHTML = `<img src="${event.target.result}" alt="${file.name}">`;
                previewList.appendChild(card);
            };
            reader.readAsDataURL(file);
        });
    }

    fotoInput.addEventListener('change', (event) => renderPreview(event.target.files));
    ['dragenter', 'dragover'].forEach((eventName) => uploadZone.addEventListener(eventName, (event) => {
        event.preventDefault();
        uploadZone.classList.add('is-dragover');
    }));
    ['dragleave', 'drop'].forEach((eventName) => uploadZone.addEventListener(eventName, (event) => {
        event.preventDefault();
        uploadZone.classList.remove('is-dragover');
    }));
    uploadZone.addEventListener('drop', (event) => {
        fotoInput.files = event.dataTransfer.files;
        renderPreview(event.dataTransfer.files);
    });
</script>
@endpush
