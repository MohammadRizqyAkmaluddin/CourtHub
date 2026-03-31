<?php

use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\LookupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\Api\VenueAuthController;
use App\Http\Controllers\Api\VenueController;
use App\Http\Controllers\Api\CourtAvailabilityController;
use App\Http\Controllers\Api\BookingHoldController;
use App\Http\Controllers\Api\CommunityController;
use App\Http\Controllers\Api\RatingController;
use Illuminate\Http\Request;

Route::get('/test', function () {
    return 'API OK';
});

Route::get('sport-types', [LookupController::class, 'sportType']);
Route::get('cities', [LookupController::class, 'city']);
Route::get('venues', [VenueController::class, 'index']);
Route::get('venues/{venue}', [VenueController::class, 'show']);
Route::get('communities', [CommunityController::class, 'index']);
Route::get('suggestion/{community}', [CommunityController::class, 'suggestion']);
Route::get('communities/{community}', [CommunityController::class, 'show']);

Route::post('/booking-holds/{id}/pay', [BookingHoldController::class, 'createPayment']);

Route::post('/midtrans/callback', [BookingHoldController::class, 'handle']);

Route::post('/booking-holds/guest', [BookingHoldController::class, 'storeGuest']);

Route::get('/booking-holds/{id}', [BookingHoldController::class, 'show']);

Route::get('/profile', [UserAuthController::class, 'profile']);

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

    Route::get('auth/user/me', function (Request $request) {
        return response()->json([
            'user' => $request->user()
        ]);
    });

    Route::get('/my-activity/booking-holds',[ActivityController::class, 'myActiveHolds']);
    Route::get('/my-activity/active-booking', [ActivityController::class, 'getActiveBookings']);
    Route::get('/my-activity/booking-history', [ActivityController::class, 'history']);
    Route::get('/my-activity/community-membership', [ActivityController::class, 'myMembership']);
    Route::get('/my-activity/level', [ActivityController::class, 'level']);
    Route::post('/my-activity/{community}/leave-community', [ActivityController::class, 'leaveCommunity']);

    Route::post('/my-activity/rate', [RatingController::class, 'store']);

    Route::post('/booking-holds/auth', [BookingHoldController::class, 'storeAuth']);
    Route::post('/booking-holds/auth/check', [BookingHoldController::class, 'check']);
});
