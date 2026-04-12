@extends('layouts.app')

@section('content')
<div class="admin-page">
    <section class="admin-header">
        <div>
            <h1>Edit User #{{ $user->id }}</h1>
            <p class="admin-subtitle">Perbarui data profil dan akses user.</p>
        </div>
        <div class="admin-actions">
            <a href="{{ route('admin.users.show', $user->id) }}" class="admin-btn admin-btn-ghost">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>
    </section>

    <section class="panel">
        <h2 class="panel-title">Form Edit User</h2>
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="admin-page">
            @csrf
            @method('PUT')

            <div class="admin-form-grid">
                <div>
                    <label class="info-label">Nama</label>
                    <input type="text" name="name" class="admin-field" value="{{ old('name', $user->name) }}" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div>
                    <label class="info-label">Email</label>
                    <input type="email" name="email" class="admin-field" value="{{ old('email', $user->email) }}" required>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div>
                    <label class="info-label">Username</label>
                    <input type="text" name="username" class="admin-field" value="{{ old('username', $user->username) }}">
                    @error('username') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div>
                    <label class="info-label">Role</label>
                    <select name="role" class="admin-select" required>
                        <option value="admin" @selected(old('role', $user->role) === 'admin')>Admin</option>
                        <option value="warga" @selected(old('role', $user->role) === 'warga')>Warga</option>
                    </select>
                    @error('role') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div>
                    <label class="info-label">NIK</label>
                    <input type="text" name="nik" class="admin-field" value="{{ old('nik', $user->nik) }}" maxlength="16">
                    @error('nik') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div>
                    <label class="info-label">No HP</label>
                    <input type="text" name="no_hp" class="admin-field" value="{{ old('no_hp', $user->no_hp) }}">
                    @error('no_hp') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div>
                    <label class="info-label">Gender</label>
                    <select name="gender" class="admin-select">
                        <option value="">- Pilih -</option>
                        <option value="Laki-laki" @selected(old('gender', $user->gender) === 'Laki-laki')>Laki-laki</option>
                        <option value="Perempuan" @selected(old('gender', $user->gender) === 'Perempuan')>Perempuan</option>
                    </select>
                    @error('gender') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div>
                    <label class="info-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="admin-field" value="{{ old('tanggal_lahir', $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('Y-m-d') : '') }}">
                    @error('tanggal_lahir') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div>
                    <label class="info-label">Kota</label>
                    <input type="text" name="city" class="admin-field" value="{{ old('city', $user->city) }}">
                    @error('city') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div>
                    <label class="info-label">RT</label>
                    <input type="text" name="rt" class="admin-field" value="{{ old('rt', $user->rt) }}">
                    @error('rt') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div>
                    <label class="info-label">RW</label>
                    <input type="text" name="rw" class="admin-field" value="{{ old('rw', $user->rw) }}">
                    @error('rw') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div>
                    <label class="info-label">Password Baru (Opsional)</label>
                    <input type="password" name="password" class="admin-field" placeholder="Isi jika ingin ganti password">
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div>
                <label class="info-label">Alamat</label>
                <textarea name="alamat" class="admin-textarea">{{ old('alamat', $user->alamat) }}</textarea>
                @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="admin-form-actions">
                <button type="submit" class="admin-btn admin-btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
                <a href="{{ route('admin.users.index') }}" class="admin-btn admin-btn-ghost">Batal</a>
            </div>
        </form>
    </section>
</div>
@endsection
