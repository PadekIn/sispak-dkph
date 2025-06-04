<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gejala;
use App\Models\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use \App\Models\Kerusakan;

class DiagnosaGuestController extends Controller
{
    public function diagnosa(Request $request)
    {
        try {
            $result = Session::get('guest_diagnosa_result');
            if ($result) {
                // Jika ada hasil diagnosa sebelumnya, hapus dari session
                $request->session()->forget('guest_diagnosa_result');
            }
            $gejalas = Gejala::all();
            return view('pages.guest.diagnosa', compact('gejalas'));
        } catch (\Exception $e) {
            Log::error('Error loading diagnosa page: ' . $e->getMessage());
            return redirect('/')->with('error', 'Terjadi kesalahan saat memuat halaman diagnosa.');
        }
    }

    public function submit(Request $request)
    {
        $request->validate([
            'gejala' => 'required|array',
            'gejala.*' => 'exists:gejalas,id'
        ]);

        $gejalaIds = $request->input('gejala');

        // Ambil semua gejala yang dipilih user, termasuk relasi ke kerusakan
        $gejalas = Gejala::whereIn('id', $gejalaIds)->get();

        // Kelompokkan gejala yang tersedia berdasarkan kerusakan_id
        $kelompokGejala = Gejala::all()->groupBy('kerusakan_id');

        $hasilDiagnosa = [];

        foreach ($kelompokGejala as $kerusakanId => $gejalaGroup) {
            $match = $gejalaGroup->whereIn('id', $gejalaIds)->count();
            $total = $gejalaGroup->count();

            if ($match > 0) {
                $kerusakan = Kerusakan::find($kerusakanId);

                $hasilDiagnosa[] = [
                    'kerusakan' => $kerusakan->jenis_kerusakan,
                    'jenis_kerusakan' => $kerusakan->jenis_kerusakan,
                    'solusi' => $kerusakan->solusi,
                    'match' => $match,
                    'total' => $total
                ];
            }
        }

        // Urutkan hasil berdasarkan persentase kecocokan tertinggi
        usort($hasilDiagnosa, function($a, $b) {
            $percentA = ($a['match'] / $a['total']) * 100;
            $percentB = ($b['match'] / $b['total']) * 100;
            return $percentB <=> $percentA;
        });

        $result = [
            'gejala' => $gejalas->pluck('nama_gejala')->toArray(),
            'hasil_diagnosa' => $hasilDiagnosa,
            'tanggal' => now()->format('Y-m-d')
        ];

        // Simpan hasil diagnosa di session
        session(['guest_diagnosa_result' => $result]);

        // Redirect ke halaman login dengan pesan
        return redirect()->route('login')->with('info', 'Silakan masuk atau daftar untuk menyimpan hasil diagnosa Anda.');
    }


    public function hasil()
    {
        try {
            $result = Session::get('guest_diagnosa_result');
            if (!$result) {
                return redirect()->route('guest.diagnosa')->with('error', 'Silakan lakukan diagnosa terlebih dahulu');
            }
            return view('pages.guest.hasil', compact('result'));
        } catch (\Exception $e) {
            Log::error('Error loading hasil page: ' . $e->getMessage());
            return redirect('/')->with('error', 'Terjadi kesalahan saat memuat halaman hasil.');
        }
    }

    public function histori()
    {
        // Redirect ke halaman login dengan pesan
        return redirect()->route('login')->with('info', 'Silakan masuk terlebih dahulu untuk melihat histori diagnosa Anda.');
    }
}
