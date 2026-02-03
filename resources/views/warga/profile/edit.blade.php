@extends('layouts.app')

@section('content')
<div class="profile-container">
    <div class="profile-header">
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <span>/</span>
            <!-- Ganti dari route('warga.profile.update') menjadi route('warga.profile.edit') -->
            <a href="{{ route('warga.profile.edit') }}" class="btn btn-primary btn-block">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.8463 2.6543C15.6273 1.87325 16.8983 1.87325 17.6793 2.6543C18.4604 3.43535 18.4604 4.70635 17.6793 5.4874L6.41422 16.7525L2.5 17.5L3.24752 13.5858L14.5126 2.32076L14.8463 2.6543Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Edit Profile
            </a>
        </div>
        <h1>Edit Profile</h1>
        <p class="subtitle">Perbarui informasi profile Anda di bawah ini</p>
    </div>

    @if($errors->any())
    <div class="alert alert-danger">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 0C4.48 0 0 4.48 0 10C0 15.52 4.48 20 10 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 10 0ZM11 15H9V13H11V15ZM11 11H9V5H11V11Z" fill="currentColor"/>
        </svg>
        <div>
            <strong>Terjadi Kesalahan!</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <form action="{{ route('warga.profile.update') }}" method="POST" enctype="multipart/form-data" class="profile-form">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <!-- Foto Profile Section -->
            <div class="form-sidebar">
                <div class="avatar-upload-card">
                    <h3 class="card-title">Foto Profile</h3>
                    
                    <div class="avatar-preview">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" id="avatarPreview" class="current-avatar">
                        @else
                            <div class="avatar-placeholder" id="avatarPreview">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" fill="currentColor"/>
                                    <path d="M12 14C7.58172 14 4 17.5817 4 22H20C20 17.5817 16.4183 14 12 14Z" fill="currentColor"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="upload-area" id="uploadArea">
                        <div class="upload-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 4V16M12 4L8 8M12 4L16 8M4 17V19C4 20.1046 4.89543 21 6 21H18C19.1046 21 20 20.1046 20 19V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <p class="upload-text">Klik untuk upload foto</p>
                        <p class="upload-hint">PNG, JPG atau JPEG (Maks. 2MB)</p>
                        <input type="file" name="avatar" id="avatarInput" accept="image/*" style="display: none;">
                    </div>
                    @error('avatar')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 0C4.48 0 0 4.48 0 10C0 15.52 4.48 20 10 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 10 0ZM11 15H9V9H11V15ZM11 7H9V5H11V7Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <div>
                        <h4>Tips Foto Profile</h4>
                        <ul>
                            <li>Gunakan foto dengan wajah yang jelas</li>
                            <li>Resolusi minimal 400x400 pixel</li>
                            <li>Format yang didukung: JPG, PNG, JPEG</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Form Fields -->
            <div class="form-main">
                <!-- Informasi Personal -->
                <div class="form-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 10C12.7614 10 15 7.76142 15 5C15 2.23858 12.7614 0 10 0C7.23858 0 5 2.23858 5 5C5 7.76142 7.23858 10 10 10Z" fill="currentColor"/>
                                <path d="M10 12C5.58172 12 2 15.5817 2 20H18C18 15.5817 14.4183 12 10 12Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <h3>Informasi Personal</h3>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name" class="form-label">
                                Nama Lengkap <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                class="form-control @error('name') is-invalid @enderror" 
                                value="{{ old('name', Auth::user()->name) }}"
                                placeholder="Masukkan nama lengkap"
                                required
                            >
                            @error('name')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="username" class="form-label">
                                Username <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="username" 
                                name="username" 
                                class="form-control @error('username') is-invalid @enderror" 
                                value="{{ old('username', Auth::user()->username) }}"
                                placeholder="Masukkan username"
                                required
                            >
                            <small class="form-text">Username harus unik dan tanpa spasi</small>
                            @error('username')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="birth_date" class="form-label">Tanggal Lahir</label>
                            <input 
                                type="date" 
                                id="birth_date" 
                                name="birth_date" 
                                class="form-control @error('birth_date') is-invalid @enderror" 
                                value="{{ old('birth_date', Auth::user()->birth_date) }}"
                            >
                            @error('birth_date')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="gender" class="form-label">Jenis Kelamin</label>
                            <select 
                                id="gender" 
                                name="gender" 
                                class="form-control @error('gender') is-invalid @enderror"
                            >
                                <option value="">Pilih jenis kelamin</option>
                                <option value="pria" {{ old('gender', Auth::user()->gender) == 'pria' ? 'selected' : '' }}>Pria</option>
                                <option value="wanita" {{ old('gender', Auth::user()->gender) == 'wanita' ? 'selected' : '' }}>Wanita</option>
                            </select>
                            @error('gender')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea 
                            id="bio" 
                            name="bio" 
                            class="form-control @error('bio') is-invalid @enderror" 
                            rows="4"
                            placeholder="Ceritakan tentang diri Anda..."
                        >{{ old('bio', Auth::user()->bio) }}</textarea>
                        <small class="form-text">Maksimal 500 karakter</small>
                        @error('bio')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Informasi Kontak -->
                <div class="form-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 4C2 2.89543 2.89543 2 4 2H16C17.1046 2 18 2.89543 18 4V16C18 17.1046 17.1046 18 16 18H4C2.89543 18 2 17.1046 2 16V4Z" stroke="currentColor" stroke-width="2"/>
                                <path d="M2 6L10 11L18 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3>Informasi Kontak</h3>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email" class="form-label">
                                Email <span class="required">*</span>
                            </label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                value="{{ old('email', Auth::user()->email) }}"
                                placeholder="email@example.com"
                                required
                            >
                            @error('email')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input 
                                type="tel" 
                                id="phone" 
                                name="phone" 
                                class="form-control @error('phone') is-invalid @enderror" 
                                value="{{ old('phone', Auth::user()->phone) }}"
                                placeholder="+62 812-3456-7890"
                            >
                            @error('phone')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea 
                            id="address" 
                            name="address" 
                            class="form-control @error('address') is-invalid @enderror" 
                            rows="3"
                            placeholder="Masukkan alamat lengkap"
                        >{{ old('address', Auth::user()->address) }}</textarea>
                        @error('address')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="city" class="form-label">Kota</label>
                            <input 
                                type="text" 
                                id="city" 
                                name="city" 
                                class="form-control @error('city') is-invalid @enderror" 
                                value="{{ old('city', Auth::user()->city) }}"
                                placeholder="Masukkan nama kota"
                            >
                            @error('city')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="postal_code" class="form-label">Kode Pos</label>
                            <input 
                                type="text" 
                                id="postal_code" 
                                name="postal_code" 
                                class="form-control @error('postal_code') is-invalid @enderror" 
                                value="{{ old('postal_code', Auth::user()->postal_code) }}"
                                placeholder="12345"
                            >
                            @error('postal_code')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Ubah Password -->
                <div class="form-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 10V7C5 4.23858 7.23858 2 10 2C12.7614 2 15 4.23858 15 7V10M3 10H17C18.1046 10 19 10.8954 19 12V18C19 19.1046 18.1046 20 17 20H3C1.89543 20 1 19.1046 1 18V12C1 10.8954 1.89543 10 3 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3>Ubah Password</h3>
                    </div>

                    <div class="alert alert-info">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 0C4.48 0 0 4.48 0 10C0 15.52 4.48 20 10 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 10 0ZM11 15H9V9H11V15ZM11 7H9V5H11V7Z" fill="currentColor"/>
                        </svg>
                        <span>Kosongkan jika tidak ingin mengubah password</span>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="current_password" class="form-label">Password Saat Ini</label>
                            <input 
                                type="password" 
                                id="current_password" 
                                name="current_password" 
                                class="form-control @error('current_password') is-invalid @enderror"
                                placeholder="Masukkan password saat ini"
                            >
                            @error('current_password')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="new_password" class="form-label">Password Baru</label>
                            <input 
                                type="password" 
                                id="new_password" 
                                name="new_password" 
                                class="form-control @error('new_password') is-invalid @enderror"
                                placeholder="Masukkan password baru"
                            >
                            <small class="form-text">Minimal 8 karakter</small>
                            @error('new_password')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                        <input 
                            type="password" 
                            id="new_password_confirmation" 
                            name="new_password_confirmation" 
                            class="form-control"
                            placeholder="Konfirmasi password baru"
                        >
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="form-actions">
                    <a href="{{ route('warga.profile.index') }}" class="btn btn-secondary">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 10H5M5 10L10 15M5 10L10 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.25 5L7.5 13.75L3.75 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
