<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /**
     * Tampilkan halaman form forgot password.
     */
    public function index()
    {   $title = 'Forgot Password Page - UKMBSM ITERA';
        $description = 'UKMBSM ITERA - Unit Kegiatan Mahasiswa Bidang Seni Musik Institut Teknologi Sumatera. Bergabunglah dengan komunitas musik kami dan ikuti berbagai acara musik seru di ITERA.';
        $keywords = 'UKMBSM, ITERA, music community, student organization, music events, ITERA music club';
        $author = 'UKMBSM ITERA';

        return view('auth.forgotPassword.index', compact('title', 'description', 'keywords', 'author'));
    }

    /**
     * Kirimkan email reset password.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Kirim link reset password ke email
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}
