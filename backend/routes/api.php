<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API's
    Route::get('get/users', [ApiController::class, 'get_users']);
    Route::get('get/{id}/user/', [ApiController::class, 'get_user_by_id']);
    Route::post('create/user', [ApiController::class, 'create_user']);
    Route::put('update/{id}/user', [ApiController::class, 'update_user']);
    Route::delete('delete/{id}/user', [ApiController::class, 'delete_user']);
