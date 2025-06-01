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

        $gejalaInput = collect($request->input('gejala', [])); // gejala dari user
        $allRules = Rule::with('kerusakan')->get(); // ambil semua rule beserta kerusakan

        // Hitung kecocokan antara input dan rule
        $scoreKerusakan = [];

        foreach ($allRules as $rule) {
            $kerusakanId = $rule->kerusakan_id;

            // Kumpulkan semua gejala yg terkait dg kerusakan ini
            if (!isset($scoreKerusakan[$kerusakanId])) {
                $scoreKerusakan[$kerusakanId] = [
                    'kerusakan' => $rule->kerusakan->jenis_kerusakan,
                    'match' => 0,
                    'total' => 0,
                ];
            }

            $scoreKerusakan[$kerusakanId]['total']++;

            if ($gejalaInput->contains($rule->gejala_id)) {
                $scoreKerusakan[$kerusakanId]['match']++;
            }
        }

        // Filter: hanya ambil yang punya minimal 1 kecocokan
        $hasilDiagnosa = collect($scoreKerusakan)
            ->filter(fn($val) => $val['match'] > 0)
            ->sortByDesc('match') // urutkan berdasarkan gejala yang cocok terbanyak
            ->values()
            ->toArray();

        if (empty($hasilDiagnosa)) {
            $hasilDiagnosa[] = ['kerusakan' => 'Tidak ditemukan kerusakan yang sesuai', 'match' => 0, 'total' => 0];
        }

        // Simpan ke session
        session([
            'diagnosa_result' => [
                'gejala' => Gejala::whereIn('id', $gejalaInput)->pluck('nama_gejala')->toArray(),
                'hasil_diagnosa' => $hasilDiagnosa,
                'tanggal' => now()->format('Y-m-d'),
            ]
        ]);

        // Simpan ke history
        $history = new History();
        $history->user_id = Auth::id();
        $history->gejala_terpilih = json_encode($gejalaInput);
        $history->hasil_diagnosa = json_encode($hasilDiagnosa);
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
