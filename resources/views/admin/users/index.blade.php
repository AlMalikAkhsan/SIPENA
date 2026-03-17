@extends('layouts.app')

@section('content')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--card-bg);
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
    }

    .stat-icon.primary {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
    }

    .stat-icon.success {
        background: linear-gradient(135deg, #00C853, #00E676);
    }

    .stat-icon.warning {
        background: linear-gradient(135deg, #FFB300, #FFC107);
    }

    .stat-icon.info {
        background: linear-gradient(135deg, #00B8D4, #00E5FF);
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.875rem;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    .search-filter-bar {
        background: var(--card-bg);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid var(--border-color);
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        align-items: center;
    }

    .search-box {
        flex: 1;
        min-width: 300px;
        position: relative;
    }

    .search-box input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.75rem;
        border: 2px solid var(--border-color);
        border-radius: 10px;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }

    .search-box input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-secondary);
        font-size: 1rem;
    }

    .filter-select {
        padding: 0.75rem 1rem;
        border: 2px solid var(--border-color);
        border-radius: 10px;
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--text-primary);
        background: white;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .filter-select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
    }

    .users-table-card {
        background: var(--card-bg);
        border-radius: 12px;
        border: 1px solid var(--border-color);
        overflow: hidden;
    }

    .table-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    .table-responsive {
        overflow-x: auto;
    }

    .users-table {
        width: 100%;
        border-collapse: collapse;
    }

    .users-table thead {
        background: var(--light-bg);
    }

    .users-table th {
        padding: 1rem 1.5rem;
        text-align: left;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-secondary);
        border-bottom: 2px solid var(--border-color);
    }

    .users-table td {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
        color: var(--text-primary);
        font-size: 0.875rem;
    }

    .users-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .users-table tbody tr:hover {
        background: var(--light-bg);
    }

    .user-cell {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .user-avatar-table {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.875rem;
        flex-shrink: 0;
    }

    .user-details-table {
        display: flex;
        flex-direction: column;
    }

    .user-name-table {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.125rem;
    }

    .user-email-table {
        font-size: 0.75rem;
        color: var(--text-secondary);
    }

    .badge-role {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.375rem 0.75rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .badge-role.admin {
        background: rgba(255, 61, 0, 0.1);
        color: var(--danger-color);
    }

    .badge-role.warga {
        background: rgba(0, 102, 204, 0.1);
        color: var(--primary-color);
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-action {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 0.875rem;
    }

    .btn-view {
        background: rgba(0, 102, 204, 0.1);
        color: var(--primary-color);
    }

    .btn-view:hover {
        background: var(--primary-color);
        color: white;
    }

    .btn-edit {
        background: rgba(0, 200, 83, 0.1);
        color: var(--success-color);
    }

    .btn-edit:hover {
        background: var(--success-color);
        color: white;
    }

    .btn-delete {
        background: rgba(255, 61, 0, 0.1);
        color: var(--danger-color);
    }

    .btn-delete:hover {
        background: var(--danger-color);
        color: white;
    }

    /* Modal Styles */
    .modal-modern .modal-content {
        border-radius: 16px;
        border: none;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .modal-modern .modal-header {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        color: white;
        border-radius: 16px 16px 0 0;
        padding: 1.5rem;
        border: none;
    }

    .modal-modern .modal-title {
        font-weight: 700;
        font-size: 1.25rem;
    }

    .modal-modern .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.8;
    }

    .modal-modern .btn-close:hover {
        opacity: 1;
    }

    .modal-modern .modal-body {
        padding: 2rem;
        max-height: 70vh;
        overflow-y: auto;
    }

    .modal-modern .modal-footer {
        border-top: 1px solid var(--border-color);
        padding: 1.25rem 1.5rem;
        background: var(--light-bg);
    }

    .detail-row {
        display: flex;
        padding: 1rem 0;
        border-bottom: 1px solid var(--border-color);
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        flex: 0 0 180px;
        font-weight: 600;
        color: var(--text-secondary);
        font-size: 0.875rem;
    }

    .detail-value {
        flex: 1;
        color: var(--text-primary);
        font-size: 0.875rem;
    }

    .form-label-modern {
        font-weight: 600;
        color: var(--text-primary);
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }

    .form-control-modern {
        padding: 0.75rem 1rem;
        border: 2px solid var(--border-color);
        border-radius: 10px;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }

    .form-control-modern:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
    }

    .no-data {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--text-secondary);
    }

    .no-data-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.3;
    }

    .no-data-text {
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .no-data-subtext {
        font-size: 0.875rem;
    }

    .pagination-modern {
        display: flex;
        justify-content: center;
        padding: 1.5rem;
        gap: 0.5rem;
    }

    .page-link-modern {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        border: 1px solid var(--border-color);
        color: var(--text-primary);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }

    .page-link-modern:hover {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .page-link-modern.active {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-users me-2"></i>Manajemen User
    </h1>
    <p class="page-subtitle">Kelola semua akun pengguna dalam sistem</p>
</div>

<!-- Statistics Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-number" id="totalUsers">{{ $users->total() }}</div>
                <div class="stat-label">Total User</div>
            </div>
            <div class="stat-icon primary">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-number" id="wargaUsers">{{ $users->where('role', 'warga')->count() }}</div>
                <div class="stat-label">Warga</div>
            </div>
            <div class="stat-icon success">
                <i class="fas fa-user"></i>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-number" id="adminUsers">{{ $users->where('role', 'admin')->count() }}</div>
                <div class="stat-label">Admin</div>
            </div>
            <div class="stat-icon warning">
                <i class="fas fa-user-shield"></i>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-number" id="verifiedUsers">{{ $users->whereNotNull('email_verified_at')->count() }}</div>
                <div class="stat-label">Email Verified</div>
            </div>
            <div class="stat-icon info">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter Bar -->
<div class="search-filter-bar">
    <div class="search-box">
        <i class="fas fa-search search-icon"></i>
        <input type="text" id="searchInput" placeholder="Cari berdasarkan nama, email, NIK, atau no HP...">
    </div>
    
    <select class="filter-select" id="roleFilter">
        <option value="">Semua Role</option>
        <option value="admin">Admin</option>
        <option value="warga">Warga</option>
    </select>
</div>

<!-- Users Table -->
<div class="users-table-card">
    <div class="table-header">
        <h3 class="table-title">Daftar User</h3>
    </div>

    <div class="table-responsive">
        <table class="users-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>NIK</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Role</th>
                    <th>Bergabung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="usersTableBody">
                @forelse($users as $user)
                <tr data-user-id="{{ $user->id }}">
                    <td>
                        <div class="user-cell">
                            <div class="user-avatar-table">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div class="user-details-table">
                                <div class="user-name-table">{{ $user->name }}</div>
                                <div class="user-email-table">{{ $user->email }}</div>
                                @if($user->username)
                                <div class="user-email-table">@{{ $user->username }}</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>{{ $user->nik ?? '-' }}</td>
                    <td>{{ $user->no_hp ?? '-' }}</td>
                    <td>
                        @if($user->city || $user->rt || $user->rw)
                            {{ $user->city ?? '' }}
                            @if($user->rt && $user->rw)
                                <br><small class="text-muted">RT {{ $user->rt }} / RW {{ $user->rw }}</small>
                            @endif
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <span class="badge-role {{ $user->role }}">
                            <i class="fas fa-{{ $user->role == 'admin' ? 'shield-alt' : 'user' }}"></i>
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn-action btn-view" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-action btn-edit" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn-action btn-delete" onclick="deleteUser({{ $user->id }})" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="no-data">
                            <div class="no-data-icon">
                                <i class="fas fa-users-slash"></i>
                            </div>
                            <div class="no-data-text">Tidak ada data user</div>
                            <div class="no-data-subtext">Belum ada user yang terdaftar dalam sistem</div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
    <div class="pagination-modern">
        {{ $users->links() }}
    </div>
    @endif
</div>

<!-- Modal Add User -->
<div class="modal fade modal-modern" id="addUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-user-plus me-2"></i>Tambah User Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="mb-3">
                            <label class="form-label-modern">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-modern" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-modern">Username</label>
                            <input type="text" class="form-control form-control-modern" name="username">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="mb-3">
                            <label class="form-label-modern">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control form-control-modern" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-modern">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control form-control-modern" name="password" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="mb-3">
                            <label class="form-label-modern">NIK (16 digit)</label>
                            <input type="text" class="form-control form-control-modern" name="nik" maxlength="16">
                        </div>
                        <div class="mb-3">
                            <label class="form-label-modern">No. HP</label>
                            <input type="tel" class="form-control form-control-modern" name="no_hp">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="mb-3">
                            <label class="form-label-modern">Gender</label>
                            <select class="form-control form-control-modern" name="gender">
                                <option value="">Pilih Gender</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-modern">Tanggal Lahir</label>
                            <input type="date" class="form-control form-control-modern" name="tanggal_lahir">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="mb-3">
                            <label class="form-label-modern">Kota</label>
                            <input type="text" class="form-control form-control-modern" name="city">
                        </div>
                        <div class="mb-3">
                            <label class="form-label-modern">RT / RW</label>
                            <div class="d-flex gap-2">
                                <input type="text" class="form-control form-control-modern" name="rt" placeholder="RT">
                                <input type="text" class="form-control form-control-modern" name="rw" placeholder="RW">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-modern">Alamat Lengkap</label>
                        <textarea class="form-control form-control-modern" name="alamat" rows="2"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-modern">Role <span class="text-danger">*</span></label>
                        <select class="form-control form-control-modern" name="role" required>
                            <option value="warga">Warga</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary-modern">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Search functionality
document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('#usersTableBody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});

// Role filter
document.getElementById('roleFilter').addEventListener('change', function(e) {
    const role = e.target.value;
    const rows = document.querySelectorAll('#usersTableBody tr');
    
    rows.forEach(row => {
        if (!role) {
            row.style.display = '';
        } else {
            const badge = row.querySelector('.badge-role');
            if (badge) {
                const userRole = badge.textContent.toLowerCase().trim();
                row.style.display = userRole === role ? '' : 'none';
            }
        }
    });
});

// Delete user
function deleteUser(userId) {
    if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
        fetch(`/admin/users/${userId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Gagal menghapus user');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus user');
        });
    }
}
</script>

@endsection