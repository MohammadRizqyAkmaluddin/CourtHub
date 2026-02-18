<?php

use App\Http\Controllers\Api\LookupController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\Api\VenueAuthController;
use App\Http\Controllers\Api\VenueController;
use App\Http\Controllers\Api\CourtAvailabilityController;
use App\Http\Controllers\Api\BookingHoldController;
use App\Http\Controllers\Api\CommunityController;

Route::get('/test', function () {
    return 'API OK';
});

Route::get('sport-types', [LookupController::class, 'sportType']);
Route::get('cities', [LookupController::class, 'city']);
Route::get('venues', [VenueController::class, 'index']);
Route::get('venues/{venue}', [VenueController::class, 'show']);
Route::get('communities', [CommunityController::class, 'index']);

Route::post('/booking-holds/guest', [BookingHoldController::class, 'storeGuest']);

Route::get('/booking-holds/{id}', [BookingHoldController::class, 'show']);

Route::middleware('auth:user')->get('/my-activity/booking-holds',[BookingHoldController::class, 'myActiveHolds']);

Route::post('/booking-holds/cancel', [BookingHoldController::class, 'cancel']);

Route::get('/courts/{court}/availability', [CourtAvailabilityController::class, 'show']);
Route::get('/courts/{court}/availability/month', [CourtAvailabilityController::class, 'month']);
Route::get('courts/{court}/availability/day', [CourtAvailabilityController::class, 'day']);

Route::prefix('auth/venue')->group(function () {
    Route::post('register', [VenueAuthController::class, 'register']);
    Route::post('login', [VenueAuthController::class, 'login']);
});

Route::prefix('auth/user')->group(function () {
    Route::post('register', [UserAuthController::class, 'register']);
    Route::post('login', [UserAuthController::class, 'login']);
});

Route::post('/community/store', [CommunityController::class, 'store']);
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/booking-holds/auth', [BookingHoldController::class, 'storeAuth']);
    Route::post('/checkExisting', [BookingHoldController::class, 'check']);

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
