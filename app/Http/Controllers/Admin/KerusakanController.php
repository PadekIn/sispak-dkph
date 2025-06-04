<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Kerusakan;
use Illuminate\Routing\Controller;

class KerusakanController extends Controller
{
    public function index() {
        try {
            $kerusakans = Kerusakan::all();
            return view('pages.admin.kerusakan.index', compact('kerusakans'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengambil data kerusakan: ' . $e->getMessage());
        }
    }

    public function create() {
        return view('pages.admin.kerusakan.create');
    }
    public function store(Request $request) {
        $request->validate([
            'jenis_kerusakan' => 'required|string|max:255',
            'solusi' => 'required|string|max:1000',
        ]);

        try {
            Kerusakan::create($request->all());
            return redirect()->route('admin.kerusakan.index')->with('success', 'Kerusakan berhasil ditambahkan.');
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) { // Kode error untuk duplicate entry
                return redirect()->back()->withInput()->with('error', 'Data kerusakan sudah ada.');
            }
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }
    public function edit($id) {

        try {
            $kerusakans = Kerusakan::find( $id);
            return view('pages.admin.kerusakan.edit', compact('kerusakans'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengambil data kerusakan: ' . $e->getMessage());
        }
    }
    public function update(Request $request, $id) {
        $request->validate([
            'jenis_kerusakan' => 'required|string|max:255',
            'solusi' => 'required|string|max:1000',
        ]);

        try {
            $kerusakan = Kerusakan::findOrFail($id);
            $kerusakan->update($request->all());
            return redirect()->route('admin.kerusakan.index')->with('success', 'Kerusakan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui kerusakan: ' . $e->getMessage());
        }
    }
    public function destroy($id) {
        try {
            $kerusakan = Kerusakan::findOrFail($id);
            $kerusakan->delete();
            return redirect()->route('admin.kerusakan.index')->with('success', 'Kerusakan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus kerusakan: ' . $e->getMessage());
        }
    }
}
