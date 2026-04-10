@extends('layouts.user')

@section('title', 'Edit Laporan - Sipena')

@section('content')
@php
    $backUrl = route('warga.laporan.show', ['laporan' => $laporan->id]);
    $returnUrl = request()->query('return');

    if (is_string($returnUrl) && $returnUrl !== '') {
        $backUrl = route('warga.laporan.show', ['laporan' => $laporan->id, 'return' => $returnUrl]);
    }
@endphp
<section class="page-intro">
    <div>
        <span class="page-kicker">Perbarui laporan</span>
        <h1 class="page-title">Edit laporan yang masih menunggu review.</h1>
        <p class="page-subtitle">Anda bisa memperjelas informasi, mengubah lokasi, menambah foto baru, atau menandai foto lama untuk dihapus sebelum laporan diproses.</p>
    </div>
    <div class="intro-actions">
        <a href="{{ $backUrl }}" class="button-light"><i class="fas fa-arrow-left"></i><span>Kembali ke detail</span></a>
    </div>
</section>

@if($errors->any())
    <section class="flash error">
        <i class="fas fa-circle-exclamation mt-1"></i>
        <div>
            <strong>Masih ada data yang perlu diperbaiki.</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </section>
@endif

<form action="{{ route('warga.laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data" class="form-shell" id="editForm">
    @csrf
    @method('PUT')
    @if(is_string($returnUrl) && $returnUrl !== '')
        <input type="hidden" name="return" value="{{ $returnUrl }}">
    @endif
    <div class="form-grid two">
        <div class="field-group">
            <label class="field-label">Judul laporan</label>
            <input type="text" name="judul" class="field-input" value="{{ old('judul', $laporan->judul) }}" required>
        </div>
        <div class="field-group">
            <label class="field-label">Lokasi</label>
            <input type="text" name="lokasi" class="field-input" value="{{ old('lokasi', $laporan->lokasi) }}">
        </div>
    </div>

    <div class="field-group mt-3">
        <label class="field-label">Isi laporan</label>
        <textarea name="isi" class="field-textarea" required>{{ old('isi', $laporan->isi) }}</textarea>
    </div>

    @if($laporan->fotos->count())
        <div class="field-group mt-4">
            <label class="field-label">Foto saat ini</label>
            <div class="upload-preview">
                @foreach($laporan->fotos as $foto)
                    <div class="media-card" data-card>
                        <img src="{{ asset('storage/' . $foto->foto_path) }}" alt="Foto laporan">
                        <button type="button" class="remove-media" data-remove="{{ $foto->id }}"><i class="fas fa-xmark"></i></button>
                        <input type="hidden" name="hapus_foto[]" value="{{ $foto->id }}" disabled data-input="{{ $foto->id }}">
                    </div>
                @endforeach
            </div>
            <span class="form-note">Klik ikon silang pada foto yang ingin dihapus.</span>
        </div>
    @endif

    <div class="field-group mt-4">
        <label class="field-label">Tambah foto baru</label>
        <label class="upload-zone" id="uploadZone">
            <input type="file" name="fotos[]" id="fotoInput" accept="image/*" multiple hidden>
            <div class="empty-icon" style="margin-bottom: 12px;"><i class="fas fa-images"></i></div>
            <strong>Tambah foto pendukung</strong>
            <p class="form-note mb-0 mt-2">Foto baru akan ditambahkan setelah foto lama yang dipilih untuk dihapus.</p>
        </label>
        <div class="upload-preview" id="previewList"></div>
    </div>

    <div class="button-row mt-4">
        <a href="{{ $backUrl }}" class="button-light">Batal</a>
        <button type="submit" class="button"><i class="fas fa-floppy-disk"></i><span>Simpan perubahan</span></button>
    </div>
</form>

<section class="panel">
    <div class="panel-header">
        <div>
            <h2 class="panel-title">Aksi tambahan</h2>
            <p class="panel-subtitle">Kalau laporan ini tidak jadi dipakai, Anda bisa menghapusnya langsung dari sini.</p>
        </div>
    </div>
    <form action="{{ route('warga.laporan.destroy', $laporan->id) }}" method="POST" onsubmit="return confirm('Hapus laporan ini secara permanen?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="button-danger"><i class="fas fa-trash"></i><span>Hapus laporan</span></button>
    </form>
</section>
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

    fotoInput?.addEventListener('change', (event) => renderPreview(event.target.files));
    uploadZone?.addEventListener('drop', (event) => {
        event.preventDefault();
        uploadZone.classList.remove('is-dragover');
        fotoInput.files = event.dataTransfer.files;
        renderPreview(event.dataTransfer.files);
    });
    ['dragenter', 'dragover'].forEach((eventName) => uploadZone?.addEventListener(eventName, (event) => {
        event.preventDefault();
        uploadZone.classList.add('is-dragover');
    }));
    ['dragleave', 'drop'].forEach((eventName) => uploadZone?.addEventListener(eventName, (event) => {
        event.preventDefault();
        uploadZone.classList.remove('is-dragover');
    }));

    document.querySelectorAll('[data-remove]').forEach((button) => {
        button.addEventListener('click', () => {
            const id = button.dataset.remove;
            const input = document.querySelector(`[data-input="${id}"]`);
            const card = button.closest('[data-card]');
            input.disabled = !input.disabled;
            card.style.opacity = input.disabled ? '1' : '0.35';
            button.innerHTML = input.disabled ? '<i class="fas fa-xmark"></i>' : '<i class="fas fa-rotate-left"></i>';
        });
    });
</script>
@endpush
