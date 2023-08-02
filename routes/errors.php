<?php

use \Illuminate\Support\Facades\Route;

Route::group(['as' => 'error.'], function () {
    Route::get('error-404/error', [\App\Http\Controllers\Errors\ErrorsController::class, 'error404'])->name('error404');
 Route::get('error-404/send', [\App\Http\Controllers\Errors\ErrorsController::class, 'send404'])->name('send404');
});

