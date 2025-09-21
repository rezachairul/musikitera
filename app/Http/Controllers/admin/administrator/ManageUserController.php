<?php

namespace App\Http\Controllers\admin\administrator;

use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;


class ManageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title   = 'Users';
        $search  = $request->input('search', '');
        $filter  = $request->query('filter', 'all');
        $perPage = $request->query('perPage', 10); // default 10

        // Pisahkan multi keyword search
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        // Roles yg digunakan
        $roles = ['admin', 'bph', 'dpo', 'pembina'];

        // Build query untuk tiap role
        $queries = [];
        foreach ($roles as $role) {
            $queries[$role] = User::where('role', $role);

            if ($search) {
                $queries[$role]->where(function ($q) use ($keywords) {
                    foreach ($keywords as $word) {
                        $q->where(function ($q) use ($word) {
                            $q->where('name', 'like', "%{$word}%")
                            ->orWhere('email', 'like', "%{$word}%");
                        });
                    }
                });
            }
            $queries[$role]->orderBy('name');
        }

        // Ambil data sesuai filter
        $results = [];
        foreach ($roles as $role) {
            if ($filter === $role) {
                $results[$role] = $queries[$role]->get();
            } elseif ($filter === 'all') {
                $results[$role] = $queries[$role]->get();
            } else {
                $results[$role] = collect(); // kosong
            }
        }

        // Merge semua hasil
        $merged = collect([]);
        foreach ($roles as $role) {
            $merged = $merged->merge($results[$role]);
        }

        // Pagination manual
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        if ($perPage === 'all') {
            $perPage = max(1, $merged->count());
        } else {
            $perPage = max(1, (int) $perPage);
        }

        if ($merged->isEmpty()) {
            $users = new LengthAwarePaginator([], 0, $perPage, $currentPage, [
                'path'  => $request->url(),
                'query' => $request->query(),
            ]);
        } else {
            $currentItems = $merged->slice(($currentPage - 1) * $perPage, $perPage)->values();
            $total = $merged->count();

            $users = new LengthAwarePaginator($currentItems, $total, $perPage, $currentPage, [
                'path'  => $request->url(),
                'query' => $request->query(),
            ]);
        }
        // Hitung total user per role
        $totals = [
            'admin'   => User::where('role', 'admin')->count(),
            'bph'     => User::where('role', 'bph')->count(),
            'dpo'     => User::where('role', 'dpo')->count(),
            'pembina' => User::where('role', 'pembina')->count(),
        ];

        // Total keseluruhan
        $totals['all'] = array_sum($totals);

        // Label dan warna untuk tiap role
        $roleLabels = [
            'admin'   => [
                'label' => 'Administrator',
                'color' => 'bg-red-100 text-red-700 border border-red-300',
            ],
            'bph'     => [
                'label' => 'Badan Pengurus',
                'color' => 'bg-blue-100 text-blue-700 border border-blue-300',
            ],
            'dpo'     => [
                'label' => 'Dewan Pengawas',
                'color' => 'bg-green-100 text-green-700 border border-green-300',
            ],
            'pembina' => [
                'label' => 'Pembina',
                'color' => 'bg-yellow-100 text-yellow-700 border border-yellow-300',
            ],
        ];

        // AJAX response
        if ($request->ajax()) {
            return view(
                'admin.administrator.manage-user.partials.table_body',
                array_merge(compact('title', 'users', 'keywords', 'filter', 'roleLabels'), $results)
            )->render();
        }

        // Normal response
        return view('admin.administrator.manage-user.index', compact('title', 'users', 'totals', 'roleLabels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all()); // Debug: tampilkan semua data request

        // Validasi Input Data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string|in:admin,bph,dpo,pembina',
            'password' => 'required|string|min:8',
        ]);

        // Ambil nama depan dari inputan name (nama lengkap)
        $firstName = strtolower(strtok($request->name, ' '));

        $role = $request->role;

        // Buat email secara otomatis
        $email = "{$firstName}.{$role}@ukmbsm.itera.ac.id";

        // Validasi agar email juga unik
        if (User::where('email', $email)->exists()){
            return back()->withErrors(['email' => 'Email sudah digunakan. Silakan coba lagi.'])->withInput();
        }

        // Simpan user baru ke database
        User::create([
            'name' => $request->name,
            'email' => $email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('manage-user.index')->with('success', 'User berhasil ditambahkan.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all()); // Debug: tampilkan semua data request
        
        // Cari data berdasarkan ID
        $user = User::findOrFail($id);

        // Jika data tidak ditemukan, akan otomatis menampilkan 404
        if (!$user) {
            return redirect()->route('manage-user.index')->with('error', 'User tidak ditemukan.');
        }

        // Validasi Input Data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string|in:admin,bph,dpo,pembina',
            'password' => 'nullable|string|min:8',
        ]);

        // Ambil nama depan dari inputan name (nama lengkap)
        $firstName = strtolower(strtok($request->name,' '));
        $role = $request->role;

        // Buat Ulang Email secara otomatiss
        $email = "{$firstName}.{$role}@ukmbsm.itera.ac.id";

        // Validasi agar email juga unik
        if (User::where('email', $email)->exists()){
            return back()->withErrors(['email' => 'Email sudah digunakan. Silakan coba lagi.'])->withInput();
        }

        // Update data
        $user->name = $request->name;
        $user->role = $request->role;

        // Optional: Auto-generate email (kalau kamu gak ambil dari input)
        $firstName = strtolower(strtok($request->name, ' '));
        $user->email = $firstName . '.' . $request->role . '@ukmbsm.itera.ac.id';

        // Password hanya diubah kalau diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Simpan perubahan
        $user->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('manage-user.index')->with('succes', 'User Berhasil Diperbaharui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id); // Debug: tampilkan ID user yang akan dihapus

        // Cari data berdasarkan ID
        $user = User::findOrFail($id);

        // Jika data tidak ditemukan, akan otomatis menampilkan 404
        if (!$user) {
            return redirect()->route('manage-user.index')->with('error', 'User tidak ditemukan.');
        }
        // Hapus data user
        $user->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('manage-user.index')->with('success', 'User berhasil dihapus.');
    }

    /**
     * Export the specified resource from storage.
     */
    public function export(Request $request)
    {
        $role = $request->query('filter'); // admin / user_public / all
        $search = $request->query('search'); // kalau mau dipakai buat filter nama/email

        if ($role === 'all' || empty($role)) {
            $role = null;
        }

        return (new UsersExport($role, $search))->export();
    }
}
