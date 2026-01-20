<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct(protected ProfileService $profileService) {}

    /**
     * Tampilkan halaman profile user
     */
    public function index(): View
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    /**
     * Update profil user sendiri
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|min:6|confirmed',
        ], [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        $this->profileService->updateProfile(Auth::user(), $validated);

        return redirect()->route('admin.profile.index')
            ->with('success', 'Profil berhasil diperbarui');
    }

    /**
     * Hapus akun user sendiri
     */
    public function destroy(): RedirectResponse
    {
        $this->profileService->deleteProfile(Auth::user());
        Auth::logout();

        return redirect()->route('admin.login')
            ->with('success', 'Akun berhasil dihapus');
    }
}
