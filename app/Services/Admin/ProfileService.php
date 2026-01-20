<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileService
{
    /**
     * Update profil user
     */
    public function updateProfile(User $user, array $data): User
    {
        $user->name = $data['name'];
        $user->email = $data['email'];

        // Hanya update password jika diberikan
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();
        return $user;
    }

    /**
     * Hapus profil user
     */
    public function deleteProfile(User $user): void
    {
        $user->delete();
    }
}
