<?php

use \Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('login');


Route::group(['middleware' => 'redirectIfUnauthorized'], function () {
    require __DIR__ . '/admin/admin.php';
    require __DIR__ . '/user/user.php';
    require __DIR__ . '/client/client.php';
    require __DIR__ . '/worker/worker.php';
    require __DIR__ . '/admin/crm.php';
});
require __DIR__ . '/auth.php';
require __DIR__ . '/errors.php';

Route::get('/logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect()->route('login');
})->name('logout');



Route::group(['as' => 'forgot.'], function () {
    Route::get('/forgot-password', [\App\Http\Controllers\ForgotController::class, 'index'])->name('index');
    Route::post('/forgot-password/update', [\App\Http\Controllers\ForgotController::class, 'update'])->name('update');
});
