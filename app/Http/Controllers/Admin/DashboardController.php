<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kerusakan;
use App\Models\History;
use App\Http\Controllers\Controller;


class DashboardController extends Controller
{

    public function dataKerusakanPerBulan()
    {
        try {
            $categories = Kerusakan::pluck('jenis_kerusakan')->toArray();
            $histories = History::where('hasil_diagnosa', '!=', null)
                ->whereNotNull('hasil_diagnosa')
                ->orderBy('created_at', 'asc')
                ->get();

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
                // Inisialisasi jumlah per kategori dari tabel kerusakan
                $jumlah = array_fill_keys($categories, 0);

                foreach ($items as $history) {
                    $hasil = json_decode($history->hasil_diagnosa, true);
                    if (is_array($hasil)) {
                        foreach ($hasil as $item) {
                            // Ambil nama kerusakan dari hasil diagnosa
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
