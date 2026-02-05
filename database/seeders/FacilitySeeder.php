<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $venueIds = range(1,49);
        $facilityTypeIds = range(1,14);

        foreach ($venueIds as $venueId) {

            $selectedFacility = [6];
            $totalFacility = rand(5, 12);

            $otherFacility = collect($facilityTypeIds)
                ->reject(fn ($id) => $id === 6)
                ->shuffle()
                ->take($totalFacility - 1)
                ->toArray();

            $selectedFacility = array_merge($selectedFacility, $otherFacility);

            foreach ($selectedFacility as $facilityTypeId) {
                DB::table('facilities')->insert([
                    'venue_id' => $venueId,
                    'facility_type_id' => $facilityTypeId
                ]);
            }
        }
    }
}
