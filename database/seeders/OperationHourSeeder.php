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

            // ✅ Satu open_time untuk satu venue
            $venueOpenTime = collect($openingTimeOptions)->random();

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

                // ✅ Close time logic
                if (in_array($dayOfWeek, [6, 7])) {
                    // Weekend → mostly tutup jam 00:00
                    $closeTime = rand(1, 100) <= 75 ? '00:00' : '22:00';
                } else {
                    // Weekday
                    $closeTime = '22:00';
                }

                DB::table('operation_hours')->insert([
                    'venue_id'    => $venueId,
                    'day_of_week' => $dayOfWeek,
                    'open_time'   => $venueOpenTime,
                    'close_time'  => $closeTime,
                    'is_closed'   => false,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }
        }
    }

}
