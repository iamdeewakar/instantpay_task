<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BoardController;
use App\Http\Controllers\API\TaskController;
use Illuminate\Support\Facades\Route;


Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('boards', BoardController::class);
    Route::apiResource('tasks', TaskController::class);
});

