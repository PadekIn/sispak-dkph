<?php

use Illuminate\Support\Facades\Route;


Route::prefix('guest')->group(function () {
    Route::get('/diagnosa', function () {
        return view('pages.guest.diagnosa');
    })->name('guest.diagnosa');
    Route::get('/histori', function () {
        return view('pages.guest.histori');
    })->name('guest.histori');


});
