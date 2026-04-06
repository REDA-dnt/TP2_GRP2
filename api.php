<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\AdminLeaveController;

// 🔹 Routes publiques
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login',    [AuthController::class, 'login']);

// 🔹 Routes protégées par JWT
Route::middleware('auth:api')->group(function () {

    // Auth
    Route::get('/auth/me',      [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // Congés (employé)
    Route::get('/leave',          [LeaveController::class, 'index']);
    Route::post('/leave/request', [LeaveController::class, 'requestLeave']);

    // Congés (admin)
    Route::post('/admin/leave/{user}/credit', [AdminLeaveController::class, 'credit']);
    Route::post('/admin/leave/{user}/debit',  [AdminLeaveController::class, 'debit']);
});