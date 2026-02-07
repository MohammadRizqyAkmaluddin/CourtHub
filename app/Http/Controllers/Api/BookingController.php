<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BookingHold;
use App\Models\BookingSession;
use App\Models\Booking;

use function Symfony\Component\Clock\now;

class BookingController extends Controller
{
    public function checkout(Request $request)
    {
        return DB::transaction(function () {
            $hold = BookingHold::where('user_id', auth()->id())
                ->where('expires_at', '>', now())
                ->lockForUpdate()
                ->firstOrFail();

            $booking = Booking::create([
                'user_id' => auth()->id(),
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
}
