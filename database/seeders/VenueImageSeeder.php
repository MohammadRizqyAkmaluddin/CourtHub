<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VenueImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $totalVenues   = 49;
        $imagesPerVenue = 3;

        $data = [];

        for ($venueId = 1; $venueId <= $totalVenues; $venueId++) {
            for ($i = 1; $i <= $imagesPerVenue; $i++) {
                $data[] = [
                    'venue_id' => $venueId,
                    'image'    => "venue-{$venueId}-{$i}.jpg"
                ];
            }
        }

        DB::table('venue_images')->insert($data);
    }
}
