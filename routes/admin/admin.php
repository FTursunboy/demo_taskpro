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

       Route::get('/settings/tasks', [\App\Http\Controllers\Admin\TaskTypeController::class, 'index'])->name('task');
       Route::post('/settings/tasks/store', [\App\Http\Controllers\Admin\TaskTypeController::class, 'store'])->name('task.store');
       Route::patch('/settings/tasks/update/{taskTypeModel}', [\App\Http\Controllers\Admin\TaskTypeController::class, 'update'])->name('task.update');
       Route::get('/settings/tasks/delete/{taskTypeModel}', [\App\Http\Controllers\Admin\TaskTypeController::class, 'delete'])->name('task.delete');
       Route::get('/settings/kpi', [\App\Http\Controllers\Admin\TaskTypeController::class, 'kpi'])->name('kpi');

       Route::get('/settings/kpi/{taskTypeModel}', [\App\Http\Controllers\Admin\TaskTypeController::class, 'kpi'])->name('kpi');
       Route::post('/settings/kpi/store', [\App\Http\Controllers\Admin\TaskTypeController::class, 'kpiStore'])->name('kpi.store');
       Route::patch('/settings/kpi/update/{taskTypesTypeModel}', [\App\Http\Controllers\Admin\TaskTypeController::class, 'kpi_update'])->name('kpi.update');
       Route::get('/settings/kpi/delete/{taskTypesTypeModel}', [\App\Http\Controllers\Admin\TaskTypeController::class, 'kpiDelete'])->name('kpi.delete');

    });


    Route::group(['as' => 'project.'], function () {
        Route::get('/projects', [\App\Http\Controllers\Admin\ProjectController::class, 'index'])->name('index');
        Route::get('/projects/create', [\App\Http\Controllers\Admin\ProjectController::class, 'create'])->name('create');
        Route::post('/projects/store', [\App\Http\Controllers\Admin\ProjectController::class, 'store'])->name('store');
        Route::get('/projects/show/{project}', [\App\Http\Controllers\Admin\ProjectController::class, 'show'])->name('show');
        Route::get('/projects/edit/{project}', [\App\Http\Controllers\Admin\ProjectController::class, 'edit'])->name('edit');
        Route::patch('/projects/edit/{projectModel}/update', [\App\Http\Controllers\Admin\ProjectController::class, 'update'])->name('update');
        Route::delete('/projects/destroy/{projectModel}', [\App\Http\Controllers\Admin\ProjectController::class, 'destroy'])->name('destroy');
    });

});
