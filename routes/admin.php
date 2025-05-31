<?php

use App\Http\Controllers\Admin\KerusakanController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\Admin\PertanyaanController;
use App\Http\Controllers\Admin\GejalaController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth', 'isAdmin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.admin.dashboard.index');
    })->name('admin.dashboard');

    Route::prefix('kerusakan')->group(function(){
        Route::get('/', [KerusakanController::class, 'index'])->name('admin.kerusakan.index');
        Route::get('/create', [KerusakanController::class, 'create'])->name('admin.kerusakan.create');
        Route::post('/store', [KerusakanController::class, 'store'])->name('admin.kerusakan.store');
        Route::get('/edit/{id}', [KerusakanController::class, 'edit'])->name('admin.kerusakan.edit');
        Route::put('/update/{id}', [KerusakanController::class, 'update'])->name('admin.kerusakan.update');
        Route::delete('/destroy/{id}', [KerusakanController::class, 'destroy'])->name('admin.kerusakan.destroy');
    });

    Route::prefix('gejala')->group(function(){
        Route::get('/', [GejalaController::class, 'index'])->name('admin.gejala.index');
        Route::get('/create', [GejalaController::class, 'create'])->name('admin.gejala.create');
        Route::post('/store', [GejalaController::class, 'store'])->name('admin.gejala.store');
        Route::get('/edit/{id}', [GejalaController::class, 'edit'])->name('admin.gejala.edit');
        Route::put('/update/{id}', [GejalaController::class, 'update'])->name('admin.gejala.update');
        Route::delete('/destroy/{id}', [GejalaController::class, 'destroy'])->name('admin.gejala.destroy');
    });

    Route::prefix('pertanyaan')->group(function(){
        Route::get('/', [PertanyaanController::class, 'index'])->name('admin.pertanyaan.index');
        Route::get('/create', [PertanyaanController::class, 'create'])->name('admin.pertanyaan.create');
        Route::post('/store', [PertanyaanController::class, 'store'])->name('admin.pertanyaan.store');
        Route::get('/edit/{id}', [PertanyaanController::class, 'edit'])->name('admin.pertanyaan.edit');
        Route::put('/update/{id}', [PertanyaanController::class, 'update'])->name('admin.pertanyaan.update');
        Route::delete('/destroy/{id}', [PertanyaanController::class, 'destroy'])->name('admin.pertanyaan.destroy');
    });

    Route::prefix('history')->group(function(){
        Route::get('/', [HistoryController::class, 'indexAdmin'])->name('admin.history.index');
    });

    Route::prefix('user')->group(function(){
        Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
        Route::post('/store', [UserController::class, 'store'])->name('admin.user.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
        Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');
    });
});
