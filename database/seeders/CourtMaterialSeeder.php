<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourtMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('court_materials')->insert([
            ['material_type' => 'Hard Court'],
            ['material_type' => 'Clay Court'],
            ['material_type' => 'Grass Court']
        ]);
    }
}
