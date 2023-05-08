<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:user']], function () {
    Route::group(['as' => 'user.'], function () {
        Route::get('dashboard-user', [\App\Http\Controllers\User\IndexController::class, 'index'])->name('index');
    });

    Route::group(['as' => 'idea.'], function (){
        Route::get('ideas', [\App\Http\Controllers\User\IdeaController::class, 'index'])->name('ideas');
        Route::get('ideas/create', [\App\Http\Controllers\User\IdeaController::class, 'create'])->name('idea.create');
        Route::post('ideas/store', [\App\Http\Controllers\User\IdeaController::class, 'store'])->name('idea.store');
        Route::get('ideas/show/{idea}', [\App\Http\Controllers\User\IdeaController::class, 'show'])->name('ideas.show');
        Route::get('ideas/edit/{idea}', [\App\Http\Controllers\User\IdeaController::class, 'edit'])->name('idea.edit');
        Route::patch('ideas/update/{idea}', [\App\Http\Controllers\User\IdeaController::class, 'update'])->name('idea.update');
    });

    Route::group(['as' => 'new-task.'], function (){
        Route::get('/new-task', [\App\Http\Controllers\User\TasksController::class, 'index'])->name('index');



        Route::post('/new-task/accept/{task}', [\App\Http\Controllers\User\TasksController::class, 'accept'])->name('accept');
        Route::post('/new-task/decline/{task}', [\App\Http\Controllers\User\TasksController::class, 'decline'])->name('decline');
    });
});
