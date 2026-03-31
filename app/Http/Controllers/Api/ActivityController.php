<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\CommunityMember;
use App\Models\ActivityLevel;
use App\Models\BookingHoldHeader;
use App\Models\Booking;
use Carbon\Carbon;

class ActivityController extends Controller
{
    public function myActiveHolds()
    {
        $holds = BookingHoldHeader::with([
                'venue',
                'court',
                'hold'
            ])
            ->where('user_id', Auth::id())
            ->orderBy('id')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $holds
        ]);
    }

    public function getActiveBookings()
    {
        $now = Carbon::now();

        $bookings = Booking::with(['sessions' => function ($query) {
            $query->orderBy('start_time');
        }])
        ->whereHas('sessions', function ($query) use ($now) {
            $query->whereRaw("CONCAT(booking_date, ' ', end_time) > ?", [$now]);
        })
        ->where('user_id', Auth::id())
        ->get();

        $bookings = $bookings->map(function ($booking) use ($now) {

            $booking->sessions = $booking->sessions->map(function ($session) use ($now, $booking) {

                $endDateTime = Carbon::parse($booking->booking_date . ' ' . $session->end_time);

                $session->status = $endDateTime->gt($now);

                return $session;
            });

            return $booking;
        });

        return response()->json([
            'success' => true,
            'data' => $bookings
        ]);
    }

    public function history()
    {
        $history =  Booking::with([
            'sessions:id,booking_id,start_time,end_time',
            'venue:id,name',
            'venue.firstImage',
            'court:id,name,image',
            'rating:id,booking_id,rate,review,updated_at'
            ])
            ->where('user_id', Auth::id())
            ->get();

        return response()->json([
            'success' => true,
            'data' => $history
        ]);
    }

    public function myMembership()
    {
        $member = CommunityMember::with('community')
            ->where('user_id', Auth::user()->id)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $member
        ]);
    }

    public function level()
    {
        $level = ActivityLevel::where('user_id', Auth::user()->id)->first();

        return response()->json([
            'success' => true,
            'data' => $level
        ]);
    }

    public function leaveCommunity($communityId) {

        CommunityMember::where('user_id', Auth::id())
            ->where('community_id', $communityId)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Member data removed'
        ]);
    }

}
