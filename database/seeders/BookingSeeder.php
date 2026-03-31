<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BookingSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 1000; $i++) {

            // random venue
            $venueId = rand(1, 30);

            // ambil court sesuai venue
            $court = DB::table('courts')
                ->where('venue_id', $venueId)
                ->inRandomOrder()
                ->first();

            if (!$court) continue;

            // random tanggal sebelum hari ini
            $bookingDate = Carbon::now()->subDays(rand(1, 30));
            $dayOfWeek = $bookingDate->dayOfWeekIso; // 0 = Sunday

            // ambil operation hours
            $operation = DB::table('operation_hours')
                ->where('venue_id', $venueId)
                ->where('day_of_week', $dayOfWeek)
                ->where('is_closed', false)
                ->first();

            if (!$operation || !$operation->open_time || !$operation->close_time) continue;

            $start = Carbon::parse($operation->open_time);
            $end = Carbon::parse($operation->close_time);

            $sessions = [];

            // generate semua possible session
            while ($start < $end) {
                $sessionEnd = $start->copy()->addMinutes($court->session_duration);

                if ($sessionEnd > $end) break;

                $sessions[] = [
                    'start_time' => $start->format('H:i:s'),
                    'end_time' => $sessionEnd->format('H:i:s'),
                    'price' => $court->price
                ];

                $start = $sessionEnd;
            }

            if (count($sessions) == 0) continue;

            // ambil random beberapa session (1–3)
            $selectedSessions = collect($sessions)
                ->shuffle()
                ->take(rand(1, min(3, count($sessions))))
                ->values();

            $totalPrice = $selectedSessions->sum('price');

            // insert booking
            $bookingId = DB::table('bookings')->insertGetId([
                'venue_id' => $venueId,
                'court_id' => $court->id,
                'user_id' => rand(1, 35),
                'booking_date' => $bookingDate->format('Y-m-d'),
                'price' => $totalPrice,
                'midtrans_order_id' => 'ORDER-' . Str::uuid(),
                'payment_status' => 'paid',
                'status' => 'confirmed',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // insert booking_sessions
            foreach ($selectedSessions as $session) {
                DB::table('booking_sessions')->insert([
                    'booking_id' => $bookingId,
                    'start_time' => $session['start_time'],
                    'end_time' => $session['end_time'],
                    'price' => $session['price'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
