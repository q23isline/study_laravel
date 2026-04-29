<?php

use App\Http\Controllers\Api\V1\SampleUserAddController;
use App\Http\Controllers\Api\V1\SampleUserDeleteController;
use App\Http\Controllers\Api\V1\SampleUserGetController;
use App\Http\Controllers\Api\V1\SampleUserListGetController;
use App\Http\Controllers\Api\V1\SampleUserUpdateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::get('/sample-users', SampleUserListGetController::class);
    Route::post('/sample-users', SampleUserAddController::class);
    Route::get('/sample-users/{id}', SampleUserGetController::class)->whereNumber('id');
    Route::patch('/sample-users/{id}', SampleUserUpdateController::class)->whereNumber('id');
    Route::delete('/sample-users/{id}', SampleUserDeleteController::class)->whereNumber('id');
});
