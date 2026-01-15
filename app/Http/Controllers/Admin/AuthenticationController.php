<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AuthenticationService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

// Controller untuk handle request login dan logout admin
class AuthenticationController extends Controller
{
    // Inject AuthenticationService melalui constructor
    public function __construct(protected AuthenticationService $authService) {}

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

        // Coba login menggunakan AuthenticationService
        $user = $this->authService->attemptLogin(
            $validated['email'],
            $validated['password']
        );

        // Jika login gagal
        if (!$user) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['login' => 'Email atau password salah']);
        }

        // Jika login berhasil, set user session
        $this->authService->setUserSession($user);

        // Redirect ke dashboard dengan pesan sukses
        return redirect()->route('admin.dashboard.index')
            ->with('success', 'Login berhasil! Selamat datang ' . $user->name);
    }

    /**
     * Proses logout user
     * 
     * @return RedirectResponse - Redirect ke halaman login
     */
    public function logout(): RedirectResponse
    {
        // Logout user dengan menghapus session
        $this->authService->logout();

        // Redirect ke login dengan pesan
        return redirect()->route('admin.login')
            ->with('success', 'Logout berhasil');
    }
}
