<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Factory as faker;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rate = [1, 2, 3, 4, 5];


        $venue = Venue::all();
        $users = User::all();
        
        for($i = 0; $i < $users; $i++) {

        }

        $rating = [
            [
                'user_id'  => 1,
                'venue_id' =>
            ]
        ]

        DB::table('ratings')->insert();
    }
}
