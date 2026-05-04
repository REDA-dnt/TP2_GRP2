<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\AdminLeaveController;

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login',    [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {

    Route::get('/auth/me',      [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::get('/leave',          [LeaveController::class, 'index']);
    Route::post('/leave/request', [LeaveController::class, 'requestLeave']);

    Route::middleware('role:admin')->group(function () {
        Route::post('/admin/leave/{user}/credit', [AdminLeaveController::class, 'credit']);
        Route::post('/admin/leave/{user}/debit',  [AdminLeaveController::class, 'debit']);
    });

});
