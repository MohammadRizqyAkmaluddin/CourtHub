<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SportTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sport_types')->insert([
            ['type' => 'Football'],
            ['type' => 'Mini Soccer'],
            ['type' => 'Futsal'],
            ['type' => 'Badminton'],
            ['type' => 'Padel'],
            ['type' => 'Tennis'],
            ['type' => 'Basketball'],
            ['type' => 'Volley'],
            ['type' => 'Golf'],
            ['type' => 'Baseball'],
            ['type' => 'Softball'],
            ['type' => 'Table Tennis']
        ]);
    }
}
