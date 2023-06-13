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
        Route::get('/tasks/{user}',[\App\Http\Controllers\API\V1\Tasks\TaskController::class, 'index']);
        Route::get('/new-tasks/{user}',[\App\Http\Controllers\API\V1\Tasks\TaskController::class, 'newTasks']);
        Route::get('/get-tasks/{user}', [\App\Http\Controllers\API\V1\Tasks\TaskController::class,'getTasks']);
        Route::post('/get-tasks/accept/{user}/{task}', [\App\Http\Controllers\API\V1\Tasks\TaskController::class,'taskAccept']);
        Route::post('/get-tasks/decline/{user}/{task}', [\App\Http\Controllers\API\V1\Tasks\TaskController::class,'taskDecline']);
    });

    Route::get('/logout', [\App\Http\Controllers\API\V1\AuthController::class, 'logout']);
});


Route::post('/login/', [\App\Http\Controllers\API\V1\AuthController::class, 'login']);
