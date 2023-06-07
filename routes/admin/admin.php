<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:admin', 'redirectIfUnauthorized']], function () {
    Route::get('notification/{offer}', [\App\Http\Controllers\Admin\IndexController::class, 'delete'])->name('notification');
    Route::get('offers/file/download/{offer}', [\App\Http\Controllers\Client\TaskController::class, 'downloadFile'])->name('offer.file.download');
    Route::get('offers/file/download/chat/{offer}', [\App\Http\Controllers\Client\TaskController::class, 'download_file_chat'])->name('download.file.chat');

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

        Route::get('/settings/task', [\App\Http\Controllers\Admin\TaskTypeController::class, 'index'])->name('task');
        Route::post('/settings/task/store', [\App\Http\Controllers\Admin\TaskTypeController::class, 'store'])->name('task.store');
        Route::patch('/settings/task/update/{taskTypeModel}', [\App\Http\Controllers\Admin\TaskTypeController::class, 'update'])->name('task.update');
        Route::get('/settings/task/delete/{taskTypeModel}', [\App\Http\Controllers\Admin\TaskTypeController::class, 'delete'])->name('task.delete');
        Route::get('/settings/kpi', [\App\Http\Controllers\Admin\TaskTypeController::class, 'kpi'])->name('kpi');

        Route::get('/settings/kpi/{taskTypeModel}', [\App\Http\Controllers\Admin\TaskTypeController::class, 'kpi'])->name('kpi');
        Route::post('/settings/kpi/store', [\App\Http\Controllers\Admin\TaskTypeController::class, 'kpiStore'])->name('kpi.store');
        Route::patch('/settings/kpi/update/{taskTypesTypeModel}', [\App\Http\Controllers\Admin\TaskTypeController::class, 'kpi_update'])->name('kpi.update');
        Route::get('/settings/kpi/delete/{taskTypesTypeModel}', [\App\Http\Controllers\Admin\TaskTypeController::class, 'kpiDelete'])->name('kpi.delete');

        // role
        Route::get('/settings/role', [\App\Http\Controllers\Admin\RoleController::class, 'index'])->name('role');
        Route::post('/settings/store', [\App\Http\Controllers\Admin\RoleController::class, 'store'])->name('role.store');
        Route::patch('/settings/update/{role}', [\App\Http\Controllers\Admin\RoleController::class, 'update'])->name('role.update');
        Route::delete('/settings/destroy/{role}', [\App\Http\Controllers\Admin\RoleController::class, 'destroy'])->name('role.delete');

        // otdel
        Route::get('/settings/depart', [\App\Http\Controllers\Admin\DepartController::class, 'index'])->name('depart');
        Route::post('/settings/depart/store', [\App\Http\Controllers\Admin\DepartController::class, 'store'])->name('depart.store');
        Route::patch('/settings/depart/update/{depart}', [\App\Http\Controllers\Admin\DepartController::class, 'update'])->name('depart.update');
        Route::delete('/settings/depart/destroy/{depart}', [\App\Http\Controllers\Admin\DepartController::class, 'destroy'])->name('depart.delete');
    });


    Route::group(['as' => 'project.'], function () {
        Route::get('/projects', [\App\Http\Controllers\Admin\ProjectController::class, 'index'])->name('index');
        Route::get('/projects/create', [\App\Http\Controllers\Admin\ProjectController::class, 'create'])->name('create');
        Route::post('/projects/store', [\App\Http\Controllers\Admin\ProjectController::class, 'store'])->name('store');
        Route::get('/projects/show/{project}', [\App\Http\Controllers\Admin\ProjectController::class, 'show'])->name('show');
        Route::get('/projects/edit/{project}', [\App\Http\Controllers\Admin\ProjectController::class, 'edit'])->name('edit');
        Route::patch('/projects/edit/{projectModel}/update', [\App\Http\Controllers\Admin\ProjectController::class, 'update'])->name('update');
        Route::delete('/projects/destroy/{projectModel}', [\App\Http\Controllers\Admin\ProjectController::class, 'destroy'])->name('destroy');
        Route::get('/projects/download/{project}', [\App\Http\Controllers\Admin\ProjectController::class, 'downloadFile'])->name('download');
    });

    Route::group(['as' => 'tasks.'], function () {
        Route::get('/tasks', [\App\Http\Controllers\Admin\TasksController::class, 'index'])->name('index');
        Route::get('/tasks/create', [\App\Http\Controllers\Admin\TasksController::class, 'create'])->name('create');
        Route::get('/tasks/show-task/{task}', [\App\Http\Controllers\Admin\TasksController::class, 'show'])->name('show');
        Route::post('/tasks/store', [\App\Http\Controllers\Admin\TasksController::class, 'store'])->name('store');
        Route::delete('/tasks/delete/{task}', [\App\Http\Controllers\Admin\TasksController::class, 'destroy'])->name('delete');
        Route::get('/tasks/download/{task}', [\App\Http\Controllers\Admin\TasksController::class, 'downloadFile'])->name('download');
        Route::patch('/tasks/update/{task}', [\App\Http\Controllers\Admin\TasksController::class, 'update'])->name('update');
        Route::patch('/tasks/sendBack/{task}', [\App\Http\Controllers\Admin\TasksController::class, 'sendBack'])->name('sendBack');
        Route::patch('/tasks/sendBack1/{task}', [\App\Http\Controllers\Admin\TasksController::class, 'sendBack1'])->name('sendBack1');
        Route::get('/tasks/edit/{task}', [\App\Http\Controllers\Admin\TasksController::class, 'edit'])->name('edit');
        Route::post('/tasks/ready/{task}', [\App\Http\Controllers\Admin\TasksController::class, 'ready'])->name('ready');
        Route::post('/tasks/message-show/{task}', [\App\Http\Controllers\Admin\TasksController::class, 'message'])->name('message');
        Route::get('/tasks/new-message/{task}', [\App\Http\Controllers\Admin\TasksController::class, 'removeNotification'])->name('removeNotification');
        Route::get('/tasks/messages/download/{mess}', [\App\Http\Controllers\Admin\ChatController::class, 'downloadFile'])->name('messages.download');

    });

    Route::group(['as' => 'mytasks.'], function () {
       Route::get('/mytasks', [\App\Http\Controllers\Admin\MyTasksController::class, 'index'])->name('index');
    });

    Route::group(['as' => 'employee.'], function () {
        Route::get('/employees', [\App\Http\Controllers\Admin\EmployeeController::class, 'index'])->name('index');
        Route::get('/employees/create', [\App\Http\Controllers\Admin\EmployeeController::class, 'create'])->name('create');
        Route::post('/employees/store', [\App\Http\Controllers\Admin\EmployeeController::class, 'store'])->name('store');
        Route::get('/employees/{slug}', [\App\Http\Controllers\Admin\EmployeeController::class, 'show'])->name('show');
        Route::get('//employees/edit/{slug}', [\App\Http\Controllers\Admin\EmployeeController::class, 'edit'])->name('edit');
        Route::patch('/employees/update/{slug}', [\App\Http\Controllers\Admin\EmployeeController::class, 'update'])->name('update');
        Route::patch('/employees/addRole/{slug}', [\App\Http\Controllers\Admin\EmployeeController::class, 'addRole'])->name('addRole');
        Route::delete('/employees/destroy/{slug}', [\App\Http\Controllers\Admin\EmployeeController::class, 'destroy'])->name('destroy');

        Route::get('/client', [\App\Http\Controllers\Admin\ClientController::class, 'index'])->name('client');
        Route::get('/client/show/{slug}', [\App\Http\Controllers\Admin\ClientController::class, 'show'])->name('client.show');
        Route::get('/client/edit/{slug}', [\App\Http\Controllers\Admin\ClientController::class, 'edit'])->name('client.edit');
        Route::post('/client/store', [\App\Http\Controllers\Admin\ClientController::class, 'store'])->name('client.store');
        Route::patch('/client/update/{slug}', [\App\Http\Controllers\Admin\ClientController::class, 'update'])->name('client.update');
        Route::delete('/client/update/{slug}', [\App\Http\Controllers\Admin\ClientController::class, 'destroy'])->name('client.destroy');


    });
    Route::group(['as' => 'tasks_client.'], function () {
        Route::get('/tasks_client', [\App\Http\Controllers\Admin\TasksClientController::class, 'index'])->name('index');
        Route::get('/tasks_client/create', [\App\Http\Controllers\Admin\TasksClientController::class, 'create'])->name('create');
        Route::post('/tasks_client/store', [\App\Http\Controllers\Admin\TasksClientController::class, 'store'])->name('store');
        Route::get('/tasks_client/show/{task}', [\App\Http\Controllers\Admin\TasksClientController::class, 'show'])->name('show');
        Route::get('/tasks_client/edit/{task}', [\App\Http\Controllers\Admin\TasksClientController::class, 'edit'])->name('edit');
        Route::get('/tasks_client/edit-js/{id}', [\App\Http\Controllers\Admin\TasksClientController::class, 'editJs']);
        Route::patch('/tasks_client/update/{task}', [\App\Http\Controllers\Admin\TasksClientController::class, 'update'])->name('update');
        Route::get('/tasks_client/delete/{task}', [\App\Http\Controllers\Admin\TasksClientController::class, 'delete'])->name('delete');
        Route::patch('/tasks_client/{id}/sendBack', [\App\Http\Controllers\Admin\TasksClientController::class, 'sendBack'])->name('sendBack');
    });

    // for kpi ajax offers
    Route::get('/tasks/tasks/kpi/{id}', [\App\Http\Controllers\Admin\TasksController::class, 'kpi']);
    Route::get('/tasks/edit/tasks/kpi/{id}', [\App\Http\Controllers\Admin\TasksController::class, 'kpi']);

    Route::group(['as' => 'profile.'], function () {
        Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('index');
        Route::get('/profile/edit/', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('edit');
        Route::patch('/profile/update/', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('update');
        Route::get('/profile/show/', [\App\Http\Controllers\Admin\ProfileController::class, 'show'])->name('show');
        Route::post('profile/change-password', [\App\Http\Controllers\Admin\ProfileController::class, 'password'])->name('password');
    });

    Route::group(['as' => 'client.offers.'], function () {
        Route::get('clients/offers', [\App\Http\Controllers\Admin\OfferController::class, 'index'])->name('index');
        Route::get('clients/offers/show/{offer}', [\App\Http\Controllers\Admin\OfferController::class, 'show'])->name('show');
        Route::get('clients/offers/delete/{offer}', [\App\Http\Controllers\Admin\OfferController::class, 'delete'])->name('delete');
        Route::post('clients/offers/send/user/{offer}', [\App\Http\Controllers\Admin\OfferController::class, 'sendUser'])->name('send.user');
        Route::get('clients/offers/edit/{offer}', [\App\Http\Controllers\Admin\OfferController::class, 'edit'])->name('edit');
        Route::get('clients/offers/send/client/{offer}', [\App\Http\Controllers\Admin\OfferController::class, 'sendClient'])->name('send.client');
        Route::post('clients/offers/send/back/{offer}', [\App\Http\Controllers\Admin\OfferController::class, 'sendBack'])->name('send.back');
        Route::get('clients/offers/chat/{offer}', [\App\Http\Controllers\Admin\ChatController::class, 'index'])->name('chat');
        Route::post('clients/offers/chat/store/{offer}', [\App\Http\Controllers\Admin\ChatController::class, 'store'])->name('chat.store');
        Route::get('clients/offers/messages/download/{mess}', [\App\Http\Controllers\Admin\ChatController::class, 'downloadFile'])->name('messages.download');

    });

    Route::group(['as' => 'mon.'], function () {
        Route::get('/monitoring-tasks', [\App\Http\Controllers\Admin\MonitoringController::class, 'index'])->name('index');
        Route::get('/monitoring/show-task/{task}', [\App\Http\Controllers\Admin\MonitoringController::class, 'show'])->name('show');
        Route::get('/monitoring/edit/{task}', [\App\Http\Controllers\Admin\MonitoringController::class, 'edit'])->name('edit');
        Route::patch('/monitoring/update/{task}', [\App\Http\Controllers\Admin\MonitoringController::class, 'update'])->name('update');

        // get task-statuses
        Route::get('/tasks/public/monitoring-tasks-filter/{status}/{user}/{client}/{project}', [\App\Http\Controllers\Admin\MonitoringController::class, 'filter']);
    });


    Route::group(['as' => 'telegram.'], function () {
        Route::get('/telegram', [\App\Http\Controllers\Admin\TelegramController::class, 'index'])->name('index');
        Route::post('/telegram/all', [\App\Http\Controllers\Admin\TelegramController::class, 'sendAll'])->name('sendAll');
        Route::post('/telegram/one/{user}', [\App\Http\Controllers\Admin\TelegramController::class, 'sendOne'])->name('sendOne');
    });

    Route::get('/excel', [\App\Http\Controllers\Admin\ExcelController::class, 'index']);

    Route::post('offers/chat/message/store/{offer}', [\App\Http\Controllers\Admin\TasksController::class, 'message_offer'])->name('offers.chat.message.store');
});
