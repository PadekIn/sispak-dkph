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
        Kerusakan::create(['nama' => 'Kerusakan Baterai', 'kategori' => 'Baterai', 'solusi' => 'Ganti baterai baru.']);
        Kerusakan::create(['nama' => 'Kerusakan LCD', 'kategori' => 'LCD', 'solusi' => 'Periksa dan ganti LCD.']);
    }
}
