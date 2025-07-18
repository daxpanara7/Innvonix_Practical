<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\TaskController;
use App\Models\User;

Route::middleware('auth:sanctum')->group(function () {
    // Task CRUD
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::get('/tasks/{id}', [TaskController::class, 'show']);
    Route::put('/tasks/{id}', [TaskController::class, 'update']);
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);

    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        Route::get('/admin/tasks', [TaskController::class, 'adminIndex']); 
    });
    

    Route::get('/users', function () {
        return User::select('id', 'name')->get();
    });
});
