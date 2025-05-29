<?php

use Illuminate\Support\Facades\Route;


Route::prefix('guest')->group(function () {
    Route::get('/kuesioner', function () {
        return view('pages.guest.kuesioner');
    })->name('guest.kuesioner');
    Route::get('/histori', function () {
        return view('pages.guest.histori');
    })->name('guest.histori');


});
