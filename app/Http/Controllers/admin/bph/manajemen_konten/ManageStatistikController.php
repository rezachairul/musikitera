<?php

namespace App\Http\Controllers\admin\bph\manajemen_konten;

use Illuminate\Http\Request;

use App\Models\admin\bph\manajemen_konten\ManageStatistik;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class ManageStatistikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Statistik";
        $mode = $request->get('mode', '7d');
        $year = $request->get('year', now()->year);

        $cacheKey = "statistik_{$mode}_{$year}";

        [$chartLabels, $chartData] = Cache::remember($cacheKey, 300, function () use ($mode, $year) {

            if ($mode === '30d') {
                $stats = ManageStatistik::where('date', '>=', now()->subDays(30))
                    ->orderBy('date')->get();

                return [
                    $stats->pluck('date')->map(fn($d) => Carbon::parse($d)->format('d M')),
                    $stats->pluck('total_visit')
                ];
            }

            if ($mode === 'year') {
                $stats = ManageStatistik::selectRaw('MONTH(date) as month, SUM(total_visit) as total')
                    ->whereYear('date', $year)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get();

                return [
                    $stats->pluck('month')->map(fn($m) => Carbon::create()->month($m)->format('M')),
                    $stats->pluck('total')
                ];
            }

            // default 7d
            $stats = ManageStatistik::where('date', '>=', now()->subDays(7))
                ->orderBy('date')->get();

            return [
                $stats->pluck('date')->map(fn($d) => Carbon::parse($d)->format('d M')),
                $stats->pluck('total_visit')
            ];
        });

        // TOTAL SEMUA
        $totalVisitors = ManageStatistik::sum('total_visit');

        // BULAN INI
        $thisMonth = ManageStatistik::whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->sum('total_visit');

        // HARI TERAMAI
        $peak = ManageStatistik::orderByDesc('total_visit')->first();
        $peakDay = $peak ? \Carbon\Carbon::parse($peak->date)->translatedFormat('d M Y') : '-';

        return view('admin.bph.manajemen_konten.statistik.index', compact('title','chartLabels','chartData','year', 'mode', 'totalVisitors', 'thisMonth', 'peakDay'));
    }

}
