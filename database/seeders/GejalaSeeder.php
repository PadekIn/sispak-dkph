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
        Gejala::create(['kode_gejala' => 'G01', 'nama_gejala' => 'Layar menampilkan garis-garis (horizontal/vertikal) yang mengganggu tampilan']);
        Gejala::create(['kode_gejala' => 'G02', 'nama_gejala' => 'Layar hanya menampilkan warna hitam tanpa gambar sama sekali (blank hitam)']);
        Gejala::create(['kode_gejala' => 'G03', 'nama_gejala' => 'HP menyala (ada suara/getaran), tetapi layar tetap mati/tidak menampilkan gambar']);
        Gejala::create(['kode_gejala' => 'G04', 'nama_gejala' => 'Sebagian area layar sentuh berfungsi, sebagian lainnya tidak merespon sentuhan']);
        Gejala::create(['kode_gejala' => 'G05', 'nama_gejala' => 'Terdapat bercak hitam pada layar yang tidak hilang meski HP dinyalakan ulang']);
        Gejala::create(['kode_gejala' => 'G06', 'nama_gejala' => 'Layar sentuh kurang sensitif atau sulit merespon sentuhan jari']);
        Gejala::create(['kode_gejala' => 'G07', 'nama_gejala' => 'Bagian layar atau bodi HP terlihat menggembung/tidak rata']);
        Gejala::create(['kode_gejala' => 'G08', 'nama_gejala' => 'Baterai tidak bisa terisi penuh hingga 100% meskipun sudah lama di-charge']);
        Gejala::create(['kode_gejala' => 'G09', 'nama_gejala' => 'Persentase baterai meloncat drastis saat di-charge, misal dari 20% langsung ke 80%']);
        Gejala::create(['kode_gejala' => 'G10', 'nama_gejala' => 'Baterai masih 30% namun HP tiba-tiba mati tanpa peringatan']);
        Gejala::create(['kode_gejala' => 'G11', 'nama_gejala' => 'HP hanya bisa digunakan saat di-charge, jika dilepas dari charger langsung mati']);
        Gejala::create(['kode_gejala' => 'G12', 'nama_gejala' => 'Baterai cepat habis meskipun penggunaan normal']);
        Gejala::create(['kode_gejala' => 'G13', 'nama_gejala' => 'HP tidak bisa mengisi daya sama sekali saat dihubungkan ke charger']);
        Gejala::create(['kode_gejala' => 'G14', 'nama_gejala' => 'Kabel charger harus digoyang-goyang agar bisa mengisi daya']);
        Gejala::create(['kode_gejala' => 'G15', 'nama_gejala' => 'HP tetap tidak bertambah daya meskipun sudah di-charge']);
        Gejala::create(['kode_gejala' => 'G16', 'nama_gejala' => 'Kamera tidak menampilkan gambar, hanya layar hitam saat dibuka']);
        Gejala::create(['kode_gejala' => 'G17', 'nama_gejala' => 'Aplikasi kamera tidak bisa dibuka atau selalu error']);
        Gejala::create(['kode_gejala' => 'G18', 'nama_gejala' => 'Hasil foto kamera buram/tidak jelas meskipun lensa bersih']);
        Gejala::create(['kode_gejala' => 'G19', 'nama_gejala' => 'Gambar dari kamera tampak bergoyang atau bergetar']);
        Gejala::create(['kode_gejala' => 'G20', 'nama_gejala' => 'Lensa kamera terlihat berjamur atau ada noda di dalam lensa']);
        Gejala::create(['kode_gejala' => 'G21', 'nama_gejala' => 'HP tidak bisa menyala sama sekali (mati total) meskipun sudah di-charge']);
        Gejala::create(['kode_gejala' => 'G22', 'nama_gejala' => 'HP pernah atau baru saja terkena/kemasukan air']);
        Gejala::create(['kode_gejala' => 'G23', 'nama_gejala' => 'HP sering restart sendiri atau daya listrik tidak stabil']);
    }
}
