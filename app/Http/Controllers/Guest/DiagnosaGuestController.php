<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gejala;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class DiagnosaGuestController extends Controller
{
    public function diagnosa()
    {
        try {
            $gejalas = Gejala::all();
            return view('pages.guest.diagnosa', compact('gejalas'));
        } catch (\Exception $e) {
            Log::error('Error loading diagnosa page: ' . $e->getMessage());
            return redirect('/')->with('error', 'Terjadi kesalahan saat memuat halaman diagnosa.');
        }
    }

    public function submit(Request $request)
    {
        try {
            // Logika submit diagnosa akan ditambahkan di sini nanti
            // Untuk saat ini, kita bisa kembalikan respons sederhana atau redirect
            return redirect()->route('guest.hasil')->with('success', 'Diagnosa berhasil diproses (placeholder).');
        } catch (\Exception $e) {
            Log::error('Error submitting diagnosa: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memproses diagnosa.');
        }
    }

    public function hasil()
    {
        try {
            $result = Session::get('diagnosa_result');
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
        try {
            // Logika histori akan ditambahkan di sini nanti
            return view('pages.guest.histori');
        } catch (\Exception $e) {
            Log::error('Error loading histori page: ' . $e->getMessage());
            return redirect('/')->with('error', 'Terjadi kesalahan saat memuat halaman histori.');
        }
    }
}
