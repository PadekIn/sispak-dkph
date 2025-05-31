<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Gejala;
use Illuminate\Routing\Controller;

class GejalaController extends Controller
{
    public function index()
    {
        try {
            $gejalas = Gejala::all();
            return view('pages.admin.gejala.index', compact('gejalas'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengambil data gejala: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('pages.admin.gejala.create');
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

    public function edit($id)
    {
        try{
            $gejala = Gejala::findOrFail($id);
            return view('pages.admin.gejala.edit', compact('gejala'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengambil data gejala: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_gejala' => 'required|string|max:10|unique:gejalas,kode_gejala,' ,
            'nama_gejala' => 'required|string|max:255',
        ]);

        try {
            $gejala = Gejala::findOrFail($id);
            $gejala->update($request->all());
            return redirect()->route('gejala.index')->with('success', 'Gejala berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui gejala: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $gejala = Gejala::findOrFail($id);
            $gejala->delete();
            return redirect()->route('gejala.index')->with('success', 'Gejala berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus gejala: ' . $e->getMessage());
        }
    }
}
