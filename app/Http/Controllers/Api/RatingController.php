<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function show(Booking $booking)
    {
        $booking->load([
            'booking',
            'booking.sessions'
        ]);

        return response()->json([
            'success' => true,
            'data'    => $booking
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'rate' => 'required|numeric|min:1|max:5',
            'review' => 'nullable|string'
        ]);

        $booking = Booking::where('id', $request->booking_id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

        if ($booking->rating) {
            return response()->json([
                'success' => false,
                'message' => 'Already rated'
            ], 400);
        }

        $rating = Rating::create([
            'booking_id' => $request->booking_id,
            'rate' => $request->rate,
            'review' => $request->review
        ]);

        return response()->json([
            'success' => true,
            'data' => $rating
        ]);
    }
}
