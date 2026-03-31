<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CitySeeder::class,
            UserSeeder::class,
            VenueSeeder::class,
            venueImageSeeder::class,
            CourtMaterialSeeder::class,
            AdditionalTypeSeeder::class,
            SportTypeSeeder::class,
            CourtTypeSeeder::class,
            FacilityTypeSeeder::class,
            FacilitySeeder::class,
            CourtSeeder::class,
            OperationHourSeeder::class,
            LevelSeeder::class,
            CommunitySeeder::class,
            CommunityMemberSeeder::class,
            BookingSeeder::class,
            RatingSeeder::class
        ]);
    }
}
