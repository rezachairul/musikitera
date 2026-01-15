<?php

namespace App\Http\Controllers\admin\administrator;

use App\Models\admin\administrator\AdminManageBPH;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminManageBPHController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Position BPH Management';
        $description = 'Manage BPH positions within the UKMBSM ITERA Administrator Panel.';
        $author = 'UKMBSM ITERA';

        $search  = $request->input('search', '');
        $filter  = $request->query('filter', 'all');
        $perPage = $request->query('perPage', '10');

        $query = AdminManageBPH::query();

        
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
        $bphs = $query->paginate(
            $perPage === 'all' ? $query->count() : (int) $perPage
        )->withQueryString();

        // TOTAL PER JENIS
        $totals = AdminManageBPH::select('jenis')
            ->selectRaw('count(*) as total')
            ->groupBy('jenis')
            ->pluck('total', 'jenis')
            ->toArray();

        $totals['all'] = array_sum($totals);

        // PARENT Jabatan
        $parentJabatans = AdminManageBPH::orderBy('level')
            ->orderBy('urutan')
            ->get();

        // AJAX RESPONSE
        if ($request->ajax()) {
            return view('admin.administrator.manage-bph.partials.table_body',compact('title', 'description', 'author', 'bphs', 'totals', 'search', 'filter', 'perPage', 'parentJabatans'))->render();
        }

        return view(
            'admin.administrator.manage-bph.index', compact('title', 'description', 'author', 'bphs', 'totals', 'search', 'filter', 'perPage', 'parentJabatans')
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
            'jenis' => 'required|string|in:' . implode(',', AdminManageBPH::ALLOWED_JENIS),
            'parent_id' => 'nullable|exists:admin_manage_b_p_h_s,id',
            'urutan'    => 'nullable|integer|min:0',
        ]);

        // VALIDASI ATURAN ORGANISASI

        // 1. Ketua Umum hanya 1
        if ($request->jenis === 'ketum') {
            $exists = AdminManageBPH::where('jenis', 'ketum')->exists();
            if ($exists) {
                return back()->withErrors('Ketua Umum hanya boleh satu.');
            }
        }

        // 2. Sekum & Bendum maksimal 2
        if (in_array($request->jenis, ['sekum', 'bendum'])) {
            $count = AdminManageBPH::where('jenis', $request->jenis)->count();
            if ($count >= 2) {
                return back()->withErrors('Maksimal 2 jabatan untuk jenis ini.');
            }
        }

        // 3. Validasi parent (struktur)
        if ($request->parent_id) {
            $parent = AdminManageBPH::find($request->parent_id);

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

        // SIMPAN DATA
        AdminManageBPH::create([
            'nama'      => $request->nama,
            'jenis'     => $request->jenis,
            'level'     => AdminManageBPH::levelOf($request->jenis),
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

        $adminManageBPH = AdminManageBPH::findOrFail($id);
        $request->validate([
            'nama'      => 'required|string|max:255',
            'jenis' => 'required|string|in:' . implode(',', AdminManageBPH::ALLOWED_JENIS),
            'parent_id' => 'nullable|exists:admin_manage_b_p_h_s,id',
            'urutan'    => 'nullable|integer|min:0',
        ]);

        // Ketua Umum tetap hanya 1
        if ($request->jenis === 'ketum') {
            $exists = AdminManageBPH::where('jenis', 'ketum')
                ->where('id', '!=', $adminManageBPH->id)
                ->exists();

            if ($exists) {
                return back()->withErrors('Ketua Umum hanya boleh satu.');
            }
        }

        // Sekum & Bendum max 2 (exclude dirinya)
        if (in_array($request->jenis, ['sekum', 'bendum'])) {
            $count = AdminManageBPH::where('jenis', $request->jenis)
                ->where('id', '!=', $adminManageBPH->id)
                ->count();

            if ($count >= 2) {
                return back()->withErrors('Maksimal 2 jabatan untuk jenis ini.');
            }
        }

        // Validasi parent
        if ($request->parent_id) {
            $parent = AdminManageBPH::find($request->parent_id);

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

        $adminManageBPH->update([
            'nama'      => $request->nama,
            'jenis'     => $request->jenis,
            'level'     => AdminManageBPH::levelOf($request->jenis),
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
        $adminManageBPH = AdminManageBPH::findOrFail($id);
        $adminManageBPH->delete();
        return redirect()->back()->with('success', 'Jabatan berhasil dihapus.');
    }

}
