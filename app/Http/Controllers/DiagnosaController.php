<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gejala;
use App\Models\Kerusakan;
use App\Models\Rule;

class DiagnosaController extends Controller
{
    public function submit(Request $request)
    {
        try {
            $request->validate([
                'gejala' => 'required|array',
                'gejala.*' => 'exists:gejalas,id'
            ]);

            // Ambil gejala yang dipilih
            $gejalaIds = $request->gejala;

            // Cari kerusakan yang sesuai dengan gejala yang dipilih
            $kerusakanIds = Rule::whereIn('gejala_id', $gejalaIds)
                ->select('kerusakan_id')
                ->distinct()
                ->pluck('kerusakan_id');

            // Ambil detail kerusakan
            $kerusakans = Kerusakan::whereIn('id', $kerusakanIds)->get();

            // Simpan hasil diagnosa ke session
            session(['diagnosa_result' => [
                'gejala' => Gejala::whereIn('id', $gejalaIds)->get(),
                'kerusakan' => $kerusakans
            ]]);

            return redirect()->route('guest.hasil')->with('success', 'Diagnosa berhasil dilakukan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
