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
});
