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
                $allKerusakan = [];
                foreach ($items as $history) {
                    $hasil = json_decode($history->hasil_diagnosa, true);
                    if (is_array($hasil)) {
                        foreach ($hasil as $item) {
                            $nama = is_array($item) && isset($item['kerusakan']) ? $item['kerusakan'] : (isset($item['nama']) ? $item['nama'] : $item);
                            if ($nama && !in_array($nama, $allKerusakan)) {
                                $allKerusakan[] = $nama;
                            }
                        }
                    }
                }

                $jumlah = array_fill(0, count($allKerusakan), 0);
                foreach ($items as $history) {
                    $hasil = json_decode($history->hasil_diagnosa, true);
                    if (is_array($hasil)) {
                        foreach ($hasil as $item) {
                            $nama = is_array($item) && isset($item['kerusakan']) ? $item['kerusakan'] : (isset($item['nama']) ? $item['nama'] : $item);
                            $index = array_search($nama, $allKerusakan);
                            if ($index !== false) {
                                $jumlah[$index]++;
                            }
                        }
                    }
                }

                $result[$bulanTahun] = [
                    'kerusakan' => $allKerusakan,
                    'jumlah' => $jumlah
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
