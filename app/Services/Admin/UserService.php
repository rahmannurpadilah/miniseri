<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    /**
     * Ambil semua user
     */
    public function getAllUsers(): Collection
    {
        return User::all();
    }
}
