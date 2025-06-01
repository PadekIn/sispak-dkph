<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gejala;
use Illuminate\Support\Facades\Session;
use App\Models\History;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        try {
            // Logika submit diagnosa untuk pengguna
            // Ini akan mencakup validasi, pencarian kerusakan berdasarkan gejala,
            // dan menyimpan hasil ke tabel histories yang terkait dengan user ID.

            // Placeholder untuk saat ini:
            $request->validate([
                'gejala' => 'required|array',
                'gejala.*' => 'exists:gejalas,id'
            ]);
            $gejalaIds = $request->gejala;
            // Ambil objek Gejala berdasarkan ID yang dipilih
            $gejalas = \App\Models\Gejala::whereIn('id', $gejalaIds)->get();

            // Anda akan tambahkan logika diagnosa di sini
            $hasil_diagnosa = "Hasil diagnosa placeholder untuk pengguna"; // Ganti dengan hasil sebenarnya

            // Simpan ke histori
            History::create([
                'user_id' => Auth::id(),
                'tanggal' => now(),
                'gejala_terpilih' => json_encode($gejalas->pluck('nama_gejala')->toArray()), // Simpan nama gejala dalam format JSON
                'hasil_diagnosa' => $hasil_diagnosa,
            ]);

            return redirect()->route('pengguna.hasil')->with('success', 'Diagnosa berhasil diproses.');
        } catch (\Exception $e) {
            Log::error('Error submitting pengguna diagnosa: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memproses diagnosa pengguna.');
        }
    }

    public function hasil()
    {
        try {
            // Ambil histori diagnosa terbaru untuk pengguna yang sedang login
            $latestHistory = History::where('user_id', Auth::id())->latest()->first();

            if ($latestHistory) {
                // Format data histori agar sesuai dengan struktur yang diharapkan oleh view
                // Jika hasil_diagnosa dan gejala_terpilih disimpan sebagai JSON string
                $result = [
                    'gejala' => json_decode($latestHistory->gejala_terpilih, true) ?? [],
                    'hasil_diagnosa' => json_decode($latestHistory->hasil_diagnosa, true) ?? [],
                    'tanggal' => \Carbon\Carbon::parse($latestHistory->tanggal)->format('d-m-Y'),
                ];
            } else {
                // Jika tidak ada histori, arahkan kembali ke halaman diagnosa
                return redirect()->route('pengguna.diagnosa')->with('error', 'Belum ada hasil diagnosa tersimpan. Silakan lakukan diagnosa terlebih dahulu.');
            }

            return view('pages.pengguna.dashboard.hasil', compact('result'));
        } catch (\Exception $e) {
            Log::error('Error loading pengguna hasil page: ' . $e->getMessage());
            return redirect('/')->with('error', 'Terjadi kesalahan saat memuat halaman hasil pengguna.');
        }
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
