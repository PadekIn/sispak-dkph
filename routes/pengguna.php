<?php

use Illuminate\Support\Facades\Route;


Route::prefix('pengguna')->group(function () {
    Route::get('/diagnosa', function () {
        return view('pages.pengguna.dashboard.diagnosa');
    })->name('pengguna.diagnosa');
    Route::get('/histori', function () {
        return view('pages.pengguna.history.index');
    })->name('pengguna.histori');
});
