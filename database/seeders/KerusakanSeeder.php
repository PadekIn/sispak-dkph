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
        Kerusakan::create(['jenis_kerusakan' => 'LCD', 'solusi' => 'Ganti LCD baru']);
        Kerusakan::create(['jenis_kerusakan' => 'Baterai', 'solusi' => 'Ganti baterai baru']);
        Kerusakan::create(['jenis_kerusakan' => 'Konektor Charger', 'solusi' => 'Perbaikan konektor charger']);
        Kerusakan::create(['jenis_kerusakan' => 'Kamera', 'solusi' => 'Perbaikan kamera']);
        Kerusakan::create(['jenis_kerusakan' => 'Mesin', 'solusi' => 'Cek tegangan mesin']);
    }
}
