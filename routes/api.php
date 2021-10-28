<?php

use App\Http\Controllers\Api\DroneController;
use App\Http\Controllers\Api\MissionController;
use App\Http\Controllers\Api\OperatorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('/operators', OperatorController::class);
Route::apiResource('/drones', DroneController::class);
Route::apiResource('/missions', MissionController::class);