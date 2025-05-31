<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\DiagnosaGuestController;
// use App\Http\Controllers\DiagnosaController;

Route::prefix('guest')->group(function () {
    Route::get('/diagnosa', [DiagnosaGuestController::class, 'diagnosa'])->name('guest.diagnosa');
    Route::post('/diagnosa/submit', [DiagnosaGuestController::class, 'submit'])->name('guest.diagnosa.submit');
    Route::get('/hasil', [DiagnosaGuestController::class, 'hasil'])->name('guest.hasil');
    Route::get('/histori', [DiagnosaGuestController::class, 'histori'])->name('guest.histori');
});
