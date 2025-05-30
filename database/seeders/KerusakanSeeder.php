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
        Kerusakan::create(['nama' => 'Kerusakan LCD', 'kategori' => 'LCD', 'solusi' => 'Ganti LCD baru.']);
        Kerusakan::create(['nama' => 'Kerusakan Baterai', 'kategori' => 'Baterai', 'solusi' => 'Ganti batrai baru.']);
        Kerusakan::create(['nama' => 'Kerusakan Konektor Charger', 'kategori' => 'Konektor Charger', 'solusi' => 'Perbaikan konektor cas, dibersihkan sampahnya, jika tidak bisa diperbaiki maka wajib diganti.']);
        Kerusakan::create(['nama' => 'Kerusakan Kamera', 'kategori' => 'Kamera', 'solusi' => 'perbaikan kamera dengan cara menambah magnet di dalam bagian kamera, jika tidak bisa di repair maka wajib ganti.']);
        Kerusakan::create(['nama' => 'Kerusakan Mesin', 'kategori' => 'Mesin', 'solusi' => 'Cek tegangan mesin menggunakan power supply dengan tegangan 3,7 A, jika tegangan tidak stabil maka wajib ganti mesin.']);
    }
}
