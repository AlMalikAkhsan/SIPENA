@extends('layouts.user')

@section('title', 'Edit Saran - Sipena')

@section('content')
<section class="page-intro">
    <div>
        <span class="page-kicker">Edit saran</span>
        <h1 class="page-title">Perbarui saran sebelum admin memberi tanggapan.</h1>
        <p class="page-subtitle">Begitu saran sudah ditanggapi, aksi edit dan hapus akan terkunci. Selama belum ada tanggapan, Anda masih bisa memperjelas isi usulan dari halaman ini.</p>
    </div>
    <div class="intro-actions">
        <a href="{{ route('warga.saran.show', $saran->id) }}" class="button-light"><i class="fas fa-arrow-left"></i><span>Kembali ke detail</span></a>
    </div>
</section>

<form action="{{ route('warga.saran.update', $saran->id) }}" method="POST" class="form-shell">
    @csrf
    @method('PUT')
    <div class="field-group">
        <label class="field-label">Judul saran</label>
        <input type="text" name="judul" class="field-input" value="{{ old('judul', $saran->judul) }}" required>
    </div>
    <div class="field-group mt-3">
        <label class="field-label">Isi saran</label>
        <textarea name="isi" class="field-textarea" required>{{ old('isi', $saran->isi) }}</textarea>
    </div>
    <div class="button-row mt-4">
        <a href="{{ route('warga.saran.show', $saran->id) }}" class="button-light">Batal</a>
        <button type="submit" class="button"><i class="fas fa-floppy-disk"></i><span>Simpan perubahan</span></button>
    </div>
</form>
@endsection
