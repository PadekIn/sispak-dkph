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
        Kerusakan::create(['nama_kerusakan' => 'Kerusakan Baterai', 'jenis_kerusakan' => 'Baterai', 'solusi' => 'Ganti baterai baru']);
        Kerusakan::create(['nama_kerusakan' => 'Kerusakan LCD', 'jenis_kerusakan' => 'LCD', 'solusi' => 'Ganti LCD baru']);
        Kerusakan::create(['nama_kerusakan' => 'Kerusakan Konektor Charger', 'jenis_kerusakan' => 'Konektor Charger', 'solusi' => 'Perbaikan konektor charger']);
        Kerusakan::create(['nama_kerusakan' => 'Kerusakan Kamera', 'jenis_kerusakan' => 'Kamera', 'solusi' => 'Perbaikan kamera']);
        Kerusakan::create(['nama_kerusakan' => 'Kerusakan Mesin', 'jenis_kerusakan' => 'Mesin', 'solusi' => 'Cek tegangan mesin']);
    }
}
