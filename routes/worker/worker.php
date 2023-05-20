<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:client-worker']], function () {

    Route::group(['as' => 'worker.'], function () {
        Route::get('dashboard-worker', [\App\Http\Controllers\Client\IndexController::class, 'index'])->name('index');
    });



});

