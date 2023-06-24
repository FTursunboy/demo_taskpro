<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:admin', 'redirectIfUnauthorized']], function () {
    Route::get('notification/{offer}', [\App\Http\Controllers\Admin\IndexController::class, 'delete'])->name('notification');
    Route::get('offers/file/download/{offer}', [\App\Http\Controllers\Client\TaskController::class, 'downloadFile'])->name('offer.file.download');
    Route::get('offers/file/download/chat/{offer}', [\App\Http\Controllers\Client\TaskController::class, 'download_file_chat'])->name('download.file.chat');

    Route::group(['as' => 'admin.'], function () {
        Route::get('dashboard-admin', [\App\Http\Controllers\Admin\IndexController::class, 'index'])->name('index');
        Route::get('dasboard-admin/birthday', [\App\Http\Controllers\Admin\IndexController::class, 'birthday'])->name('birthday');

        Route::get('/monitoring-statistics-filter/{month}', [\App\Http\Controllers\Admin\IndexController::class, 'filter'])->name('filter');


        Route::post('admin/ideas/update/{idea}', [\App\Http\Controllers\Admin\IdeaController::class, 'update'])->name('ideas.update');
        Route::get('admin/ideas/downloadFile/{idea}', [\App\Http\Controllers\Admin\IdeaController::class, 'downloadFile'])->name('ideas.downloadFile');
        Route::post('admin/system-ideas/update/{idea}', [\App\Http\Controllers\Admin\SystemIdeaController::class, 'update'])->name('system-ideas.update');
        Route::delete('admin/system-ideas/delete/{idea}', [\App\Http\Controllers\Admin\SystemIdeaController::class, 'delete'])->name('system-ideas.delete');
        Route::get('admin/system-ideas/downloadFile/{idea}', [\App\Http\Controllers\Admin\SystemIdeaController::class, 'downloadFile'])->name('system-ideas.downloadFile');
        Route::delete('admin/ideas/delete/{idea}', [\App\Http\Controllers\Admin\IdeaController::class, 'delete'])->name('idea.delete');
        Route::get('dashboard-admin/crm', [\App\Http\Controllers\Admin\IndexController::class, 'crm'])->name('crm');

        Route::get('tasks/speed-tasks', [\App\Http\Controllers\Admin\IndexController::class, 'speed'])->name('speed');
        Route::get('tasks/success/status', [\App\Http\Controllers\Admin\MonitoringController::class, 'ready'])->name('success');
        Route::get('tasks/out_of_date', [\App\Http\Controllers\Admin\MonitoringController::class, 'out_of_date'])->name('out_of_date');
        Route::get('tasks/task', [\App\Http\Controllers\Admin\MonitoringController::class, 'progress'])->name('progress');
        Route::get('tasks/clientVerification', [\App\Http\Controllers\Admin\MonitoringController::class, 'clientVerification'])->name('clientVerification');
        Route::get('tasks/adminVerification', [\App\Http\Controllers\Admin\MonitoringController::class, 'adminVerification'])->name('adminVerification');

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
        Route::post('/projects/show/close{project}', [\App\Http\Controllers\Admin\ProjectController::class, 'close'])->name('close');
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
        Route::get('/tasks/message/delete/{mess}', [\App\Http\Controllers\Admin\TasksController::class, 'delete'])->name('messages.delete');
        Route::get('/tasks/new-message/{task}', [\App\Http\Controllers\Admin\TasksController::class, 'removeNotification'])->name('removeNotification');
        Route::get('/tasks/messages/download/{mess}', [\App\Http\Controllers\Admin\ChatController::class, 'downloadFile'])->name('messages.download');
        Route::get('/tasks/user/send/back/{task}', [\App\Http\Controllers\Admin\TasksController::class, 'userSendBack'])->name('user.send.back');

        Route::post('/tasks/score', [\App\Http\Controllers\Admin\AdminRatingController::class, 'score'])->name('score');
    });

    Route::group(['as' => 'mytasks.'], function () {
        Route::get('/mytasks', [\App\Http\Controllers\Admin\MyTasksController::class, 'index'])->name('index');
        Route::post('/mytasks/done/{task}', [\App\Http\Controllers\Admin\MyTasksController::class, 'done'])->name('done');

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


        // teamLead
        Route::post('/team-lead/{employee}', [\App\Http\Controllers\Admin\EmployeeController::class, 'makeTeamLead'])->name('teamLead');
        Route::post('/team-lead/{project}/{teamLead}', [\App\Http\Controllers\Admin\EmployeeController::class, 'deleteFromCommand'])->name('delete-from-command');
        Route::get('/team-lead/delete-command/{employee}', [\App\Http\Controllers\Admin\EmployeeController::class, 'deleteAllCommand'])->name('deleteCommand');
        Route::get('/team-lead/command-show/{user}/{project}', [\App\Http\Controllers\Admin\EmployeeController::class, 'showCommand'])->name('command-show');
        Route::post('/team-lead/add-user-in-command/{teamLead}/{project}/', [\App\Http\Controllers\Admin\EmployeeController::class, 'addUserInCommand'])->name('addUserInCommand');
        Route::post('/team-lead/delete-user-in-command/{teamLead}/{project}/{user}', [\App\Http\Controllers\Admin\EmployeeController::class, 'deleteUserInGroup'])->name('deleteUserInGroup');

        // role in CRM
        Route::post('/employee/role-in-crm/{employee}', [\App\Http\Controllers\Admin\EmployeeController::class, 'roleToCRM'])->name('roleToCrm');
        Route::post('/employee/remove-role-in-crm/{employee}', [\App\Http\Controllers\Admin\EmployeeController::class, 'removeRoleToCRM'])->name('removeRoleToCrm');
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


    Route::get('/kpi/{id}', [\App\Http\Controllers\Admin\TasksController::class, 'kpi']);
    Route::get('/edit/kpi/{id}', [\App\Http\Controllers\Admin\TasksController::class, 'kpi']);


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
        Route::get('clients/offers/show/{slug}', [\App\Http\Controllers\Admin\OfferController::class, 'show'])->name('show');
        Route::get('clients/offers/show/{offer}/{search}', [\App\Http\Controllers\Admin\OfferController::class, 'showSearch'])->name('show.search');
        Route::get('clients/offers/delete/{offer}', [\App\Http\Controllers\Admin\OfferController::class, 'delete'])->name('delete');
        Route::post('clients/offers/send/user/{offer}/{search}', [\App\Http\Controllers\Admin\OfferController::class, 'sendUserSearch'])
            ->name('send.user.search');
        Route::post('clients/offers/send/user/{offer}', [\App\Http\Controllers\Admin\OfferController::class, 'sendUser'])
            ->name('send.user');
        Route::get('clients/offers/edit/{offer}', [\App\Http\Controllers\Admin\OfferController::class, 'edit'])->name('edit');
        Route::get('clients/offers/send/client/{offer}', [\App\Http\Controllers\Admin\OfferController::class, 'sendClient'])->name('send.client');
        Route::post('clients/offers/send/back/{offer}', [\App\Http\Controllers\Admin\OfferController::class, 'sendBack'])->name('send.back');
        Route::get('clients/offers/chat/{offer}', [\App\Http\Controllers\Admin\ChatController::class, 'index'])->name('chat');
        Route::post('clients/offers/chat/store/{offer}', [\App\Http\Controllers\Admin\ChatController::class, 'store'])->name('chat.store');
        Route::get('clients/offers/messages/download/{mess}', [\App\Http\Controllers\Admin\ChatController::class, 'downloadFile'])->name('messages.download');
        Route::post('clients/offers/search', [\App\Http\Controllers\Admin\OfferController::class, 'search'])->name('search');
        Route::get('clients/offers/search/results', [\App\Http\Controllers\Admin\OfferController::class, 'searchResults'])->name('search.results');
        Route::get('clients/offers/search/results/{search}', [\App\Http\Controllers\Admin\OfferController::class, 'searchResultsWithparametr'])->name('search.results.parameter');
        Route::post('clients/offers/decline/{offer}', [\App\Http\Controllers\Admin\OfferController::class, 'decline'])->name('decline');
        Route::get('clients/offers/create', [\App\Http\Controllers\Admin\OfferController::class, 'create'])->name('create');
        Route::post('clients/offers/store', [\App\Http\Controllers\Admin\OfferController::class, 'store'])->name('store');

    });

    Route::group(['as' => 'mon.'], function () {
        Route::get('/monitoring-tasks', [\App\Http\Controllers\Admin\MonitoringController::class, 'index'])->name('index');
        Route::get('/monitoring/show-task/{slug}', [\App\Http\Controllers\Admin\MonitoringController::class, 'show'])->name('show');
        Route::get('/monitoring/edit/{slug}', [\App\Http\Controllers\Admin\MonitoringController::class, 'edit'])->name('edit');
        Route::patch('/monitoring/update/{slug}', [\App\Http\Controllers\Admin\MonitoringController::class, 'update'])->name('update');
        Route::get('/monitoring/delete/{task}', [\App\Http\Controllers\Admin\MonitoringController::class, 'delete'])->name('delete');
        Route::get('/monitoring/all', [\App\Http\Controllers\Admin\MonitoringController::class, 'all'])->name('all');
        Route::get('/monitoring/archive/{slug}', [\App\Http\Controllers\Admin\MonitoringController::class, 'archive'])->name('archive');

        // get task-statuses
        Route::get('/tasks/public/monitoring-tasks-filter/{status}/{user}/{client}/{project}', [\App\Http\Controllers\Admin\MonitoringController::class, 'filter']);
    });


    Route::group(['as' => 'telegram.'], function () {
        Route::post('/telegram/all', [\App\Http\Controllers\Admin\TelegramController::class, 'sendAll'])->name('sendAll');
        Route::post('/telegram/one/{user}', [\App\Http\Controllers\Admin\TelegramController::class, 'sendOne'])->name('sendOne');
    });

    Route::get('/excel', [\App\Http\Controllers\Admin\ExelController::class, 'index'])->name('exel');
