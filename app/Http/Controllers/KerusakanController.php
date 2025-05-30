<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kerusakan;

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
            'nama_kerusakan' => 'required|string|max:255',
            'jenis_kerusakan' => 'required|string|max:255',
            'solusi' => 'required|string|max:1000',
        ]);

        try {
            Kerusakan::create($request->all());
            return redirect()->route('kerusakan.index')->with('success', 'Kerusakan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan kerusakan: ' . $e->getMessage());
        }
    }
    public function edit(Kerusakan $kerusakan) {
        return view('pages.admin.kerusakan.edit', compact('kerusakan'));
    }
    public function update(Request $request, Kerusakan $kerusakan) {
        $request->validate([
            'nama_kerusakan' => 'required|string|max:255',
            'jenis_kerusakan' => 'required|string|max:255',
            'solusi' => 'required|string|max:1000',
        ]);

        try {
            $kerusakan->update($request->all());
            return redirect()->route('kerusakan.index')->with('success', 'Kerusakan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui kerusakan: ' . $e->getMessage());
        }
    }
    public function destroy(Kerusakan $kerusakan) {
        try {
            $kerusakan->delete();
            return redirect()->route('kerusakan.index')->with('success', 'Kerusakan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus kerusakan: ' . $e->getMessage());
        }
    }
}
