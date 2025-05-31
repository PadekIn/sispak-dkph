<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Gejala;
use App\Models\Pertanyaan;
use App\Models\Rule;
use App\Models\Kerusakan;
use Illuminate\Routing\Controller;

class RuleController extends Controller
{
    public function index()
    {
        try {
            $rules = Rule::with(['kerusakan', 'gejala'])->get();
            return view('rule.index', compact('rules'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengambil data aturan: ' . $e->getMessage());
        }
    }
}
