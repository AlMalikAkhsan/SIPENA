<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        // Filter by role
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Order by latest
        $users = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'username' => 'nullable|string|unique:users,username',
            'nik' => 'nullable|string|size:16|unique:users,nik',
            'no_hp' => 'nullable|string|max:20',
            'gender' => 'nullable|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'city' => 'nullable|string',
            'rt' => 'nullable|string',
            'rw' => 'nullable|string',
            'role' => 'required|in:admin,warga',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified user
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        
        // Return JSON for AJAX request
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json($user);
        }

        // Return view for normal request
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'username' => ['nullable', 'string', Rule::unique('users')->ignore($user->id)],
            'nik' => ['nullable', 'string', 'size:16', Rule::unique('users')->ignore($user->id)],
            'no_hp' => 'nullable|string|max:20',
            'gender' => 'nullable|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'city' => 'nullable|string',
            'rt' => 'nullable|string',
            'rw' => 'nullable|string',
            'role' => 'required|in:admin,warga',
        ]);

        // Update password if provided
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        // Return JSON for AJAX request
        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'User berhasil diperbarui'
            ]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified user
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting self
        if ($user->id === auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak dapat menghapus akun Anda sendiri'
            ], 403);
        }

        $user->delete();

        // Return JSON for AJAX request
        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'User berhasil dihapus'
            ]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus');
    }

    /**
     * Get user statistics
     */
    public function statistics()
    {
        $stats = [
            'total' => User::count(),
            'admin' => User::where('role', 'admin')->count(),
            'warga' => User::where('role', 'warga')->count(),
            'verified' => User::whereNotNull('email_verified_at')->count(),
            'unverified' => User::whereNull('email_verified_at')->count(),
        ];

        return response()->json($stats);
    }

    /**
     * Bulk delete users
     */
    public function bulkDelete(Request $request)
    {
        $validated = $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ]);

        // Exclude current user
        $userIds = array_filter($validated['user_ids'], function($id) {
            return $id != auth()->id();
        });

        User::whereIn('id', $userIds)->delete();

        return response()->json([
            'success' => true,
            'message' => count($userIds) . ' user berhasil dihapus'
        ]);
    }

    /**
     * Export users data
     */
    public function export(Request $request)
    {
        $users = User::all();
        
        $filename = 'users_' . date('Y-m-d_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($users) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, ['ID', 'Nama', 'Username', 'Email', 'NIK', 'No HP', 'Gender', 'Tanggal Lahir', 'Alamat', 'Kota', 'RT/RW', 'Role', 'Tanggal Daftar']);
            
            // CSV data
            foreach ($users as $user) {
                fputcsv($file, [
                    $user->id,
                    $user->name,
                    $user->username ?? '-',
                    $user->email,
                    $user->nik ?? '-',
                    $user->no_hp ?? '-',
                    $user->gender ?? '-',
                    $user->tanggal_lahir ?? '-',
                    $user->alamat ?? '-',
                    $user->city ?? '-',
                    ($user->rt && $user->rw) ? "RT {$user->rt} / RW {$user->rw}" : '-',
                    ucfirst($user->role),
                    $user->created_at->format('Y-m-d H:i:s')
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}