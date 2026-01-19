<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// Seeder untuk membuat user demo
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat user admin demo untuk testing
        User::create([
            'name' => 'Admin Miniseri',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'), // Password: password123
        ]);

        // Buat user tambahan untuk testing (opsional)
        User::create([
            'name' => 'Manager Miniseri',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('password123'), // Password: password123
        ]);
    }
}

