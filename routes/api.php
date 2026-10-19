<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ContentChecklistController;
use App\Http\Controllers\ContentMetricController;

Route::get("/user", function (Request $request) {
    return $request->user();
})->middleware("auth:sanctum");
//login
Route::post("/v1/auth/register", [AuthController::class, "register"]);
Route::post("/v1/auth/login", [AuthController::class, "login"]);
//channel
Route::middleware("auth:sanctum") -> group(function (){
    Route::get("/channels", [ChannelController::class, "index"]);
    Route::post("channels", [ChannelController::class, "store"]);
//content
Route::get("/contents", [ContentController::class, "index"]);
Route::post("/contents", [ContentController::class, "store"]);
Route::get("/contents/{id}", [ContentController::class, "show"]);
Route::put("/contents/{id}", [ContentController::class, "update"]);
Route::delete("/contents/{id}", [ContentController::class, "destroy"]);
//content checklist
Route::post("/contents/{contentId}/checklists", [ContentChecklistController::class, "store"]);
Route::put("/checklists/{id}", [ContentChecklistController::class, "update"]);
Route::delete("/checklists/{id}", [ContentChecklistController::class, "destroy"]);
//content metrics
Route::post("/contents/{contentId}/metrics", [ContentMetricController::class, "store"]);
Route::put("/metrics/{id}", [ContentMetricController::class, "update"]);
});
