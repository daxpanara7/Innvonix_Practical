<?php

use Illuminate\Support\Facades\Route;

// Group all v1 API routes
Route::prefix('v1')->group(function () {
    require base_path('routes/api/v1/auth.php');
    require base_path('routes/api/v1/task.php');
});
