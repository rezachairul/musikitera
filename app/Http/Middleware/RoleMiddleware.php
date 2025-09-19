<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            // Belum login
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Log role untuk debugging
        Log::info('RoleMiddleware check', [
            'expected' => $role,
            'role' => $user->role,
        ]);

        if ($user->role !== $role) {
            // Kalau role tidak sesuai, bisa redirect ke halaman 403
            return redirect()->route('errors.403');
        }

        return $next($request);
    }
}
