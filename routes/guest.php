<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosaController;

Route::prefix('guest')->group(function () {
    Route::get('/diagnosa', function () {
        $gejalas = \App\Models\Gejala::all();
        return view('pages.guest.diagnosa', compact('gejalas'));
    })->name('guest.diagnosa');

    Route::post('/diagnosa/submit', [DiagnosaController::class, 'submit'])->name('guest.diagnosa.submit');

    Route::get('/hasil', function () {
        $result = session('diagnosa_result');
        if (!$result) {
            return redirect()->route('guest.diagnosa')->with('error', 'Silakan lakukan diagnosa terlebih dahulu');
        }
        return view('pages.guest.hasil', compact('result'));
    })->name('guest.hasil');

    Route::get('/histori', function () {
        return view('pages.guest.histori');
    })->name('guest.histori');
});
