<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:client']], function () {
    Route::group(['as' => 'admin.'], function () {
        Route::get('dashboard-client', [\App\Http\Controllers\Client\IndexController::class, 'index'])->name('index');
    });
});

