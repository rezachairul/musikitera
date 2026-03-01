<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Models\admin\bph\manajemen_konten\ManageStatistik;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        // hanya track halaman publik
        if (
            $request->method() === 'GET' &&
            !$request->is('administrator/*') &&
            !$request->is('badan-pengurus/*') &&
            !$request->is('dewan-pengawas/*') &&
            !$request->is('pembina/*') &&
            !$request->is('auth/*')
        ) {
            $today = now()->toDateString();

            ManageStatistik::updateOrCreate(
                ['date' => $today],
                ['total_visit' => DB::raw('total_visit + 1')]
            );
            Cache::flush();
        }

        return $next($request);
    }
}