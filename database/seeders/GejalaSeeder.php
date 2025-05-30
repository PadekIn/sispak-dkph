<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gejala;

class GejalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gejala::create(['kode' => 'G01', 'nama' => 'Blank Hitam']);
        Gejala::create(['kode' => 'G01', 'nama' => 'Bergaris']);
        Gejala::create(['kode' => 'G01', 'nama' => 'Ada tanda2 HP gidup, namun layar mati']);
        Gejala::create(['kode' => 'G01', 'nama' => 'Sebagian LCD bisa disentuh, sebagian lagi tidak bisa disentuh']);
        Gejala::create(['kode' => 'G01', 'nama' => 'Bercak Hitam']);
        Gejala::create(['kode' => 'G01', 'nama' => 'Kurang sensitif/ susah disentuh']);

        Gejala::create(['kode' => 'G02', 'nama' => 'Gembung']);
        Gejala::create(['kode' => 'G02', 'nama' => 'Dicass tidak mau penuh 100%']);
        Gejala::create(['kode' => 'G02', 'nama' => 'Ketika di charger meloncat dari 20% ke 80%']);
        Gejala::create(['kode' => 'G02', 'nama' => 'Baterai 30% tapi tiba-tiba mati']);
        Gejala::create(['kode' => 'G02', 'nama' => 'Main harus sambil di charger, jika tidak di charger mati']);
        Gejala::create(['kode' => 'G02', 'nama' => 'Baterai cepat habis']);

        Gejala::create(['kode' => 'G03', 'nama' => 'HP tidak bisa di charger']);
        Gejala::create(['kode' => 'G03', 'nama' => 'kabel USB mesti digoyang baru mau masuk']);
        Gejala::create(['kode' => 'G03', 'nama' => 'Dicass tidak menambahkan daya']);

        Gejala::create(['kode' => 'G04', 'nama' => 'Kamera blank hitam']);
        Gejala::create(['kode' => 'G04', 'nama' => 'Kamera tidak bisa dibuka']);
        Gejala::create(['kode' => 'G04', 'nama' => 'Buram']);
        Gejala::create(['kode' => 'G04', 'nama' => 'Bergoyang']);
        Gejala::create(['kode' => 'G04', 'nama' => 'Berjamur']);

        Gejala::create(['kode' => 'G05', 'nama' => 'HP tidak bisa menyala/mati total']);
        Gejala::create(['kode' => 'G05', 'nama' => 'masuk air']);
        Gejala::create(['kode' => 'G05', 'nama' => 'Tegangan tidak stabil']);
    }
}
