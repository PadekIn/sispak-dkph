<?php

use App\Http\Controllers\KerusakanController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/dashboard', function () {
        return view('pages.admin.dashboard');
    })->name('dashboard');

    Route::prefix('kerusakan')->group(function(){
        Route::get('/', [KerusakanController::class, 'index'])->name('kerusakan.index');
        Route::get('/create', [KerusakanController::class, 'create'])->name('kerusakan.create');
        Route::post('/store', [KerusakanController::class, 'store'])->name('kerusakan.store');
        Route::get('/edit/{id}', [KerusakanController::class, 'edit'])->name('kerusakan.edit');
        Route::put('/update/{id}', [KerusakanController::class, 'update'])->name('kerusakan.update');
        Route::delete('/destroy/{id}', [KerusakanController::class, 'destroy'])->name('kerusakan.destroy');
    });

    Route::prefix('gejala')->group(function(){
        Route::get('/', [App\Http\Controllers\GejalaController::class, 'index'])->name('gejala.index');
        Route::get('/create', [App\Http\Controllers\GejalaController::class, 'create'])->name('gejala.create');
        Route::post('/store', [App\Http\Controllers\GejalaController::class, 'store'])->name('gejala.store');
        Route::get('/edit/{id}', [App\Http\Controllers\GejalaController::class, 'edit'])->name('gejala.edit');
        Route::put('/update/{id}', [App\Http\Controllers\GejalaController::class, 'update'])->name('gejala.update');
        Route::delete('/destroy/{id}', [App\Http\Controllers\GejalaController::class, 'destroy'])->name('gejala.destroy');
    });


});
