<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Service untuk handle authentication logic
class AuthenticationService
{
    /**
     * Mencoba login user dengan email dan password
     * 
     * @param string $email - Email user
     * @param string $password - Password user (plain text)
     * @return User|null - Return user object jika berhasil, null jika gagal
     */
    public function attemptLogin(string $email, string $password): ?User
    {
        // Cari user berdasarkan email
        $user = User::where('email', $email)->first();

        // Jika user tidak ditemukan atau password salah
        if (!$user || !Hash::check($password, $user->password)) {
            return null;
        }

        // Return user jika kredensial valid
        return $user;
    }

    /**
     * Logout user dengan menghapus session
     * 
     * @return void
     */
    public function logout(): void
    {
        // Hapus session user
        session()->forget('user_id');
        
        // Invalidate session
        session()->invalidate();
        
        // Regenerate token untuk mencegah session fixation attack
        session()->regenerateToken();
    }

    /**
     * Check apakah user sudah login
     * 
     * @return bool
     */
    public function isAuthenticated(): bool
    {
        return session()->has('user_id');
    }

    /**
     * Ambil user yang sedang login
     * 
     * @return User|null
     */
    public function getAuthenticatedUser(): ?User
    {
        if (!$this->isAuthenticated()) {
            return null;
        }

        return User::find(session('user_id'));
    }

    /**
     * Set user session
     * 
     * @param User $user
     * @return void
     */
    public function setUserSession(User $user): void
    {
        // Simpan user ID di session
        session(['user_id' => $user->id]);
        
        // Regenerate token untuk keamanan
        session()->regenerateToken();
    }
}
