<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

Route::prefix('user')->group(function(){
    Route::post('/registration',[ApiController::class, "register"]);
    Route::post('/login',[ApiController::class, "login"]);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/profile',[ApiController::class, "profile"]);
        Route::get('/logout',[ApiController::class, "logout"]);
    });
});
