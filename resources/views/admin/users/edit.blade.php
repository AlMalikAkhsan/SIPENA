@extends('layouts.app')

@section('content')
<style>
    .edit-header {
        background: var(--card-bg);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .back-button {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: var(--light-bg);
        border: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-primary);
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .back-button:hover {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .header-title {
        display: flex;
        flex-direction: column;
    }

    .page-title-edit {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
    }

    .page-subtitle-edit {
        font-size: 0.875rem;
        color: var(--text-secondary);
    }

    .edit-card {
        background: var(--card-bg);
        border-radius: 12px;
        border: 1px solid var(--border-color);
        overflow: hidden;
    }

    .card-header-edit {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        color: white;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .user-avatar-edit {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: 700;
        border: 3px solid rgba(255, 255, 255, 0.3);
    }

    .user-info-edit h2 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .user-info-edit p {
        opacity: 0.9;
        font-size: 0.875rem;
    }

    .card-body-edit {
        padding: 2rem;
    }

    .form-section {
        margin-bottom: 2.5rem;
    }

    .form-section:last-child {
        margin-bottom: 0;
    }

    .section-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .form-grid-full {
        grid-column: 1 / -1;
    }

    .form-group-modern {
        display: flex;
        flex-direction: column;
    }

    .form-label-edit {
        font-weight: 600;
        color: var(--text-primary);
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .required-star {
        color: var(--danger-color);
    }

    .form-control-edit {
        padding: 0.875rem 1rem;
        border: 2px solid var(--border-color);
        border-radius: 10px;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        font-family: inherit;
    }

    .form-control-edit:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(0, 102, 204, 0.1);
    }

    .form-control-edit:disabled {
        background: var(--light-bg);
        cursor: not-allowed;
    }

    .input-icon {
        position: relative;
    }

    .input-icon i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-secondary);
    }

    .input-icon .form-control-edit {
        padding-left: 2.75rem;
    }

    .form-help-text {
        font-size: 0.75rem;
        color: var(--text-secondary);
        margin-top: 0.375rem;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        padding: 1.5rem 2rem;
        background: var(--light-bg);
        border-top: 1px solid var(--border-color);
    }

    .btn-modern-edit {
        padding: 0.875rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-cancel {
        background: white;
        color: var(--text-primary);
        border: 2px solid var(--border-color);
    }

    .btn-cancel:hover {
        background: var(--light-bg);
    }

    .btn-save {
        background: var(--primary-color);
        color: white;
    }

    .btn-save:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 102, 204, 0.3);
    }

    .alert-modern {
        padding: 1rem 1.25rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.875rem;
    }

    .alert-success {
        background: rgba(0, 200, 83, 0.1);
        color: var(--success-color);
        border: 1px solid rgba(0, 200, 83, 0.2);
    }

    .alert-error {
        background: rgba(255, 61, 0, 0.1);
        color: var(--danger-color);
        border: 1px solid rgba(255, 61, 0, 0.2);
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .edit-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-modern-edit {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<!-- Page Header -->
<div class="edit-header">
    <div class="header-left">
        <a href="{{ route('admin.users.index') }}" class="back-button">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div class="header-title">
            <h1 class="page-title-edit">Edit User</h1>
            <p class="page-subtitle-edit">Perbarui informasi pengguna</p>
        </div>
    </div>
</div>

<!-- Success Message -->
@if(session('success'))
<div class="alert-modern alert-success">
    <i class="fas fa-check-circle" style="font-size: 1.25rem;"></i>
    <span>{{ session('success') }}</span>
</div>
@endif

<!-- Error Messages -->
@if($errors->any())
<div class="alert-modern alert-error">
    <i class="fas fa-exclamation-circle" style="font-size: 1.25rem;"></i>
    <div>
        <strong>Terjadi kesalahan:</strong>
        <ul style="margin: 0.5rem 0 0 0; padding-left: 1.25rem;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<!-- Edit Form -->
<form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="edit-card">
        <!-- Card Header with User Avatar -->
        <div class="card-header-edit">
            <div class="user-avatar-edit">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div class="user-info-edit">
                <h2>{{ $user->name }}</h2>
                <p>{{ $user->email }}</p>
            </div>
        </div>

        <div class="card-body-edit">
            <!-- Section 1: Informasi Pribadi -->
            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <span>Informasi Pribadi</span>
                </div>

                <div class="form-grid">
                    <div class="form-group-modern">
                        <label class="form-label-edit">
                            Nama Lengkap <span class="required-star">*</span>
                        </label>
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" 
                                   class="form-control-edit" 
                                   name="name" 
                                   value="{{ old('name', $user->name) }}" 
                                   required>
                        </div>
                    </div>

                    <div class="form-group-modern">
                        <label class="form-label-edit">Username</label>
                        <div class="input-icon">
                            <i class="fas fa-at"></i>
                            <input type="text" 
                                   class="form-control-edit" 
                                   name="username" 
                                   value="{{ old('username', $user->username) }}">
                        </div>
                        <small class="form-help-text">Username unik untuk login</small>
                    </div>

                    <div class="form-group-modern">
                        <label class="form-label-edit">Gender</label>
                        <select class="form-control-edit" name="gender">
                            <option value="">Pilih Gender</option>
                            <option value="Laki-laki" {{ old('gender', $user->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('gender', $user->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group-modern">
                        <label class="form-label-edit">Tanggal Lahir</label>
                        <div class="input-icon">
                            <i class="fas fa-calendar"></i>
                            <input type="date" 
                                   class="form-control-edit" 
                                   name="tanggal_lahir" 
                                   value="{{ old('tanggal_lahir', $user->tanggal_lahir?->format('Y-m-d')) }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Kontak & Identitas -->
            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <span>Kontak & Identitas</span>
                </div>

                <div class="form-grid">
                    <div class="form-group-modern">
                        <label class="form-label-edit">
                            Email <span class="required-star">*</span>
                        </label>
                        <div class="input-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" 
                                   class="form-control-edit" 
                                   name="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   required>
                        </div>
                    </div>

                    <div class="form-group-modern">
                        <label class="form-label-edit">NIK</label>
                        <div class="input-icon">
                            <i class="fas fa-id-card"></i>
                            <input type="text" 
                                   class="form-control-edit" 
                                   name="nik" 
                                   value="{{ old('nik', $user->nik) }}" 
                                   maxlength="16"
                                   pattern="[0-9]{16}">
                        </div>
                        <small class="form-help-text">16 digit Nomor Induk Kependudukan</small>
                    </div>

                    <div class="form-group-modern">
                        <label class="form-label-edit">No. HP</label>
                        <div class="input-icon">
                            <i class="fas fa-phone"></i>
                            <input type="tel" 
                                   class="form-control-edit" 
                                   name="no_hp" 
                                   value="{{ old('no_hp', $user->no_hp) }}">
                        </div>
                    </div>

                    <div class="form-group-modern">
                        <label class="form-label-edit">Password Baru</label>
                        <div class="input-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" 
                                   class="form-control-edit" 
                                   name="password">
                        </div>
                        <small class="form-help-text">Kosongkan jika tidak ingin mengubah password</small>
                    </div>
                </div>
            </div>

            <!-- Section 3: Alamat -->
            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <span>Alamat Lengkap</span>
                </div>

                <div class="form-grid">
                    <div class="form-group-modern form-grid-full">
                        <label class="form-label-edit">Alamat Lengkap</label>
                        <textarea class="form-control-edit" 
                                  name="alamat" 
                                  rows="3">{{ old('alamat', $user->alamat) }}</textarea>
                    </div>

                    <div class="form-group-modern">
                        <label class="form-label-edit">Kota</label>
                        <div class="input-icon">
                            <i class="fas fa-city"></i>
                            <input type="text" 
                                   class="form-control-edit" 
                                   name="city" 
                                   value="{{ old('city', $user->city) }}">
                        </div>
                    </div>

                    <div class="form-group-modern">
                        <label class="form-label-edit">Kode Pos</label>
                        <div class="input-icon">
                            <i class="fas fa-mail-bulk"></i>
                            <input type="text" 
                                   class="form-control-edit" 
                                   name="postal_code" 
                                   value="{{ old('postal_code', $user->postal_code) }}">
                        </div>
                    </div>

                    <div class="form-group-modern">
                        <label class="form-label-edit">RT</label>
                        <input type="text" 
                               class="form-control-edit" 
                               name="rt" 
                               value="{{ old('rt', $user->rt) }}">
                    </div>

                    <div class="form-group-modern">
                        <label class="form-label-edit">RW</label>
                        <input type="text" 
                               class="form-control-edit" 
                               name="rw" 
                               value="{{ old('rw', $user->rw) }}">
                    </div>
                </div>
            </div>

            <!-- Section 4: Sistem -->
            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">
                        <i class="fas fa-cog"></i>
                    </div>
                    <span>Pengaturan Sistem</span>
                </div>

                <div class="form-grid">
                    <div class="form-group-modern">
                        <label class="form-label-edit">
                            Role <span class="required-star">*</span>
                        </label>
                        <select class="form-control-edit" name="role" required>
                            <option value="warga" {{ old('role', $user->role) == 'warga' ? 'selected' : '' }}>Warga</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <div class="form-group-modern">
                        <label class="form-label-edit">Status Email</label>
                        <input type="text" 
                               class="form-control-edit" 
                               value="{{ $user->email_verified_at ? 'Verified' : 'Not Verified' }}" 
                               disabled>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <a href="{{ route('admin.users.index') }}" class="btn-modern-edit btn-cancel">
                <i class="fas fa-times"></i>
                <span>Batal</span>
            </a>
            <button type="submit" class="btn-modern-edit btn-save">
                <i class="fas fa-save"></i>
                <span>Simpan Perubahan</span>
            </button>
        </div>
    </div>
</form>

@endsection