@extends('layouts.user')

@section('title', 'Edit Profil - Sipena')

@section('content')
@php $user = auth()->user(); @endphp

<section class="page-intro">
    <div>
        <span class="page-kicker">Edit profil</span>
        <h1 class="page-title">Perbarui identitas akun warga Anda.</h1>
        <p class="page-subtitle">Seluruh field profil dirapikan dalam satu form yang lebih modern. Foto profil, info personal, kontak, dan penggantian password kini lebih enak dipindai user.</p>
    </div>
    <div class="intro-actions">
        <a href="{{ route('warga.profile') }}" class="button-light"><i class="fas fa-arrow-left"></i><span>Kembali</span></a>
    </div>
</section>

@if($errors->any())
    <section class="flash error">
        <i class="fas fa-circle-exclamation mt-1"></i>
        <div>
            <strong>Masih ada data yang perlu diperiksa.</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </section>
@endif

<form action="{{ route('warga.profile.update') }}" method="POST" enctype="multipart/form-data" class="form-shell">
    @csrf
    @method('PUT')

    <div class="grid-two">
        <div class="timeline-card">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Foto profil</h2>
                    <p class="panel-subtitle">Unggah foto baru jika diperlukan.</p>
                </div>
            </div>
            <div class="mini-author">
                <div class="avatar-badge" id="avatarPreview" style="width: 88px; height: 88px; border-radius: 26px;">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}">
                    @else
                        {{ strtoupper(substr($user->name ?? 'W', 0, 1)) }}
                    @endif
                </div>
                <div>
                    <strong>{{ $user->name }}</strong>
                    <div class="meta-text">PNG, JPG, JPEG maksimal 2MB.</div>
                </div>
            </div>
            <label class="upload-zone mt-4">
                <input type="file" name="avatar" id="avatarInput" accept="image/*" hidden>
                <strong><i class="fas fa-camera me-2"></i>Pilih foto profil</strong>
            </label>
        </div>

        <div class="detail-card">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Informasi personal</h2>
                    <p class="panel-subtitle">Perbarui data dasar yang tampil pada akun warga.</p>
                </div>
            </div>
            <div class="form-grid two">
                <div class="field-group"><label class="field-label">Nama lengkap</label><input type="text" name="name" class="field-input" value="{{ old('name', $user->name) }}" required></div>
                <div class="field-group"><label class="field-label">Username</label><input type="text" name="username" class="field-input" value="{{ old('username', $user->username) }}"></div>
                <div class="field-group"><label class="field-label">NIK</label><input type="text" name="nik" class="field-input" value="{{ old('nik', $user->nik) }}"></div>
                <div class="field-group"><label class="field-label">Tanggal lahir</label><input type="date" name="tanggal_lahir" class="field-input" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}"></div>
                <div class="field-group"><label class="field-label">Jenis kelamin</label>
                    <select name="gender" class="field-select">
                        <option value="">Pilih jenis kelamin</option>
                        <option value="Laki-laki" @selected(old('gender', $user->gender) === 'Laki-laki')>Laki-laki</option>
                        <option value="Perempuan" @selected(old('gender', $user->gender) === 'Perempuan')>Perempuan</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="detail-card mt-4">
        <div class="panel-header">
            <div>
                <h2 class="panel-title">Kontak dan wilayah</h2>
                <p class="panel-subtitle">Data ini membantu pengurus mengenali area pelaporan Anda.</p>
            </div>
        </div>
        <div class="form-grid two">
            <div class="field-group"><label class="field-label">Email</label><input type="email" name="email" class="field-input" value="{{ old('email', $user->email) }}" required></div>
            <div class="field-group"><label class="field-label">Nomor HP</label><input type="text" name="no_hp" class="field-input" value="{{ old('no_hp', $user->no_hp) }}"></div>
            <div class="field-group"><label class="field-label">RT</label><input type="text" name="rt" class="field-input" value="{{ old('rt', $user->rt) }}"></div>
            <div class="field-group"><label class="field-label">RW</label><input type="text" name="rw" class="field-input" value="{{ old('rw', $user->rw) }}"></div>
        </div>
        <div class="field-group mt-3">
            <label class="field-label">Alamat</label>
            <textarea name="alamat" class="field-textarea">{{ old('alamat', $user->alamat) }}</textarea>
        </div>
    </div>

    <div class="detail-card mt-4">
        <div class="panel-header">
            <div>
                <h2 class="panel-title">Ubah password</h2>
                <p class="panel-subtitle">Kosongkan semua field password jika tidak ingin mengubahnya.</p>
            </div>
        </div>
        <div class="form-grid two">
            <div class="field-group"><label class="field-label">Password saat ini</label><input type="password" name="current_password" class="field-input"></div>
            <div class="field-group"><label class="field-label">Password baru</label><input type="password" name="new_password" class="field-input"></div>
            <div class="field-group"><label class="field-label">Konfirmasi password baru</label><input type="password" name="new_password_confirmation" class="field-input"></div>
        </div>
    </div>

    <div class="button-row mt-4">
        <a href="{{ route('warga.profile') }}" class="button-light">Batal</a>
        <button type="submit" class="button"><i class="fas fa-floppy-disk"></i><span>Simpan profil</span></button>
    </div>
</form>
@endsection

@push('scripts')
<script>
    document.getElementById('avatarInput')?.addEventListener('change', (event) => {
        const file = event.target.files?.[0];
        if (!file || !file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = (e) => {
            const preview = document.getElementById('avatarPreview');
            preview.innerHTML = `<img src="${e.target.result}" alt="Avatar preview">`;
        };
        reader.readAsDataURL(file);
    });
</script>
@endpush
