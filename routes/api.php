<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controller\AuthController;\
use App\Http\Controller\ChannelController

Route::get("/user", function (Request $request) {
    return $request->user();
})->middleware("auth:sanctum");
Route::post("/v1/auth/register", [AuthController::class, "register"])
Route::post("/v1/auth/login", [AuthController::class, "login"])
Route::middleware("auth:sanctum") -> group(function (){
    Route::get("/channels", [ChannelController::class, "index"])
    Route::post("channels", [ChannelController::class, "store"])
})
