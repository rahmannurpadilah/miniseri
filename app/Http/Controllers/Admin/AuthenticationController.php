<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

// Controller untuk handle request login dan logout admin
class AuthenticationController extends Controller
{

    /**
     * Tampilkan halaman login
     * 
     * @return View - Render login view
     */
    public function showLoginForm(): View
    {
        return view('admin.authentication.login');
    }

    /**
     * Proses login user
     * 
     * @param Request $request - Request dari form login
     * @return RedirectResponse - Redirect ke dashboard jika berhasil atau kembali ke login jika gagal
     */
    public function login(Request $request): RedirectResponse
    {
        // Validasi input email dan password
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            // Custom pesan error dalam bahasa Indonesia
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        // Coba login menggunakan Auth::attempt
        if (!Auth::attempt($validated)) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['login' => 'Email atau password salah']);
        }

        // Regenerate session untuk keamanan
        $request->session()->regenerate();

        // Redirect ke dashboard dengan pesan sukses
        return redirect()->route('admin.dashboard.index')
            ->with('success', 'Login berhasil! Selamat datang ' . Auth::user()->name);
    }

    /**
     * Proses logout user
     * 
     * @return RedirectResponse - Redirect ke halaman login
     */
    public function logout(Request $request): RedirectResponse
    {
        // Logout user
        Auth::logout();

        // Invalidate session dan regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke login dengan pesan
        return redirect()->route('admin.login')
            ->with('success', 'Logout berhasil');
    }
}
