<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:incs']], function () {
    Route::get('dashboard-clients', [\App\Http\Controllers\Client\IndexController::class, 'index'])->name('index');
});

