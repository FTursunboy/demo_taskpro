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

    });

    Route::post('/logout', [\App\Http\Controllers\API\V1\AuthController::class, 'logout']);
});


Route::post('/login/', [\App\Http\Controllers\API\V1\AuthController::class, 'login']);
Route::get('/test/', [\App\Http\Controllers\API\V1\Tasks\TaskController::class, 'test']);
