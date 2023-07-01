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
        Route::post('/tasks', [\App\Http\Controllers\API\V1\Tasks\TaskController::class, 'store']);
    });

    Route::group(['as' => 'lead'], function () {
        Route::get('/lead/', [\App\Http\Controllers\API\V1\Crm\LeadController::class, 'index']);
        Route::post('/lead/create/', [\App\Http\Controllers\API\V1\Crm\LeadController::class, 'store']);
    });

    Route::group(['as' => 'contact'], function () {
        Route::get('/contact/', [\App\Http\Controllers\API\V1\Crm\ContactController::class, 'index']);
        Route::post('/contact/create/', [\App\Http\Controllers\API\V1\Crm\ContactController::class, 'store']);
    });

    Route::post('/logout', [\App\Http\Controllers\API\V1\AuthController::class, 'logout']);
});


Route::post('/login/', [\App\Http\Controllers\API\V1\AuthController::class, 'login']);
