<?php

use Illuminate\Http\Request;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('vehicles', \App\Http\Controllers\Api\vehicleController::class)
    ->middleware(['web']);

Route::controller(\App\Http\Controllers\Api\RentvehicleController::class)
    ->middleware(['web'])
    ->group(static function () {
        Route::get('/available-vehicles', 'availablevehicles');
        Route::post('/attach/{vehicle}/{user?}', 'attach');
        Route::post('/detach/{vehicle}', 'detach');
    });
