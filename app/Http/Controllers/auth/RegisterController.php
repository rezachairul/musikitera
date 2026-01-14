<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\admin\administrator\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Tampilkan form register
     */
    public function register()
    {
        $title = 'Register - UKMBSM ITERA';
        $description = 'UKMBSM ITERA - Unit Kegiatan Mahasiswa Bidang Seni Musik Institut Teknologi Sumatera. Bergabunglah dengan komunitas musik kami dan ikuti berbagai acara musik seru di ITERA.';
        $keywords = 'UKMBSM, ITERA, music community, student organization, music events, ITERA music club';
        $author = 'UKMBSM ITERA';
        return view('auth.register.index', compact('title', 'description', 'keywords', 'author'));
    }

    /**
     * Proses register user baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Login user setelah register
        Auth::login($user);

        return redirect('admin.index')->with('success', 'Registrasi berhasil! Selamat datang, ' . $user->name);
    }
}
