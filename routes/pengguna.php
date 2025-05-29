<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'isPengguna'])->group(function () {



});
