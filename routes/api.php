<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LaporanController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/profile', [\App\Http\Controllers\Api\ProfileController::class, 'index']);
Route::middleware('auth:sanctum')->put('/profile', [\App\Http\Controllers\Api\ProfileController::class, 'update']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});

//user
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/laporan', [LaporanController::class, 'store']);
    Route::get('/laporan/{id}', [LaporanController::class, 'show']);
    Route::post('/laporan/{id}', [LaporanController::class, 'update']);
});
    Route::get('/laporan', [LaporanController::class, 'index']);
