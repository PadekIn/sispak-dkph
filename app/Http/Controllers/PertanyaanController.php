<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gejala;
use App\Models\Pertanyaan;

class PertanyaanController extends Controller
{
    public function index()
    {
        try {
            $pertanyaan = Pertanyaan::with('gejala')->get();
            return view('pertanyaan.index', compact('pertanyaan'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengambil data pertanyaan: ' . $e->getMessage());
        }
    }
    public function create()
    {
        $gejalas = Gejala::all();
        return view('pertanyaan.create', compact('gejalas'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'gejala_id' => 'required|exists:gejalas,id',
            'pertanyaan' => 'required|string|max:255',
        ]);

        try {
            Pertanyaan::create($request->all());
            return redirect()->route('pertanyaan.index')->with('success', 'Pertanyaan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan pertanyaan: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        try {
            $pertanyaan = Pertanyaan::findOrFail($id);
            $gejalas = Gejala::all();
            return view('pertanyaan.edit', compact('pertanyaan', 'gejalas'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengambil data pertanyaan: ' . $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'gejala_id' => 'required|exists:gejalas,id',
            'pertanyaan' => 'required|string|max:255',
        ]);

        try {
            $pertanyaan = Pertanyaan::findOrFail($id);
            $pertanyaan->update($request->all());
            return redirect()->route('pertanyaan.index')->with('success', 'Pertanyaan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui pertanyaan: ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $pertanyaan = Pertanyaan::findOrFail($id);
            $pertanyaan->delete();
            return redirect()->route('pertanyaan.index')->with('success', 'Pertanyaan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus pertanyaan: ' . $e->getMessage());
        }
    }
}
