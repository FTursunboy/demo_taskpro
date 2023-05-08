<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:client']], function () {

    Route::group(['as' => 'client.'], function () {
        Route::get('dashboard-client', [\App\Http\Controllers\Client\IndexController::class, 'index'])->name('index');
    });


    Route::group(['as' => 'offers.'], function () {
       Route::get('offers', [\App\Http\Controllers\Client\TaskController::class, 'index'])->name('index');
       Route::get('offers/create', [\App\Http\Controllers\Client\TaskController::class, 'create'])->name('create');
       Route::post('offers/store', [\App\Http\Controllers\Client\TaskController::class, 'store'])->name('store');
       Route::get('offers/edit/{offer}', [\App\Http\Controllers\Client\TaskController::class, 'edit'])->name('edit');
       Route::patch('offers/update/{offer}', [\App\Http\Controllers\Client\TaskController::class, 'update'])->name('update');
       Route::get('offers/delete/{offer}', [\App\Http\Controllers\Client\TaskController::class, 'delete'])->name('delete');
       Route::get('offers/show/{offer}', [\App\Http\Controllers\Client\TaskController::class, 'show'])->name('show');
    });
});

