<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\bph\manajemen_anggota\ManageAlumni;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        $alumnis = ManageAlumni::query()
            ->with(['anggota:id,nama'])
            ->when($request->q, function ($query) use ($request) {
                $q = trim($request->q);
                $query->whereHas('anggota', function ($sub) use ($q) {
                    $sub->where('nama', 'like', "%{$q}%");
                });
            })
            ->when($request->tahun, function ($query) use ($request) {
                $query->where('tahun_lulus', $request->tahun);
            })
            ->orderByDesc('tahun_lulus')
            ->paginate(24)
            ->withQueryString();

        return view('public.about.alumni', compact('alumnis'));
    }
}
