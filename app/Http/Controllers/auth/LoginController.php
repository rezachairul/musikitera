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
        $title = 'Login Page - UKMBSM ITERA';
        $description = 'UKMBSM ITERA - Unit Kegiatan Mahasiswa Bidang Seni Musik Institut Teknologi Sumatera. Bergabunglah dengan komunitas musik kami dan ikuti berbagai acara musik seru di ITERA.';
        $keywords = 'UKMBSM, ITERA, music community, student organization, music events, ITERA music club';
        $author = 'UKMBSM ITERA';

        return view('auth.login.index', compact('title', 'description', 'keywords', 'author'));
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

            // Cek role user dan redirect sesuai dashboard
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('dashboard.index')
                                     ->with('success', 'Login berhasil sebagai Administrator!');
                case 'bph':
                    return redirect()->route('bph.dashboard.index')
                                     ->with('success', 'Login berhasil sebagai Badan Pengurus!');
                case 'dpo':
                    return redirect()->route('dpo.dashboard.index')
                                     ->with('success', 'Login berhasil sebagai Dewan Pengawas!');
                case 'pembina':
                    return redirect()->route('pembina.dashboard.index')
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
