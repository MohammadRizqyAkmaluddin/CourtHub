<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OperationHourSeeder extends Seeder
{
    public function run(): void
    {
        $openingTimeOptions = [
            '06:00',
            '07:00',
            '08:00',
            '09:00',
            '12:00',
            '15:00',
            '16:00',
        ];

        foreach (range(1, 49) as $venueId) {
            foreach (range(1, 7) as $dayOfWeek) {

                $isClosed = rand(1, 100) <= 15;

                if ($isClosed) {
                    DB::table('operation_hours')->insert([
                        'venue_id'    => $venueId,
                        'day_of_week' => $dayOfWeek,
                        'open_time'   => null,
                        'close_time'  => null,
                        'is_closed'   => true,
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]);
                    continue;
                }

                $openTime = collect($openingTimeOptions)->random();

                // Durasi buka 8–16 jam
                $durationHours = rand(8, 16);

                $closeTime = Carbon::createFromFormat('H:i', $openTime)
                    ->addHours($durationHours)
                    ->format('H:i');

                DB::table('operation_hours')->insert([
                    'venue_id'    => $venueId,
                    'day_of_week' => $dayOfWeek,
                    'open_time'   => $openTime,
                    'close_time'  => $closeTime,
                    'is_closed'   => false,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }
        }
    }
}
