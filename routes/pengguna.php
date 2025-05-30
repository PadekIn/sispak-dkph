<?php

use Illuminate\Support\Facades\Route;


Route::prefix('pengguna')->group(function () {
    Route::get('/kuesioner', function () {
        return view('pages.pengguna.dashboard.kuesioner');
    })->name('pengguna.kuesioner');
    Route::get('/histori', function () {
        return view('pages.pengguna.history.index');
    })->name('pengguna.histori');
});
