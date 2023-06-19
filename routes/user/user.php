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
        Route::post('/user/ideas/store', [\App\Http\Controllers\User\IdeaController::class, 'store'])->name('idea.store');
        Route::patch('/user/ideas/update/{idea}', [\App\Http\Controllers\User\IdeaController::class, 'update'])->name('idea.update');
        Route::delete('/user/ideas/delete/{idea}', [\App\Http\Controllers\User\IdeaController::class, 'destroy'])->name('idea.destroy');
        Route::get('/user/ideas/downloadFile/{idea}', [\App\Http\Controllers\User\IdeaController::class, 'downloadFile'])->name('idea.downloadFile');

        Route::post('/user/system-ideas/store', [\App\Http\Controllers\User\SystemIdeaController::class, 'store'])->name('system.ideas.store');
        Route::patch('/user/system-ideas/update/{idea}', [\App\Http\Controllers\User\SystemIdeaController::class, 'update'])->name('system.ideas.update');
        Route::delete('/user/system-ideas/delete/{idea}', [\App\Http\Controllers\User\SystemIdeaController::class, 'destroy'])->name('system.ideas.destroy');
        Route::get('/user/system-ideas/downloadFile/{idea}', [\App\Http\Controllers\User\SystemIdeaController::class, 'downloadFile'])->name('system.downloadFileUser');

    });


    Route::group(['as' => 'task-list.'], function () {
        Route::get('/task-list/{slug}', [\App\Http\Controllers\User\TaskListController::class, 'show'])->name('show');
        Route::get('/task-list/new-message/{task}', [\App\Http\Controllers\User\TaskListController::class, 'removeNotification'])->name('removeNotification');

        Route::post('/task-list/ready/{task}', [\App\Http\Controllers\User\TaskListController::class, 'ready'])->name('ready');
        Route::post('/task-list/decline/{task}', [\App\Http\Controllers\User\TaskListController::class, 'decline'])->name('decline');
    });

    Route::group(['as' => 'messages.'], function () {
        Route::post('/messages/{task}', [\App\Http\Controllers\Admin\MessagesController::class, 'message'])->name('messages');
        Route::post('/messages/download/{mess}', [\App\Http\Controllers\Admin\MessagesController::class, 'downloadFile'])->name('download');
        Route::get('/messages/delete/{mess}', [\App\Http\Controllers\Admin\MessagesController::class, 'delete'])->name('delete');
    });

    Route::group(['as' => 'new-task.'], function () {
        Route::get('/new-task', [\App\Http\Controllers\User\TasksController::class, 'index'])->name('index');
        Route::post('/new-task/accept/{task}', [\App\Http\Controllers\User\TasksController::class, 'accept'])->name('accept');
        Route::post('/new-task/decline/{task}', [\App\Http\Controllers\User\TasksController::class, 'decline'])->name('decline');
        Route::get('/new-task/download/{task}', [\App\Http\Controllers\User\TasksController::class, 'downloadFile'])->name('download');
    });

    Route::group(['as' => 'all-tasks.'], function () {
        Route::get('/my-all-tasks', [\App\Http\Controllers\User\GetAllTasksController::class, 'index'])->name('index');
        Route::get('/my-all-tasks/{task}', [\App\Http\Controllers\User\GetAllTasksController::class, 'show'])->name('show');
        Route::post('/my-all-tasks/{task}/store', [\App\Http\Controllers\User\GetAllTasksController::class, 'store'])->name('store');
        Route::get('/my-all-tasks/download/{mess}', [\App\Http\Controllers\User\GetAllTasksController::class, 'downloadFile'])->name('download');
    });

    Route::group(['as' => 'my-command.'], function () {
        Route::get('/my-command', [\App\Http\Controllers\User\MyCommandController::class, 'index'])->name('index');


        Route::post('/my-command/create-task', [\App\Http\Controllers\User\MyCommandController::class, 'createTaskInCommand'])->name('createTaskInCommand');
        Route::get('/my-command/tasks-in-query/', [\App\Http\Controllers\User\MyCommandController::class, 'taskInQuery'])->name('taskInQuery');

        Route::get('/my-command/tasks-in-query/delete/{id}', [\App\Http\Controllers\User\MyCommandController::class, 'taskInQueryDelete'])->name('taskInQueryDelete');
    });

    Route::get('user/offers/file/download/chat/{mess}', [\App\Http\Controllers\User\TasksController::class, 'download_file_chat'])->name('user.download.file.chat');

    Route::group(['as' => 'plan.'], function () {
        Route::get('/my-plan', [\App\Http\Controllers\User\MyPlanController::class, 'index'])->name('index');
        Route::post('/my-plan/store', [\App\Http\Controllers\User\MyPlanController::class, 'store'])->name('store');
        Route::patch('/my-plan/update/{plan}',[\App\Http\Controllers\User\MyPlanController::class, 'update'])->name('update');
        Route::get('/my-plan/ready/{plan}', [\App\Http\Controllers\User\MyPlanController::class, 'ready'])->name('ready');
        Route::get('/my-plan/delete/{plan}', [\App\Http\Controllers\User\MyPlanController::class, 'delete'])->name('delete');
    });

    Route::group(['as' => 'notes.'], function (){
       Route::post('/notes/store', [\App\Http\Controllers\Users\NotesController::class,'store'])->name('store');
       Route::patch('/notes/update/{note}', [\App\Http\Controllers\Users\NotesController::class,'update'])->name('update');
       Route::delete('/notes/delete/{note}', [\App\Http\Controllers\Users\NotesController::class,'destroy'])->name('delete');
    });
});
