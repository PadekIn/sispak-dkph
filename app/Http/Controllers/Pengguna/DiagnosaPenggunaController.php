<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\Gejala;
use App\Models\History;
use App\Models\Kerusakan;
use App\Models\Rule;

class DiagnosaPenggunaController extends Controller
{
    public function diagnosa()
    {
        try {
            $gejalas = Gejala::all();
            return view('pages.pengguna.dashboard.diagnosa', compact('gejalas'));
        } catch (\Exception $e) {
            Log::error('Error loading pengguna diagnosa page: ' . $e->getMessage());
            return redirect('/')->with('error', 'Terjadi kesalahan saat memuat halaman diagnosa pengguna.');
        }
    }

    public function submit(Request $request)
    {
        $request->validate([
            'gejala' => 'required|array|min:1',
            'gejala.*' => 'exists:gejalas,id',
        ]);

        $gejalaIds = $request->input('gejala', []);

        // Cari kerusakan yang paling cocok berdasarkan rules
        $kerusakan = Rule::select('kerusakan_id')
            ->whereIn('gejala_id', $gejalaIds)
            ->groupBy('kerusakan_id')
            ->orderByRaw('COUNT(*) DESC')
            ->first();

        $hasilDiagnosa = null;
        if ($kerusakan) {
            $kerusakanData = Kerusakan::find($kerusakan->kerusakan_id);
            $hasilDiagnosa = $kerusakanData ? $kerusakanData->nama_kerusakan : 'Tidak diketahui';
        } else {
            $hasilDiagnosa = 'Tidak ditemukan kerusakan yang sesuai';
        }

        // Simpan ke session
        session([
            'diagnosa_result' => [
                'gejala' => Gejala::whereIn('id', $gejalaIds)->pluck('nama_gejala')->toArray(),
                'hasil_diagnosa' => $hasilDiagnosa,
                'tanggal' => now()->format('Y-m-d'),
            ]
        ]);

        // Simpan ke tabel histories
        $history = new History();
        $history->user_id = Auth::id();
        $history->gejala_terpilih = json_encode($gejalaIds);
        $history->hasil_diagnosa = $hasilDiagnosa;
        $history->tanggal = now();
        $history->save();

        return redirect()->route('pengguna.hasil');
    }

    public function hasil()
    {
        $result = session('diagnosa_result');

        if (!$result) {
            return redirect()->route('pengguna.diagnosa')->with('error', 'Silakan lakukan diagnosa terlebih dahulu.');
        }

        return view('pages.pengguna.dashboard.hasil', compact('result'));
    }

    public function histori()
    {
        try {
            $histories = History::where('user_id', Auth::id())->latest()->get();
            return view('pages.pengguna.history.index', compact('histories'));
        } catch (\Exception $e) {
            Log::error('Error loading pengguna histori page: ' . $e->getMessage());
            return redirect('/')->with('error', 'Terjadi kesalahan saat memuat halaman histori pengguna.');
        }
    }
}
