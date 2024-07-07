<?php

use App\Http\Controllers\Api\V1\Comments\DeleteController as CommentsDeleteController;
use App\Http\Controllers\Api\V1\Comments\StoreController as CommentsStoreController;
use App\Http\Controllers\Api\V1\Tasks\DeleteController as TasksDeleteController;
use App\Http\Controllers\Api\V1\Tasks\IndexController as TasksIndexController;
use App\Http\Controllers\Api\V1\Tasks\ShowController as TasksShowController;
use App\Http\Controllers\Api\V1\Tasks\StoreController as TasksStoreController;
use App\Http\Controllers\Api\V1\Tasks\UpdateController as TasksUpdateController;
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
        Route::patch('/{id}', TasksUpdateController::class);
        Route::delete('/{task}', TasksDeleteController::class);

        Route::post('/{id}/comment', CommentsStoreController::class);
        Route::delete('/{taskId}/comment/{commentId}', CommentsDeleteController::class);
    });
});
