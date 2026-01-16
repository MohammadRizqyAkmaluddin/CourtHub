<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdditionalTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('additional_types')->insert([
            ['sport_type_id' => '1', 'addon' => 'Ball Boy'],
            ['sport_type_id' => '2', 'addon' => 'Ball Boy'],
            ['sport_type_id' => '6', 'addon' => 'Ball Boy'],
            ['sport_type_id' => '8', 'addon' => 'Ball Boy'],
            ['sport_type_id' => '10', 'addon' => 'Ball Boy'],
            ['sport_type_id' => '11', 'addon' => 'Ball Boy'],

            ['sport_type_id' => '1', 'addon' => 'Coach'],
            ['sport_type_id' => '2', 'addon' => 'Coach'],
            ['sport_type_id' => '3', 'addon' => 'Coach'],
            ['sport_type_id' => '4', 'addon' => 'Coach'],
            ['sport_type_id' => '5', 'addon' => 'Coach'],
            ['sport_type_id' => '6', 'addon' => 'Coach'],
            ['sport_type_id' => '7', 'addon' => 'Coach'],
            ['sport_type_id' => '8', 'addon' => 'Coach'],
            ['sport_type_id' => '9', 'addon' => 'Coach'],
            ['sport_type_id' => '10', 'addon' => 'Coach'],
            ['sport_type_id' => '11', 'addon' => 'Coach'],
            ['sport_type_id' => '12', 'addon' => 'Coach'],

            ['sport_type_id' => '4', 'addon' => 'Racket'],
            ['sport_type_id' => '5', 'addon' => 'Racket'],
            ['sport_type_id' => '6', 'addon' => 'Racket'],

            ['sport_type_id' => '4', 'addon' => 'Shuttlecock'],

            ['sport_type_id' => '1', 'addon' => 'Ball'],
            ['sport_type_id' => '2', 'addon' => 'Ball'],
            ['sport_type_id' => '3', 'addon' => 'Ball'],
            ['sport_type_id' => '5', 'addon' => 'Ball'],
            ['sport_type_id' => '6', 'addon' => 'Ball'],
            ['sport_type_id' => '7', 'addon' => 'Ball'],
            ['sport_type_id' => '8', 'addon' => 'Ball'],
            ['sport_type_id' => '9', 'addon' => 'Ball'],
            ['sport_type_id' => '10', 'addon' => 'Ball'],
            ['sport_type_id' => '11', 'addon' => 'Ball'],
            ['sport_type_id' => '12', 'addon' => 'Ball'],

            ['sport_type_id' => '1', 'addon' => 'Photographer'],
            ['sport_type_id' => '2', 'addon' => 'Photographer'],
            ['sport_type_id' => '3', 'addon' => 'Photographer'],
            ['sport_type_id' => '4', 'addon' => 'Photographer'],
            ['sport_type_id' => '5', 'addon' => 'Photographer'],
            ['sport_type_id' => '6', 'addon' => 'Photographer'],
            ['sport_type_id' => '7', 'addon' => 'Photographer'],
            ['sport_type_id' => '8', 'addon' => 'Photographer'],
            ['sport_type_id' => '9', 'addon' => 'Photographer'],
            ['sport_type_id' => '10', 'addon' => 'Photographer'],
            ['sport_type_id' => '11', 'addon' => 'Photographer'],
            ['sport_type_id' => '12', 'addon' => 'Photographer'],

            ['sport_type_id' => '1', 'addon' => 'Goalkeeper Glove'],
            ['sport_type_id' => '2', 'addon' => 'Goalkeeper Glove'],
            ['sport_type_id' => '3', 'addon' => 'Goalkeeper Glove'],

            ['sport_type_id' => '10', 'addon' => 'Glove'],
            ['sport_type_id' => '11', 'addon' => 'Glove'],

            ['sport_type_id' => '9', 'addon' => 'Stick'],

            ['sport_type_id' => '9', 'addon' => 'Caddy'],

            ['sport_type_id' => '10', 'addon' => 'Bat'],
            ['sport_type_id' => '11', 'addon' => 'Bat'],
            ['sport_type_id' => '12', 'addon' => 'Bat'],

            ['sport_type_id' => '', 'addon' => ''],
            ['sport_type_id' => '', 'addon' => ''],
            ['sport_type_id' => '', 'addon' => ''],
            ['sport_type_id' => '', 'addon' => ''],
            ['sport_type_id' => '', 'addon' => ''],
            ['sport_type_id' => '', 'addon' => ''],
            ['sport_type_id' => '', 'addon' => ''],
            ['sport_type_id' => '', 'addon' => ''],
            ['sport_type_id' => '', 'addon' => ''],
            ['sport_type_id' => '', 'addon' => ''],
            ['sport_type_id' => '', 'addon' => ''],
        ]);
    }
}
