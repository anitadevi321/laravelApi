<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('create-user',[ApiController::class, "register"]);

Route::post('login-user',[ApiController::class, "login"]);

Route::group([
    "middleware" => ["auth:sanctum","Is_admin"],
],function(){
    Route::get('profile',[ApiController::class, "profile"]);
    Route::get('logout',[ApiController::class, "logout"]);
});

//Route::get('profile',[ApiController::class, "profile"])->middleware('Is_admin:admin');