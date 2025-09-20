<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function login()
    {
        $title = 'Login';
        return view('auth.login.index', compact('title'));
    }

    /**
     * Proses login
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // // Tambah log untuk debug
            // Log::info('User login berhasil', [
            //     'user_id' => $user->id,
            //     'email'   => $user->email,
            //     'session_id' => $request->session()->getId(),
            // ]);

            // // Cek juga langsung ke DB (opsional)
            // $lastSession = DB::table('sessions')->latest('last_activity')->first();
            // Log::info('Last session row:', (array) $lastSession);

            // Cek role user dan redirect sesuai dashboard
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('dashboard.index')
                                     ->with('success', 'Login berhasil sebagai Administrator!');
                case 'bph':
                    return redirect()->route('admin.bph.dashboard.index')
                                     ->with('success', 'Login berhasil sebagai Badan Pengurus!');
                case 'dpo':
                    return redirect()->route('admin.dpo.dashboard.index')
                                     ->with('success', 'Login berhasil sebagai Dewan Pengawas!');
                case 'pembina':
                    return redirect()->route('admin.pembina.dashboard.index')
                                     ->with('success', 'Login berhasil sebagai Pembina!');
                default:
                    Auth::logout();
                    return redirect()->route('login')
                                     ->withErrors(['email' => 'Role tidak dikenali.']);
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout!');
    }
}
