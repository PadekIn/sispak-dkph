<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function dataKerusakanPerBulan()
    {
        try {
            $categories = ['LCD', 'Baterai', 'Konektor Charger', 'Kamera', 'Mesin'];
            $histories = \DB::table('histories')->get();

            $grouped = [];
            foreach ($histories as $history) {
                $bulanTahun = date('Y-m', strtotime($history->created_at));
                if (!isset($grouped[$bulanTahun])) {
                    $grouped[$bulanTahun] = [];
                }
                $grouped[$bulanTahun][] = $history;
            }

            $result = [];
            $bulanTahunList = [];

            foreach ($grouped as $bulanTahun => $items) {
                // Inisialisasi jumlah per kategori
                $jumlah = array_fill_keys($categories, 0);

                foreach ($items as $history) {
                    $hasil = json_decode($history->hasil_diagnosa, true);
                    if (is_array($hasil)) {
                        foreach ($hasil as $item) {
                            $kerusakan = is_array($item) && isset($item['kerusakan']) ? $item['kerusakan'] : (isset($item['nama']) ? $item['nama'] : $item);
                            if ($kerusakan && isset($jumlah[$kerusakan])) {
                                $jumlah[$kerusakan]++;
                            }
                        }
                    }
                }

                $result[$bulanTahun] = [
                    'kerusakan' => $categories,
                    'jumlah' => array_values($jumlah)
                ];
                $bulanTahunList[] = $bulanTahun;
            }

            sort($bulanTahunList);

            return response()->json([
                'data' => $result,
                'bulan_tahun' => $bulanTahunList
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
}
