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
        Gejala::create(['kode_gejala' => 'G001', 'nama_gejala' => 'Layar menampilkan garis-garis (horizontal atau vertikal) yang mengganggu tampilan']);
        Gejala::create(['kode_gejala' => 'G002', 'nama_gejala' => 'Layar hanya menampilkan warna hitam tanpa gambar sama sekali (blank hitam)']);
        Gejala::create(['kode_gejala' => 'G003', 'nama_gejala' => 'HP menyala (ada suara atau getaran), tetapi layar tetap mati atau tidak menampilkan gambar']);
        Gejala::create(['kode_gejala' => 'G004', 'nama_gejala' => 'Sebagian area layar sentuh berfungsi, sebagian lainnya tidak merespon sentuhan']);
        Gejala::create(['kode_gejala' => 'G005', 'nama_gejala' => 'Terdapat bercak hitam pada layar yang tidak hilang meski HP dinyalakan ulang']);
        Gejala::create(['kode_gejala' => 'G006', 'nama_gejala' => 'Layar sentuh kurang sensitif atau sulit merespon sentuhan jari']);
        Gejala::create(['kode_gejala' => 'G007', 'nama_gejala' => 'Bagian layar atau bodi HP terlihat menggembung atau tidak rata']);
        Gejala::create(['kode_gejala' => 'G008', 'nama_gejala' => 'Baterai tidak bisa terisi penuh hingga 100% meskipun sudah lama di-charge']);
        Gejala::create(['kode_gejala' => 'G009', 'nama_gejala' => 'Persentase baterai meloncat drastis saat di-charge, misal dari 20% langsung ke 80%']);
        Gejala::create(['kode_gejala' => 'G010', 'nama_gejala' => 'Baterai masih 30% namun HP tiba-tiba mati tanpa peringatan']);
        Gejala::create(['kode_gejala' => 'G011', 'nama_gejala' => 'HP hanya bisa digunakan saat di-charge, jika dilepas dari charger langsung mati']);
        Gejala::create(['kode_gejala' => 'G012', 'nama_gejala' => 'Baterai cepat habis meskipun penggunaan normal']);
        Gejala::create(['kode_gejala' => 'G013', 'nama_gejala' => 'HP tidak bisa mengisi daya sama sekali saat dihubungkan ke charger']);
        Gejala::create(['kode_gejala' => 'G014', 'nama_gejala' => 'Kabel charger harus digoyang-goyang agar bisa mengisi daya']);
        Gejala::create(['kode_gejala' => 'G015', 'nama_gejala' => 'HP tetap tidak bertambah daya meskipun sudah di-charge']);
        Gejala::create(['kode_gejala' => 'G016', 'nama_gejala' => 'Kamera tidak menampilkan gambar, hanya layar hitam saat dibuka']);
        Gejala::create(['kode_gejala' => 'G017', 'nama_gejala' => 'Aplikasi kamera tidak bisa dibuka atau selalu error']);
        Gejala::create(['kode_gejala' => 'G018', 'nama_gejala' => 'Hasil foto kamera buram atau tidak jelas meskipun lensa bersih']);
        Gejala::create(['kode_gejala' => 'G019', 'nama_gejala' => 'Gambar dari kamera tampak bergoyang atau bergetar']);
        Gejala::create(['kode_gejala' => 'G020', 'nama_gejala' => 'Lensa kamera terlihat berjamur atau ada noda di dalam lensa']);
        Gejala::create(['kode_gejala' => 'G021', 'nama_gejala' => 'HP tidak bisa menyala sama sekali (mati total) meskipun sudah di-charge']);
        Gejala::create(['kode_gejala' => 'G022', 'nama_gejala' => 'HP pernah atau baru saja terkena atau kemasukan air']);
        Gejala::create(['kode_gejala' => 'G023', 'nama_gejala' => 'HP sering restart sendiri atau daya listrik tidak stabil']);
    }
}
