<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

            // Cek role user dan redirect sesuai dashboard
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.administrator.index')
                                     ->with('success', 'Login berhasil sebagai Administrator!');
                case 'bph':
                    return redirect()->route('bph.dashboard')
                                     ->with('success', 'Login berhasil sebagai Badan Pengurus!');
                case 'dpo':
                    return redirect()->route('dpo.dashboard')
                                     ->with('success', 'Login berhasil sebagai Dewan Pengawas!');
                case 'pembina':
                    return redirect()->route('pembina.dashboard')
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
