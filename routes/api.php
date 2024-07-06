<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::get('/test', function () {
        return response()->json([
            'status' => 'success',
        ]);
    });
});


