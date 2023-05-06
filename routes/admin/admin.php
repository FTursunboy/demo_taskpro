<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:admin']], function () {
    Route::group(['as' => 'admin.'], function () {
        Route::get('dashboard-admin', [\App\Http\Controllers\Admin\IndexController::class, 'index'])->name('index');
    });


    Route::group(['as' => 'settings.'], function() {
       Route::get('/settings/project', [\App\Http\Controllers\Admin\ProjectTypeController::class, 'index'])->name('project');
       Route::post('/settings/project/store', [\App\Http\Controllers\Admin\ProjectTypeController::class, 'store'])->name('project.store');
       Route::patch('/settings/project/update/{projectTypeModel}', [\App\Http\Controllers\Admin\ProjectTypeController::class, 'update'])->name('project.update');
       Route::get('/settings/project/delete/{projectTypeModel}', [\App\Http\Controllers\Admin\ProjectTypeController::class, 'delete'])->name('project.delete');

    });


    Route::group(['as' => 'project.'], function () {
        Route::get('/projects', [\App\Http\Controllers\Admin\ProjectController::class, 'index'])->name('index');
        Route::get('/projects/create', [\App\Http\Controllers\Admin\ProjectController::class, 'create'])->name('create');
        Route::post('/project/store', [\App\Http\Controllers\Admin\ProjectController::class, 'store'])->name('store');
    });

});
