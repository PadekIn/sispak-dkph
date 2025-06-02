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
        Gejala::create(['kode_gejala' => 'G01', 'nama_gejala' => 'Bergaris']);
        Gejala::create(['kode_gejala' => 'G02', 'nama_gejala' => 'Blank hitam']);
        Gejala::create(['kode_gejala' => 'G03', 'nama_gejala' => 'Ada tanda-tanda HP hidup, namun layar mati']);
        Gejala::create(['kode_gejala' => 'G04', 'nama_gejala' => 'Sebagian LCD bisa disentuh, sebagian lagi tidak bisa disentuh']);
        Gejala::create(['kode_gejala' => 'G05', 'nama_gejala' => 'Bercak hitam']);
        Gejala::create(['kode_gejala' => 'G06', 'nama_gejala' => 'Kurang sensitif atau susah disentuh']);
        Gejala::create(['kode_gejala' => 'G07', 'nama_gejala' => 'Gembung']);
        Gejala::create(['kode_gejala' => 'G08', 'nama_gejala' => 'Dicharger tidak mau penuh 100%']);
        Gejala::create(['kode_gejala' => 'G09', 'nama_gejala' => 'Ketika di charger meloncat dari 20% ke 80%']);
        Gejala::create(['kode_gejala' => 'G10', 'nama_gejala' => 'Baterai 30% tapi tiba-tiba mati']);
        Gejala::create(['kode_gejala' => 'G11', 'nama_gejala' => 'Main harus sambil dicharger, jika tidak dicharger mati']);
        Gejala::create(['kode_gejala' => 'G12', 'nama_gejala' => 'Baterai cepat habis']);
        Gejala::create(['kode_gejala' => 'G13', 'nama_gejala' => 'HP tidak bisa dicharger']);
        Gejala::create(['kode_gejala' => 'G14', 'nama_gejala' => 'Kabel USB mesti digoyang baru mau masuk']);
        Gejala::create(['kode_gejala' => 'G15', 'nama_gejala' => 'Dicharger tidak menambahkan daya']);
        Gejala::create(['kode_gejala' => 'G16', 'nama_gejala' => 'Kamera blank hitam']);
        Gejala::create(['kode_gejala' => 'G17', 'nama_gejala' => 'Kamera tidak bisa dibuka']);
        Gejala::create(['kode_gejala' => 'G18', 'nama_gejala' => 'Kamera Buram']);
        Gejala::create(['kode_gejala' => 'G19', 'nama_gejala' => 'Kamera Bergoyang']);
        Gejala::create(['kode_gejala' => 'G20', 'nama_gejala' => 'Kamera Berjamur']);
        Gejala::create(['kode_gejala' => 'G21', 'nama_gejala' => 'HP tidak bisa menyala atau mati total']);
        Gejala::create(['kode_gejala' => 'G22', 'nama_gejala' => 'Hp kemasukan air']);
        Gejala::create(['kode_gejala' => 'G23', 'nama_gejala' => 'Tegangan tidak stabil']);
    }
}
