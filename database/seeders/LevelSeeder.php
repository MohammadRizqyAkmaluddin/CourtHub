<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            ['level' => 'All'],
            ['level' => 'Beginner'],
            ['level' => 'Intermediate'],
            ['level' => 'Advanced'],
            ['level' => 'Professional']
        ];

        DB::table('levels')->insert($levels);
    }
}
