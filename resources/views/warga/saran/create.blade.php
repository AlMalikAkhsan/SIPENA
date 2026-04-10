@extends('layouts.user')

@section('title', 'Buat Saran - Sipena')

@section('content')
<section class="page-intro">
    <div>
        <span class="page-kicker">Kirim saran</span>
        <h1 class="page-title">Sampaikan ide, usulan, atau masukan untuk lingkungan Anda.</h1>
        <p class="page-subtitle">Form saran dibuat lebih fokus ke isi usulan sehingga user bisa langsung menulis ide dengan nyaman tanpa tampilan yang ramai.</p>
    </div>
    <div class="intro-actions">
        <a href="{{ route('warga.saran.index') }}" class="button-light"><i class="fas fa-arrow-left"></i><span>Kembali</span></a>
    </div>
</section>

<form action="{{ route('warga.saran.store') }}" method="POST" class="form-shell">
    @csrf
    <div class="field-group">
        <label class="field-label">Judul saran</label>
        <input type="text" name="judul" class="field-input" value="{{ old('judul') }}" placeholder="Contoh: Penambahan tempat sampah di taman RW" required>
    </div>
    <div class="field-group mt-3">
        <label class="field-label">Isi saran</label>
        <textarea name="isi" class="field-textarea" placeholder="Tuliskan alasan, manfaat, dan gambaran singkat implementasinya." required>{{ old('isi') }}</textarea>
    </div>
    <div class="button-row mt-4">
        <a href="{{ route('warga.saran.index') }}" class="button-light">Batal</a>
        <button type="submit" class="button"><i class="fas fa-paper-plane"></i><span>Kirim saran</span></button>
    </div>
</form>
@endsection
