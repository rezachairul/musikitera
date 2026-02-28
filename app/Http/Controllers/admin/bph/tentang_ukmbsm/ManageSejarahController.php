<?php

namespace App\Http\Controllers\admin\bph\tentang_ukmbsm;

use Illuminate\Http\Request;

use App\Models\admin\bph\tentang_ukmbsm\ManageSejarah;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ManageSejarahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Sejarah";
        $description = '';
        $author      = 'UKMBSM ITERA';

        $search  = $request->input('search', '');
        $filter  = $request->query('filter', 'all'); // all | active | finished
        $perPage = $request->query('perPage', 10);

        // Pisahkan multi-keyword search
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        $query = ManageSejarah::query();

        // Search: nama_ukm & deskripsi
        if ($search) {
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->where('nama_ukm', 'like', "%{$word}%")
                        ->orWhere('deskripsi', 'like', "%{$word}%");
                    });
                }
            });
        }

        // Filter status timeline
        if ($filter !== 'all') {
            if ($filter === 'active') {
                // yang masih berlaku (tahun_akhir null)
                $query->whereNull('tahun_akhir');
            } elseif ($filter === 'finished') {
                // yang sudah selesai
                $query->whereNotNull('tahun_akhir');
            }
        }

        // Urut kronologis
        $query->orderBy('tahun_mulai', 'desc');

        // Paginate
        $sejarahs = $query->paginate(
            $perPage === 'all' ? $query->count() : (int) $perPage
        );

        // Total setelah filter & search
        $totalsejarahs = $query->count();

        // AJAX partial (tbody)
        if ($request->ajax()) {
            return view(
                'admin.bph.tentang_ukmbsm.sejarah.partials.table_body',
                compact('sejarahs', 'totalsejarahs', 'search', 'filter', 'perPage')
            )->render();
        }

        return view('admin.bph.tentang_ukmbsm.sejarah.index', compact( 'title', 'sejarahs', 'totalsejarahs', 'search', 'filter', 'perPage'));
    }

    /**
     * Store a newly created resource in storage.
     */ 
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'nama_ukm'    => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'tahun_mulai' => 'required|date',
            'tahun_akhir' => 'nullable|date|after_or_equal:tahun_mulai',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Konversi datetime-local -> year
        $validated['tahun_mulai'] = Carbon::parse($validated['tahun_mulai'])->year;
        $validated['tahun_akhir'] = !empty($validated['tahun_akhir'])
            ? Carbon::parse($validated['tahun_akhir'])->year
            : null;

        // Upload logo pakai slug nama_ukm
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $slug = Str::slug($validated['nama_ukm']); // contoh: ukmbsm-itera
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '.' . $extension;

            $path = $file->storeAs('sejarah/logo', $fileName, 'public');
            $validated['logo'] = $path;
        }

        ManageSejarah::create($validated);

        return redirect()->back()->with('success', 'Data sejarah berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManageSejarah $manageSejarah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageSejarah $manageSejarah)
    {
        //
    }
}
