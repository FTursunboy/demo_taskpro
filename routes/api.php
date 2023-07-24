<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['as' => 'tasks'], function (){
        Route::get('/tasks/',[\App\Http\Controllers\API\V1\Tasks\TaskController::class, 'index']);
        Route::get('/new-tasks/',[\App\Http\Controllers\API\V1\Tasks\TaskController::class, 'newTasks']);
        Route::get('/getAllTasks', [\App\Http\Controllers\API\V1\Tasks\TaskController::class, 'getAllTasks']);
        Route::get('/get-tasks/', [\App\Http\Controllers\API\V1\Tasks\TaskController::class,'getTasks']);
        Route::post('/get-tasks/accept/{task}', [\App\Http\Controllers\API\V1\Tasks\TaskController::class,'taskAccept']);
        Route::post('/get-tasks/decline/{task}', [\App\Http\Controllers\API\V1\Tasks\TaskController::class,'taskDecline']);
        Route::get('/task/getData', [\App\Http\Controllers\API\V1\Tasks\TaskController::class, 'create']);
        Route::post('/tasks/create', [\App\Http\Controllers\API\V1\Tasks\TaskController::class, 'store'])->middleware('role:admin');
    });

    Route::group(['as' => 'lead'], function () {
        Route::get('/lead/', [\App\Http\Controllers\API\V1\CRM\LeadController::class, 'index']);
        Route::get('/leadState/', [\App\Http\Controllers\API\V1\CRM\LeadController::class, 'leadState']);
        Route::get('/leadSource/', [\App\Http\Controllers\API\V1\CRM\LeadController::class, 'leadSource']);
        Route::get('/leadStatus/', [\App\Http\Controllers\API\V1\CRM\LeadController::class, 'leadStatus']);
        Route::post('/lead/create/', [\App\Http\Controllers\API\V1\CRM\LeadController::class, 'store']);
        Route::get('/lead/{id}', [\App\Http\Controllers\API\V1\CRM\LeadController::class, 'show']);
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
