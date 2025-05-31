<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\History;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;


class HistoryController extends Controller
{
    public function indexPengguna() {
        try {
            $histories = session('histories', []);
            return view('pages.admin.history.index', compact('histories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengambil data riwayat: ' . $e->getMessage());
        }
    }

    public function indexAdmin() {
        try {
            $histories = History::with('user')->get();
            return view('pages.admin.history.index', compact('histories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengambil data riwayat: ' . $e->getMessage());
        }
    }


}
