<?php

use Illuminate\Support\Facades\Route;


Route::prefix('pengguna')->group(function () {
    Route::get('/kuesioner', function () {
        return view('pages.pengguna.dashboard.kuesioner');
    })->name('pengguna.kuesioner');

});
