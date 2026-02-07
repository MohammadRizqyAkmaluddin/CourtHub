<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BookingHold;

use function Symfony\Component\Clock\now;

class BookingHoldController extends Controller
{
    public function store(Request $request) {

        $data = $request->validate([
            'court_id'  => 'required|integer',
            'date'      => 'required|date',
            'start'     => 'required',
            'end'       => 'required'
        ]);

        return DB::transaction(function () use ($data) {

            $conflict = BookingHold::where('court_id', $data['court_id'])
                ->where('booking_date', $data['date'])
                ->where('expires_at', '>', now())
                ->where(function ($q) use ($data) {
                    $q->where('start_time', '<', $data['end'])
                      ->where('end_time', '>', $data['start']);
                })
                ->lockForUpdate()
                ->exists();

            if ($conflict) {
                return response()->json([
                    'message' => 'Slot already locked'
                ], 409);
            }

            $hold = BookingHold::create([
                'user_id'       => auth()->id(),
                'court_id'      => $data['court_id'],
                'booking_date'  => $data['date'],
                'start_time'    => $data['start'],
                'end_time'      => $data['end'],
                'expires_time'  => now()->addMinutes(10),
            ]);

            return response()->json($hold);
        });

    }
}
