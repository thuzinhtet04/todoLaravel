<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Middleware\TaskMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/login', [AuthController::class, "login"]);
Route::post('/register', [AuthController::class, "register"]);


Route::get('/tasks', [TaskController::class, "index"])->middleware('auth:sanctum');
Route::get('/tasks/{task}', [TaskController::class, "show"])->middleware(['auth:sanctum', TaskMiddleware::class]);
Route::patch('/tasks/{task}', [TaskController::class, "update"])->middleware(['auth:sanctum', TaskMiddleware::class]);
Route::put('/tasks/{task}', [TaskController::class, "update"])->middleware(['auth:sanctum', TaskMiddleware::class]);
Route::post('/tasks', [TaskController::class, "store"])->middleware(['auth:sanctum',]);
Route::delete('/tasks/{task}', [TaskController::class, "destroy"])->middleware(['auth:sanctum', TaskMiddleware::class]);
