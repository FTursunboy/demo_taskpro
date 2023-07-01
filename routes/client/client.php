<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:client|client-worker']], function () {

    Route::group(['as' => 'client.'], function () {
        Route::get('dashboard-client', [\App\Http\Controllers\Client\IndexController::class, 'index'])->name('index');
        Route::get('/dashboard-client/new-message/{task}', [\App\Http\Controllers\Client\IndexController::class, 'removeNotification'])->name('removeNotification');
        Route::get('/dashboard-client/verificate_tasks', [\App\Http\Controllers\Client\IndexController::class, 'verificate_tasks'])->name('verificate_tasks');
        Route::get('/dashboard-client/ready', [\App\Http\Controllers\Client\IndexController::class, 'ready'])->name('ready');
        Route::get('/dashboard-client/inProgress', [\App\Http\Controllers\Client\IndexController::class, 'inProgress'])->name('inProgress');


    });

    Route::group(['as' => 'client_profile.'], function () {
        Route::get('client_profile/', [\App\Http\Controllers\Client\ProfileController::class, 'index'])->name('index');
        Route::patch('client_profile/update/', [\App\Http\Controllers\Client\ProfileController::class, 'update'])->name('update.a');
        Route::post('client_profile/change_password', [\App\Http\Controllers\Client\ProfileController::class, 'password'])->name('password');

    });

    Route::group(['as' => 'client.tasks.'], function () {
        Route::get('client/task', [\App\Http\Controllers\TaskController::class, 'index'])->name('index');
        Route::get('client/task/accept/{task}', [\App\Http\Controllers\TaskController::class, 'accept'])->name('accept');
        Route::get('client/task/show/{task}', [\App\Http\Controllers\TaskController::class, 'show'])->name('show');
        Route::post('client/task/decline/{task}', [\App\Http\Controllers\TaskController::class, 'decline'])->name('decline');
    });

    Route::group(['as' => 'offers.'], function () {
        Route::get('offers', [\App\Http\Controllers\Client\TaskController::class, 'index'])->name('index');
        Route::get('offers/create', [\App\Http\Controllers\Client\TaskController::class, 'create'])->name('create');
        Route::post('offers/store', [\App\Http\Controllers\Client\TaskController::class, 'store'])->name('store');
        Route::get('offers/edit/{offer}', [\App\Http\Controllers\Client\TaskController::class, 'edit'])->name('edit');
        Route::patch('offers/update/{offer}', [\App\Http\Controllers\Client\TaskController::class, 'update'])->name('update');
        Route::delete('offers/delete/{offer}', [\App\Http\Controllers\Client\TaskController::class, 'delete'])->name('delete');
        Route::get('offers/show/{slug}', [\App\Http\Controllers\Client\TaskController::class, 'show'])->name('show');
        Route::get('offers/download/{offer}', [\App\Http\Controllers\Client\TaskController::class, 'downloadFile'])->name('download');
        Route::get('offers/ready/{offer}', [\App\Http\Controllers\Client\TaskController::class, 'ready'])->name('ready');
        Route::post('offers/decline/{offer}', [\App\Http\Controllers\Client\TaskController::class, 'decline'])->name('decline');
        Route::get('offers/chat/{offer}', [\App\Http\Controllers\Client\ChatController::class, 'index'])->name('chat');
        Route::post('offers/chat/store/{offer}', [\App\Http\Controllers\Client\ChatController::class, 'store'])->name('message');

        Route::get('offers/messages/{offer}', [\App\Http\Controllers\Client\ChatController::class, 'index'])->name('messages');
        Route::post('offers/messages/store/{offer}', [\App\Http\Controllers\Client\ChatController::class, 'store'])->name('messages.store');
        Route::get('offers/messages/download/{mess}', [\App\Http\Controllers\Client\ChatController::class, 'downloadFile'])->name('messages.download');
        Route::get('offers/messages/delete/{mess}', [\App\Http\Controllers\Client\ChatController::class, 'delete'])->name('messages.delete');

    });

    Route::group(['as' => 'client.workers.'], function () {
        Route::get('client/worker', [\App\Http\Controllers\Client\WorkerController::class, 'index'])->name('index');
        Route::post('client/worker/store', [\App\Http\Controllers\Client\WorkerController::class, 'store'])->name('store');
        Route::get('client/worker/show/{user}', [\App\Http\Controllers\Client\WorkerController::class, 'show'])->name('show');
        Route::get('/client/worker/edit/{slug}', [\App\Http\Controllers\Client\WorkerController::class, 'edit'])->name('edit');
        Route::post('/client/worker/store', [\App\Http\Controllers\Client\WorkerController::class, 'store'])->name('store');
        Route::patch('/client/worker/update/{slug}', [\App\Http\Controllers\Client\WorkerController::class, 'update'])->name('update');
        Route::delete('/client/worker/update/{slug}', [\App\Http\Controllers\Client\WorkerController::class, 'destroy'])->name('destroy');
    });

    Route::group(['as' => 'client.system-idea.'], function () {
        Route::post('/client/system-ideas/store', [\App\Http\Controllers\Client\SystemIdeaController::class, 'store'])->name('store');
        Route::patch('/client/system-ideas/update/{idea}', [\App\Http\Controllers\Client\SystemIdeaController::class, 'update'])->name('update');
        Route::delete('/client/system-ideas/delete/{idea}', [\App\Http\Controllers\Client\SystemIdeaController::class, 'destroy'])->name('destroy');
        Route::get('/client/system-ideas/downloadFile/{idea}', [\App\Http\Controllers\Client\SystemIdeaController::class, 'downloadFile'])->name('downloadFile');
    });

    Route::post('score/{offer}', [\App\Http\Controllers\Client\RatingController::class, 'score'])->name('score');
    Route::get('offers/ready/', [\App\Http\Controllers\Client\TaskController::class, 'show_ready'])->name('show_ready');
    Route::get('offers/done/', [\App\Http\Controllers\Client\TaskController::class, 'show_done'])->name('show_finish');
    Route::get('offers/in_progress/', [\App\Http\Controllers\Client\TaskController::class, 'show_progress'])->name('show_progress');
});

