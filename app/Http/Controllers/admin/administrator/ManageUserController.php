<?php

namespace App\Http\Controllers\admin\administrator;

use App\Models\User;
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

        // AJAX response
        if ($request->ajax()) {
            return view(
                'admin.administrator.manage-user.partials.table_body',
                array_merge(compact('title', 'users', 'keywords', 'filter'), $results)
            )->render();
        }

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

        // Normal response
        return view('admin.administrator.manage-user.index', compact('title', 'users', 'totals', 'roleLabels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
