<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gejala;

class GejalaController extends Controller
{
    public function index()
    {
        try {
            $gejalas = Gejala::all();
            return view('gejala.index', compact('gejalas'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengambil data gejala: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('gejala.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_gejala' => 'required|string|max:10|unique:gejalas',
            'nama_gejala' => 'required|string|max:255',
        ]);

        try {
            Gejala::create($request->all());
            return redirect()->route('gejala.index')->with('success', 'Gejala berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan gejala: ' . $e->getMessage());
        }
    }

    public function edit(Gejala $gejala)
    {
        return view('gejala.edit', compact('gejala'));
    }

    public function update(Request $request, Gejala $gejala)
    {
        $request->validate([
            'kode_gejala' => 'required|string|max:10|unique:gejalas,kode_gejala,' . $gejala->id,
            'nama_gejala' => 'required|string|max:255',
        ]);

        try {
            $gejala->update($request->all());
            return redirect()->route('gejala.index')->with('success', 'Gejala berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui gejala: ' . $e->getMessage());
        }
    }

    public function destroy(Gejala $gejala)
    {
        try {
            $gejala->delete();
            return redirect()->route('gejala.index')->with('success', 'Gejala berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus gejala: ' . $e->getMessage());
        }
    }
}
