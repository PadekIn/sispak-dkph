<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Gejala;
use App\Models\Kerusakan;
use App\Models\Rule;
use Illuminate\Routing\Controller;

class GejalaController extends Controller
{
    public function index()
    {
        try {
            $gejalas = Gejala::all();
            if ($gejalas->isEmpty()) {
                return redirect()->back()->with('info', 'Tidak ada data gejala yang ditemukan.');
            }
            return view('pages.admin.gejala.index', compact('gejalas'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengambil data gejala: ' . $e->getMessage());
        }
    }

    public function create()
    {
        $kerusakans = Kerusakan::all();
        return view('pages.admin.gejala.create', compact('kerusakans'));
    }

    public function store(Request $request)
    {
        $lastGejala = Gejala::orderBy('id', 'desc')->first();
        $nextKodeGejala = $lastGejala ? 'G' . str_pad((int)substr($lastGejala->kode_gejala, 1) + 1, 3, '0', STR_PAD_LEFT) : 'G001';
        $request->merge(['kode_gejala' => $nextKodeGejala]);
        $request->validate([
            'kode_gejala' => 'required|string|max:10|unique:gejalas,kode_gejala,' . $nextKodeGejala,
            'nama_gejala' => 'required|string|max:255',
            'kerusakan_id' => 'required|exists:kerusakans,id',
        ]);

        try {
            Gejala::create($request->all());
            Rule::create([
                'gejala_id' => Gejala::where('kode_gejala', $nextKodeGejala)->first()->id,
                'kerusakan_id' => $request->kerusakan_id,
            ]);
            return redirect()->route('admin.gejala.index')->with('success', 'Gejala berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan gejala: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try{
            $kerusakans = Kerusakan::all();
            $gejala = Gejala::findOrFail($id);

            logger($gejala->kerusakan_id);
            return view('pages.admin.gejala.edit', compact('gejala', 'kerusakans'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengambil data gejala: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_gejala' => 'required|string|max:255',
            'kerusakan_id' => 'required|exists:kerusakans,id',
        ]);

        try {
            // Ambil data gejala
            $gejala = Gejala::findOrFail($id);

            // Update data gejala
            $gejala->update([
                'nama_gejala' => $request->nama_gejala,
                'kerusakan_id' => $request->kerusakan_id,
            ]);

            // Update relasi di tabel rules jika ada
            $rule = Rule::where('gejala_id', $gejala->id)->first();
            if ($rule) {
                $rule->update([
                    'kerusakan_id' => $request->kerusakan_id,
                ]);
            }

            return redirect()->route('admin.gejala.index')->with('success', 'Gejala berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui gejala: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $gejala = Gejala::findOrFail($id);
            $gejala->delete();
            return redirect()->route('admin.gejala.index')->with('success', 'Gejala berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus gejala: ' . $e->getMessage());
        }
    }
}
