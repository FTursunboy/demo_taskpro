<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['as' => 'tasks'], function (){
        Route::get('/tasks/',[\App\Http\Controllers\API\V1\Tasks\TaskController::class, 'index']);
        Route::get('/new-tasks/',[\App\Http\Controllers\API\V1\Tasks\TaskController::class, 'newTasks']);
        Route::get('/getAllTasks', [\App\Http\Controllers\API\V1\Tasks\TaskController::class, 'getAllTasks']);
        Route::get('/getAllTasks/{id}', [\App\Http\Controllers\API\V1\Tasks\TaskController::class, 'show']);
        Route::get('/get-tasks/', [\App\Http\Controllers\API\V1\Tasks\TaskController::class,'getTasks']);
        Route::post('/get-tasks/accept/{task}', [\App\Http\Controllers\API\V1\Tasks\TaskController::class,'taskAccept']);
        Route::post('/get-tasks/decline/{task}', [\App\Http\Controllers\API\V1\Tasks\TaskController::class,'taskDecline']);
        Route::get('/task/getData', [\App\Http\Controllers\API\V1\Tasks\TaskController::class, 'create']);
        Route::post('/tasks/create', [\App\Http\Controllers\API\V1\Tasks\TaskController::class, 'store'])->middleware('role:admin');

        Route::get('taskTeamLead', [\App\Http\Controllers\API\V1\Tasks\TaskTeamLead::class, 'taskTeamLead']);
        Route::get('taskTeamLead/{id}', [\App\Http\Controllers\API\V1\Tasks\TaskTeamLead::class, 'show']);
        Route::get('taskTeamLead/accept/{id}', [\App\Http\Controllers\API\V1\Tasks\TaskTeamLead::class, 'accept']);
        Route::get('taskTeamLead/decline/{id}', [\App\Http\Controllers\API\V1\Tasks\TaskTeamLead::class, 'decline']);

        Route::get('task_client', [\App\Http\Controllers\API\V1\Tasks\TaskClient::class, 'index']);
        Route::get('task_client_filter', [\App\Http\Controllers\API\V1\Tasks\TaskClient::class, 'index_filter']);

        Route::get('countTasksAdmin', [\App\Http\Controllers\API\V1\Tasks\CountTasksController::class, 'panelAdmin']);
        Route::get('countTasksUser', [\App\Http\Controllers\API\V1\Tasks\CountTasksController::class, 'panelUser']);

        Route::get('/task/accept/{id}', [App\Http\Controllers\API\V2\Tasks\TasksController::class, 'accept']);
        Route::get('/task/decline/{id}', [App\Http\Controllers\API\V2\Tasks\TasksController::class, 'decline']);

        Route::get('/history/{id}', [\App\Http\Controllers\API\V1\Tasks\HistoryController::class, 'history']);

    });

    Route::group(['as' => 'lead'], function () {
        Route::get('/lead/', [\App\Http\Controllers\API\V1\CRM\LeadController::class, 'index']);
        Route::get('/leadState/', [\App\Http\Controllers\API\V1\CRM\LeadController::class, 'leadState']);
        Route::get('/leadSource/', [\App\Http\Controllers\API\V1\CRM\LeadController::class, 'leadSource']);
        Route::get('/leadStatus/', [\App\Http\Controllers\API\V1\CRM\LeadController::class, 'leadStatus']);
        Route::post('/lead/create/', [\App\Http\Controllers\API\V1\CRM\LeadController::class, 'store']);
        Route::get('/lead/{id}', [\App\Http\Controllers\API\V1\CRM\LeadController::class, 'show']);
        Route::patch('/lead/update/{id}', [\App\Http\Controllers\API\V1\CRM\LeadController::class, 'update']);
        Route::patch('/lead/updateEvent/{id}', [\App\Http\Controllers\API\V1\CRM\LeadController::class, 'updateEvent']);
        Route::patch('/lead/updateContact/{id}', [\App\Http\Controllers\API\V1\CRM\LeadController::class, 'updateContact']);
        Route::delete('/lead/{id}', [\App\Http\Controllers\API\V1\CRM\LeadController::class, 'delete']);
        Route::delete('/eventDelete/{id}', [\App\Http\Controllers\API\V1\CRM\LeadController::class, 'eventDelete']);
        Route::delete('/contactDelete/{id}', [\App\Http\Controllers\API\V1\CRM\LeadController::class, 'contactDelete']);
    });

    Route::group(['as' => 'contact'], function () {
        Route::get('/contact/', [\App\Http\Controllers\API\V1\CRM\ContactController::class, 'index']);
        Route::get('/contact/leads', [\App\Http\Controllers\API\V1\CRM\ContactController::class, 'leads']);
        Route::post('/contact/create/', [\App\Http\Controllers\API\V1\CRM\ContactController::class, 'store']);
    });

    Route::group(['as' => 'statistics', 'middleware' => 'role:admin'], function () {
        Route::get('/statisticsProjectTasks', [\App\Http\Controllers\API\V1\Statistics\StatisticController::class, 'projectStatic']);
        Route::get('/statisticsUserTasks', [\App\Http\Controllers\API\V1\Statistics\StatisticController::class, 'taskStatistic']);
        Route::get('/statisticsUserTasks/{month}', [\App\Http\Controllers\API\V1\Statistics\StatisticController::class, 'filter']);
        Route::get('/leadStatistics', [\App\Http\Controllers\API\V1\Statistics\LeadStatisticController::class, 'LeadStatistic']);

    });

//    Route::group(['middleware' => 'role:admin'], function() {
//        Route::get('/adminProfile/{id}', [\App\Http\Controllers\API\V1\Profile\adminProfileController::class, 'index']);
//        Route::put('/adminProfile/update/{id}', [\App\Http\Controllers\API\V1\Profile\adminProfileController::class, 'update']);
//    });
        Route::get('/userProfile/{id}', [\App\Http\Controllers\API\V1\Profile\UserProfileController::class, 'index']);
        Route::post('/userProfile/update/{id}', [\App\Http\Controllers\API\V1\Profile\UserProfileController::class, 'update']);


    Route::post('/logout', [\App\Http\Controllers\API\V1\AuthController::class, 'logout']);

});


Route::post('/login/', [\App\Http\Controllers\API\V1\AuthController::class, 'login']);
Route::get('/test/', [\App\Http\Controllers\API\V1\Tasks\TaskController::class, 'test']);