:root {
    --primary: #2D3250;
    --primary-light: #424769;
    --accent: #7077A1;
    --accent-bright: #F6B17A;
    --bg-main: #F8F9FC;
    --bg-card: #FFFFFF;
    --text-primary: #1A1D2E;
    --text-secondary: #6B7280;
    --border: #E5E7EB;
    --success: #10B981;
    --danger: #EF4444;
    --info: #3B82F6;
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
}

.profile-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.profile-header {
    margin-bottom: 2rem;
}

.breadcrumb {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin-bottom: 0.75rem;
}

.breadcrumb a {
    color: var(--accent);
    text-decoration: none;
}

.breadcrumb span {
    margin: 0 0.5rem;
}

.profile-header h1 {
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 0.5rem;
}

.subtitle {
    color: var(--text-secondary);
    font-size: 1rem;
}

.alert {
    padding: 1rem 1.25rem;
    border-radius: 12px;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    animation: slideDown 0.4s ease-out;
}

.alert svg {
    flex-shrink: 0;
    margin-top: 0.125rem;
}

.alert-danger {
    background: #FEE2E2;
    color: var(--danger);
}

.alert-info {
    background: #DBEAFE;
    color: var(--info);
}

.alert ul {
    margin: 0.5rem 0 0 0;
    padding-left: 1.25rem;
}

