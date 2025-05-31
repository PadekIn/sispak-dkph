<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pengguna\DiagnosaPenggunaController;

Route::middleware(['web','auth', 'isPengguna'])->prefix('pengguna')->group(function () {
    Route::get('/diagnosa', [DiagnosaPenggunaController::class, 'diagnosa'])->name('pengguna.diagnosa');
    Route::post('/diagnosa/submit', [DiagnosaPenggunaController::class, 'submit'])->name('pengguna.diagnosa.submit');
    Route::get('/hasil', [DiagnosaPenggunaController::class, 'hasil'])->name('pengguna.hasil');
    Route::get('/histori', [DiagnosaPenggunaController::class, 'histori'])->name('pengguna.histori');
});
