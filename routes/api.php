<?php

use App\Http\Controllers\Api\V1\Tasks\IndexController as TasksIndexController;
use App\Http\Controllers\Api\V1\Tasks\ShowController as TasksShowController;
use App\Http\Controllers\Api\V1\Tasks\StoreController as TasksStoreController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::get('/test', function () {
        return response()->json([
            'status' => 'success',
        ]);
    });

    Route::group(['prefix' => 'tasks'], function () {
        Route::get('/', TasksIndexController::class);
        Route::get('/{id}', TasksShowController::class);
        Route::post('/', TasksStoreController::class);
    });
});
