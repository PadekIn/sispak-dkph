<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['web','auth', 'isPengguna'])->prefix('pengguna')->group(function () {
    Route::get('/diagnosa', function () {
        return view('pages.pengguna.dashboard.diagnosa');
    })->name('pengguna.diagnosa');
    Route::get('/hasil', function () {
        return view('pages.pengguna.dashboard.hasil');
    })->name('pengguna.hasil');
    Route::get('/histori', function () {
        return view('pages.pengguna.history.index');
    })->name('pengguna.histori');
});