//    Route::get('excel/download/', [\App\Http\Controllers\Admin\ExelController::class, 'downloadFile'])->name('exel.download');

    Route::post('offers/chat/message/store/{offer}', [\App\Http\Controllers\Admin\TasksController::class, 'message_offer'])->name('offers.chat.message.store');


    Route::group(['as' => 'tasks-team-leads.'], function () {
        Route::get('/tasks-team/leads', [\App\Http\Controllers\Admin\TasksTeamLeadController::class, 'index'])->name('all-tasks');
        Route::get('/tasks-team/leads/show/{slug}',[\App\Http\Controllers\Admin\TasksTeamLeadController::class, 'show'])->name('show');
        Route::get('/tasks-team/leads/accept/{slug}',[\App\Http\Controllers\Admin\TasksTeamLeadController::class, 'acceptTaskCommand'])->name('acceptTaskCommand');
        Route::get('/tasks-team/leads/decline/{slug}',[\App\Http\Controllers\Admin\TasksTeamLeadController::class, 'declineTaskCommand'])->name('declineTaskCommand');
    });

    Route::get('/control/{user_id}/{from}/{to}/{time}', [\App\Http\Controllers\Admin\TasksController::class, 'control'])->name('control');
    Route::get('/kpil/{id}', [\App\Http\Controllers\Admin\TasksController::class, 'kpi']);


});
