<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, "index"])->middleware('auth')->name("index");
Route::get('/{task}/edit', [TaskController::class, "edit"])->middleware(['auth', "can:update,task"]);
Route::patch('/{task}/edit', [TaskController::class, "update"])->middleware(['auth']);
Route::post('/', [TaskController::class, "store"])->middleware(['auth']);
Route::delete('/{task}', [TaskController::class, "destroy"])->middleware('auth')->can("delete", "task");

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
