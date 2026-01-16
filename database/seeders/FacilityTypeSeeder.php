<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('facility_types')->insert([
            ['type' => 'Prayer Room'],
            ['type' => 'Food & Beverage'],
            ['type' => 'Car Parking'],
            ['type' => 'Motorbike Parking'],
            ['type' => 'Wi-Fi'],
            ['type' => 'Toilet'],
            ['type' => 'Sport Store'],
            ['type' => 'Changing Room'],
            ['type' => 'Shower'],
            ['type' => 'Private Meeting Room'],
        ]);
    }
}
