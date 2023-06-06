<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:user']], function () {
    Route::group(['as' => 'user.'], function () {
        Route::get('dashboard-user', [\App\Http\Controllers\User\IndexController::class, 'index'])->name('index');
        Route::get('dashboard-user/download/{task}', [\App\Http\Controllers\User\IndexController::class, 'downloadFile'])->name('download');
        Route::get('dashboard-user/downloadChat/{task}', [\App\Http\Controllers\User\IndexController::class, 'downloadFileChat'])->name('downloadChat');
    });

    Route::get('/user/profile/', [\App\Http\Controllers\User\ProfileController::class, 'index'])->name('user_profile.index');
    Route::patch('/user/profile/update/', [\App\Http\Controllers\User\ProfileController::class, 'update'])->name('user_profile.update.a');
    Route::post('/user/profile/change-password', [\App\Http\Controllers\User\ProfileController::class, 'password'])->name('user_profile.password');

    Route::group(['as' => 'idea.'], function () {
        Route::get('ideas', [\App\Http\Controllers\User\IdeaController::class, 'index'])->name('ideas');
        Route::get('ideas/create', [\App\Http\Controllers\User\IdeaController::class, 'create'])->name('idea.create');
        Route::post('ideas/store', [\App\Http\Controllers\User\IdeaController::class, 'store'])->name('idea.store');
        Route::get('ideas/show/{idea}', [\App\Http\Controllers\User\IdeaController::class, 'show'])->name('ideas.show');
        Route::get('ideas/edit/{idea}', [\App\Http\Controllers\User\IdeaController::class, 'edit'])->name('idea.edit');
        Route::patch('ideas/update/{idea}', [\App\Http\Controllers\User\IdeaController::class, 'update'])->name('idea.update');
    });


    Route::group(['as' => 'task-list.'], function () {
        Route::get('/task-list/{task}', [\App\Http\Controllers\User\TaskListController::class, 'show'])->name('show');
        Route::get('/task-list/new-message/{task}', [\App\Http\Controllers\User\TaskListController::class, 'removeNotification'])->name('removeNotification');

        Route::post('/task-list/ready/{task}', [\App\Http\Controllers\User\TaskListController::class, 'ready'])->name('ready');
    });

    Route::group(['as' => 'messages.'], function () {
        Route::post('/messages/{task}', [\App\Http\Controllers\Admin\MessagesController::class, 'message'])->name('messages');
        Route::post('/messages/download/{mess}', [\App\Http\Controllers\Admin\MessagesController::class, 'downloadFile'])->name('download');
    });

    Route::group(['as' => 'new-task.'], function () {
        Route::get('/new-task', [\App\Http\Controllers\User\TasksController::class, 'index'])->name('index');
        Route::post('/new-task/accept/{task}', [\App\Http\Controllers\User\TasksController::class, 'accept'])->name('accept');
        Route::post('/new-task/decline/{task}', [\App\Http\Controllers\User\TasksController::class, 'decline'])->name('decline');

    });
});
