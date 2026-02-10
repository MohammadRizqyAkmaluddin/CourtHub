<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BookingHold;
use App\Models\BookingSession;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\Clock\now;

class BookingController extends Controller
{
    public function checkout(Request $request)
    {
        return DB::transaction(function () {
            $hold = BookingHold::where('user_id', Auth::id())
                ->where('expires_at', '>', now())
                ->lockForUpdate()
                ->firstOrFail();

            $booking = Booking::create([
                'user_id' => Auth::id(),
                'status'  => 'pending'
            ]);

            BookingSession::create([
                'booking_id'    => $booking->id,
                'court_id'      => $hold->court_id,
                'booking_date'  => $hold->booking_date,
                'start_time'    => $hold->start_time,
                'end_time'      => $hold->end_time
            ]);

            $hold->delete();

            return $booking;
        });
    }

    public function callback(Request $request)
    {
        $booking = Booking::where('payment_ref', $request->order_id)->first();

        if (!$booking || $booking->status === 'paid') {
            return response()->json(['ok' => true]);
        }
        if ($request->transaction_status === 'settlement') {
            $booking->update(['status' => 'paid']);
        }

        return response()->json(['ok' => true]);
    }
}
