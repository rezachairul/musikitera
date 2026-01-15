<?php

namespace App\Http\Controllers\admin\administrator;

use App\Models\admin\administrator\AdminManageDPO;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminManageDPOController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Position DPO Management';
        $description = 'Manage DPO accounts within the UKMBSM ITERA Administrator Panel. Add, edit, and delete DPO accounts to maintain secure access to the music community management system.';
        $author = 'UKMBSM ITERA';

        $search  = $request->input('search', '');
        $filter  = $request->query('filter', 'all');
        $perPage = $request->query('perPage', '10');

        $query = AdminManageDPO::query();

        
        // SEARCH (multi keyword)
        if ($search) {
            $keywords = preg_split('/\s+/', $search);
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where('nama', 'like', "%{$word}%");
                }
            });
        }

        // FILTER
        if ($filter !== 'all') {
            // contoh filter by jenis
            $query->where('jenis', $filter);
        }

        // SORTING
        $query->orderBy('level')
            ->orderBy('urutan')
            ->orderBy('nama');

        // PAGINATION
        $dpos = $query->paginate(
            $perPage === 'all' ? $query->count() : (int) $perPage
        )->withQueryString();

        // TOTAL PER JENIS
        $totals = AdminManageDPO::select('jenis')
            ->selectRaw('count(*) as total')
            ->groupBy('jenis')
            ->pluck('total', 'jenis')
            ->toArray();

        $totals['all'] = array_sum($totals);

        // PARENT Jabatan
        $parentJabatans = AdminManageDPO::orderBy('level')
            ->orderBy('urutan')
            ->get();

        // AJAX RESPONSE
        if ($request->ajax()) {
            return view('admin.administrator.manage-dpo.partials.table_body',compact('title', 'description', 'author', 'dpos', 'totals', 'search', 'filter', 'perPage', 'parentJabatans'))->render();
        }

        return view(
            'admin.administrator.manage-dpo.index', compact('title', 'description', 'author', 'dpos', 'totals', 'search', 'filter', 'perPage', 'parentJabatans')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama'      => 'required|string|max:255',
            'jenis' => 'required|string|in:' . implode(',', AdminManageDPO::ALLOWED_JENIS),
            'parent_id' => 'nullable|exists:admin_manage_d_p_o_s,id',
            'urutan'    => 'nullable|integer|min:0',
        ]);

        // VALIDASI ATURAN ORGANISASI

        // 1. Koordinator hanya 1
        if ($request->jenis === 'koordinator') {
            $exists = AdminManageDPO::where('jenis', 'koordinator')->exists();
            if ($exists) {
                return back()->withErrors('Koordinator hanya boleh satu.');
            }
        }

        // 2. Sekretaris maksimal 2
        if (in_array($request->jenis, ['sekretaris'])) {
            $count = AdminManageDPO::where('jenis', $request->jenis)->count();
            if ($count >= 2) {
                return back()->withErrors('Maksimal 2 jabatan untuk jenis ini.');
            }
        }

        // 3. Validasi parent (struktur)
        if ($request->parent_id) {
            $parent = AdminManageDPO::findOrFail($request->parent_id);

            switch ($request->jenis) {

                case 'staff':
                    if (!in_array($parent->jenis, ['komisi', 'koordinator'])) {
                        return back()->withErrors([
                            'parent_id' => 'Staff hanya boleh di bawah Komisi atau Koordinator.'
                        ]);
                    }
                    break;
            }
        }

        // SIMPAN DATA
        AdminManageDPO::create([
            'nama'      => $request->nama,
            'jenis'     => $request->jenis,
            'level'     => AdminManageDPO::levelOf($request->jenis),
            'parent_id' => $request->parent_id,
            'urutan'    => $request->urutan ?? 0,
        ]);

        return redirect()->back()->with('success', 'Jabatan berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

        $AdminManageDPO = AdminManageDPO::findOrFail($id);
        $request->validate([
            'nama'      => 'required|string|max:255',
            'jenis' => 'required|string|in:' . implode(',', AdminManageDPO::ALLOWED_JENIS),
            'parent_id' => 'nullable|exists:admin_manage_b_p_h_s,id',
            'urutan'    => 'nullable|integer|min:0',
        ]);

        // Ketua Umum tetap hanya 1
        if ($request->jenis === 'ketum') {
            $exists = AdminManageDPO::where('jenis', 'ketum')
                ->where('id', '!=', $AdminManageDPO->id)
                ->exists();

            if ($exists) {
                return back()->withErrors('Ketua Umum hanya boleh satu.');
            }
        }

        // Sekum & Bendum max 2 (exclude dirinya)
        if (in_array($request->jenis, ['sekum', 'bendum'])) {
            $count = AdminManageDPO::where('jenis', $request->jenis)
                ->where('id', '!=', $AdminManageDPO->id)
                ->count();

            if ($count >= 2) {
                return back()->withErrors('Maksimal 2 jabatan untuk jenis ini.');
            }
        }

        // Validasi parent
        if ($request->parent_id) {
            $parent = AdminManageDPO::find($request->parent_id);

            switch ($request->jenis) {

                case 'sekdep':
                    if ($parent->jenis !== 'kadep') {
                        return back()->withErrors(
                            'Sekretaris Departemen hanya boleh di bawah Kepala Departemen.'
                        );
                    }
                    break;

                case 'kadiv':
                    if ($parent->jenis !== 'kadep') {
                        return back()->withErrors(
                            'Kepala Divisi hanya boleh di bawah Kepala Departemen.'
                        );
                    }
                    break;

                case 'sekdiv':
                    if ($parent->jenis !== 'kadiv') {
                        return back()->withErrors(
                            'Sekretaris Divisi hanya boleh di bawah Kepala Divisi.'
                        );
                    }
                    break;

                case 'staff':
                    if (!in_array($parent->jenis, ['kadiv', 'kadep'])) {
                        return back()->withErrors(
                            'Staff hanya boleh berada di bawah Divisi atau Departemen.'
                        );
                    }
                    break;
            }
        }

        $AdminManageDPO->update([
            'nama'      => $request->nama,
            'jenis'     => $request->jenis,
            'level'     => AdminManageDPO::levelOf($request->jenis),
            'parent_id' => $request->parent_id,
            'urutan'    => $request->urutan ?? 0,
        ]);

        return redirect()->back()->with('success', 'Jabatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);
        $AdminManageDPO = AdminManageDPO::findOrFail($id);
        $AdminManageDPO->delete();
        return redirect()->back()->with('success', 'Jabatan berhasil dihapus.');
    }
}