.alert li {
    margin: 0.25rem 0;
}

.form-grid {
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: 2rem;
}

.form-sidebar {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.avatar-upload-card,
.info-card {
    background: var(--bg-card);
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border);
}

.card-title {
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 1.5rem;
}

.avatar-preview {
    display: flex;
    justify-content: center;
    margin-bottom: 1.5rem;
}

.current-avatar {
    width: 140px;
    height: 140px;
    border-radius: 20px;
    object-fit: cover;
    border: 4px solid var(--accent-bright);
}

.avatar-placeholder {
    width: 140px;
    height: 140px;
    border-radius: 20px;
    background: linear-gradient(135deg, var(--accent-bright), var(--accent));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.upload-area {
    border: 2px dashed var(--border);
    border-radius: 12px;
    padding: 1.5rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: var(--bg-main);
}

.upload-area:hover {
    border-color: var(--accent);
    background: white;
}

.upload-icon {
    width: 48px;
    height: 48px;
    margin: 0 auto 0.75rem;
    background: var(--accent-bright);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.upload-text {
    font-weight: 600;
    color: var(--primary);
    margin-bottom: 0.25rem;
}

.upload-hint {
    font-size: 0.875rem;
    color: var(--text-secondary);
}

.info-card {
    display: flex;
    gap: 1rem;
}

.info-icon {
    width: 40px;
    height: 40px;
    background: #DBEAFE;
    color: var(--info);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.info-card h4 {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--primary);
    margin-bottom: 0.5rem;
}

.info-card ul {
    margin: 0;
    padding-left: 1.25rem;
    font-size: 0.875rem;
    color: var(--text-secondary);
}

.info-card li {
    margin: 0.25rem 0;
}

.form-main {
    background: var(--bg-card);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border);
}

.form-section {
    margin-bottom: 2.5rem;
    padding-bottom: 2.5rem;
    border-bottom: 1px solid var(--border);
}

.form-section:last-of-type {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.section-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
}

.section-icon {
    width: 36px;
    height: 36px;
    background: var(--accent-bright);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.section-header h3 {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--primary);
    margin: 0;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-label {
    font-weight: 600;
    color: var(--text-primary);
    font-size: 0.95rem;
}

.required {
    color: var(--danger);
}

.form-control {
    padding: 0.875rem 1.125rem;
    border: 2px solid var(--border);
    border-radius: 10px;
    font-size: 1rem;
    transition: all 0.3s ease;
    font-family: inherit;
}

.form-control:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(112, 119, 161, 0.1);
}

.form-control.is-invalid {
    border-color: var(--danger);
}

textarea.form-control {
    resize: vertical;
}

.form-text {
    font-size: 0.875rem;
    color: var(--text-secondary);
}

.error-text {
    font-size: 0.875rem;
    color: var(--danger);
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    padding-top: 2rem;
    border-top: 1px solid var(--border);
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.875rem 1.75rem;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    font-size: 1rem;
}

.btn-primary {
    background: var(--accent-bright);
    color: var(--primary);
    box-shadow: 0 4px 12px rgba(246, 177, 122, 0.3);
}

.btn-primary:hover {
    background: #FFB366;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(246, 177, 122, 0.4);
}

.btn-secondary {
    background: white;
    color: var(--text-primary);
    border: 2px solid var(--border);
}

.btn-secondary:hover {
    background: var(--bg-main);
    border-color: var(--accent);
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 968px) {
    .form-grid {
        grid-template-columns: 1fr;
    }

    .form-row {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 640px) {
    .profile-container {
        padding: 1rem;
    }

    .form-main {
        padding: 1.5rem;
    }

    .form-actions {
        flex-direction: column-reverse;
    }

    .btn {
        width: 100%;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('uploadArea');
    const avatarInput = document.getElementById('avatarInput');
    const avatarPreview = document.getElementById('avatarPreview');

    // Click to upload
    uploadArea.addEventListener('click', () => avatarInput.click());

    // Drag and drop
    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = 'var(--accent-bright)';
        uploadArea.style.background = 'rgba(246, 177, 122, 0.1)';
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.style.borderColor = '';
        uploadArea.style.background = '';
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = '';
        uploadArea.style.background = '';
        
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            avatarInput.files = e.dataTransfer.files;
            previewImage(file);
        }
    });

    // File input change
    avatarInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            previewImage(file);
        }
    });

    function previewImage(file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            if (avatarPreview.tagName === 'IMG') {
                avatarPreview.src = e.target.result;
            } else {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'current-avatar';
                avatarPreview.replaceWith(img);
            }
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection