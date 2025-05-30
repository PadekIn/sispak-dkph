<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserOriginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Pengguna',
            'email' => 'pengguna@pengguna.com',
            'password' => Hash::make('pengguna123'),
            'role' => 'pengguna',
            'email_verified_at' => now(),
        ]);
    }
}
