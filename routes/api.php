<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\Api\VenueAuthController;
use App\Http\Controllers\Api\VenueController;

Route::get('regions', [RegionController::class, 'index']);
Route::get('venues', [VenueController::class, 'index']);

Route::prefix('auth/venue')->group(function () {
    Route::post('register', [VenueAuthController::class, 'register']);
    Route::post('login', [VenueAuthController::class, 'login']);
});

Route::prefix('auth/user')->group(function () {
    Route::post('register', [UserAuthController::class, 'register']);
    Route::post('login', [UserAuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('auth/user/me', function (Request $request) {
        return response()->json([
            'user' => $request->user()
        ]);
    });

    Route::get('auth/venue/me', function (Request $request) {
        return response()->json([
            'venue' => $request->user()
        ]);
    });
});
