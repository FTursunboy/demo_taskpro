<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:admin']], function () {
    Route::group(['as' => 'admin.'], function () {
        Route::get('dashboard-admin', [\App\Http\Controllers\Admin\IndexController::class, 'index'])->name('index');
        Route::get('admin/ideas', [\App\Http\Controllers\Admin\IdeaController::class, 'index'])->name('ideas');
        Route::get('admin/ideas/show/{idea}', [\App\Http\Controllers\Admin\IdeaController::class, 'show'])->name('idea.show');
        Route::post('admin/ideas/update/{idea}', [\App\Http\Controllers\Admin\IdeaController::class, 'update'])->name('ideas.update');
    });


    Route::group(['as' => 'settings.'], function () {
        Route::get('/settings/project', [\App\Http\Controllers\Admin\ProjectTypeController::class, 'index'])->name('project');
        Route::post('/settings/project/store', [\App\Http\Controllers\Admin\ProjectTypeController::class, 'store'])->name('project.store');
        Route::patch('/settings/project/update/{projectTypeModel}', [\App\Http\Controllers\Admin\ProjectTypeController::class, 'update'])->name('project.update');
        Route::get('/settings/project/delete/{projectTypeModel}', [\App\Http\Controllers\Admin\ProjectTypeController::class, 'delete'])->name('project.delete');

        Route::get('/settings/offers', [\App\Http\Controllers\Admin\TaskTypeController::class, 'index'])->name('task');
        Route::post('/settings/offers/store', [\App\Http\Controllers\Admin\TaskTypeController::class, 'store'])->name('task.store');
        Route::patch('/settings/offers/update/{taskTypeModel}', [\App\Http\Controllers\Admin\TaskTypeController::class, 'update'])->name('task.update');
        Route::get('/settings/offers/delete/{taskTypeModel}', [\App\Http\Controllers\Admin\TaskTypeController::class, 'delete'])->name('task.delete');
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

    Route::group(['as' => 'tasks.'], function () {
        Route::get('/tasks', [\App\Http\Controllers\Admin\TasksController::class, 'index'])->name('index');
        Route::get('/tasks/create', [\App\Http\Controllers\Admin\TasksController::class, 'create'])->name('create');
        Route::get('/tasks/show-task/{task}', [\App\Http\Controllers\Admin\TasksController::class, 'show'])->name('show');
        Route::post('/tasks/store', [\App\Http\Controllers\Admin\TasksController::class, 'store'])->name('store');
        Route::delete('/tasks/delete/{task}', [\App\Http\Controllers\Admin\TasksController::class, 'destroy'])->name('delete');

        Route::post('/tasks/ready/{task}', [\App\Http\Controllers\Admin\TasksController::class, 'ready'])->name('ready');
        Route::post('/tasks/message-show/{task}', [\App\Http\Controllers\Admin\TasksController::class, 'message'])->name('message');
    });

    Route::group(['as' => 'employee.'], function () {
        Route::get('/employees', [\App\Http\Controllers\Admin\EmployeeController::class, 'index'])->name('index');
        Route::get('/employees/create', [\App\Http\Controllers\Admin\EmployeeController::class, 'create'])->name('create');
        Route::post('/employees/store', [\App\Http\Controllers\Admin\EmployeeController::class, 'store'])->name('store');
        Route::get('/employees/{user}', [\App\Http\Controllers\Admin\EmployeeController::class, 'show'])->name('show');
        Route::patch('/employees/update/{employee}', [\App\Http\Controllers\Admin\EmployeeController::class, 'update'])->name('update');
        Route::delete('/employees/destroy/{employee}', [\App\Http\Controllers\Admin\EmployeeController::class, 'destroy'])->name('destroy');

        Route::get('/client', [\App\Http\Controllers\Admin\ClientController::class, 'index'])->name('client');
        Route::post('/client/store', [\App\Http\Controllers\Admin\ClientController::class, 'store'])->name('client.store');
        Route::patch('/client/update/{user}', [\App\Http\Controllers\Admin\ClientController::class, 'update'])->name('client.update');

    });


    // for kpi ajax offers
    Route::get('/tasks/tasks/kpi/{id}', [\App\Http\Controllers\Admin\TasksController::class, 'kpi']);

    Route::group(['as' => 'profile.'], function () {
        Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('index');
        Route::post('profile/change-password', [\App\Http\Controllers\Admin\ProfileController::class, 'password'])->name('password');
    });

    Route::group(['as' => 'client.offers.'], function () {
        Route::get('clients/offers', [\App\Http\Controllers\Admin\OfferController::class, 'index'])->name('index');
        Route::get('clients/offers/show/{offer}', [\App\Http\Controllers\Admin\OfferController::class, 'show'])->name('show');
        Route::get('clients/offers/delete/{offer}', [\App\Http\Controllers\Admin\OfferController::class, 'delete'])->name('delete');
        Route::post('clients/offers/send/user/{offer}', [\App\Http\Controllers\Admin\OfferController::class, 'sendUser'])->name('send.user');
        Route::get('clients/offers/edit/{offer}', [\App\Http\Controllers\Admin\OfferController::class, 'edit'])->name('edit');
        Route::get('clients/offers/send/client/{offer}', [\App\Http\Controllers\Admin\OfferController::class, 'sendClient'])->name('send.client');
    });

    Route::group(['as' => 'mon.'], function () {
        Route::get('/monitoring-tasks', [\App\Http\Controllers\Admin\MonitoringController::class, 'index'])->name('index');

        // get task-statuses
        Route::get('/monitoring-tasks-filter/{status}/{user}/{client}/{project}', [\App\Http\Controllers\Admin\MonitoringController::class, 'filter']);
    });


    Route::group(['as' => 'telegram.'], function () {
        Route::get('/telegram', [\App\Http\Controllers\Admin\TelegramController::class, 'index'])->name('index');
        Route::post('/telegram/all', [\App\Http\Controllers\Admin\TelegramController::class, 'sendAll'])->name('sendAll');
        Route::post('/telegram/one/{user}', [\App\Http\Controllers\Admin\TelegramController::class, 'sendOne'])->name('sendOne');
    });


});
