<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kerusakan;

class KerusakanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kerusakan::create(['nama_kerusakan' => 'Kerusakan Baterai', 'jenis_kerusakan' => 'batre', 'solusi' => 'Ganti batrai baru.']);
        Kerusakan::create(['nama_kerusakan' => 'Kerusakan LCD', 'jenis_kerusakan' => 'lcd', 'solusi' => 'Ganti LCD baru.']);
        Kerusakan::create(['nama_kerusakan' => 'Kerusakan Konektor Charger', 'jenis_kerusakan' => 'konektor_charger', 'solusi' => 'Perbaikan konektor cas...']);
        Kerusakan::create(['nama_kerusakan' => 'Kerusakan Kamera', 'jenis_kerusakan' => 'kamera', 'solusi' => 'Perbaikan kamera...']);
        Kerusakan::create(['nama_kerusakan' => 'Kerusakan Mesin', 'jenis_kerusakan' => 'mesin', 'solusi' => 'Cek tegangan mesin...']);
    }
}
