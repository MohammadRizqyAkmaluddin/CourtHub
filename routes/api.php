<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\Api\VenueAuthController;
use App\Http\Controllers\Api\VenueController;

Route::prefix('auth/venue')->group(function () {
    Route::post('register', [VenueAuthController::class, 'register']);
    Route::post('login', [VenueAuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('logout', [VenueAuthController::class, 'logout']);
});

Route::prefix('auth/user')->group(function () {
    Route::post('register', [UserAuthController::class, 'register']);
    Route::post('login', [UserAuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('logout', [UserAuthController::class, 'logout']);
});


Route::get('regions', [RegionController::class, 'index']);
Route::get('venues', [VenueController::class, 'index']);

Route::middleware('auth:venue')->group(function () {
    Route::get('venue/me', [VenueController::class, 'me']);
    Route::put('venue/profile', [VenueController::class, 'update']);
});
