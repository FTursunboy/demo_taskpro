<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:user']], function () {
    Route::group(['as' => 'admin.'], function () {
        Route::get('dashboard-user', [\App\Http\Controllers\User\IndexController::class, 'index'])->name('index');
    });
});
