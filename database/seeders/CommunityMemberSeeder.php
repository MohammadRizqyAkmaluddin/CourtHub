<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommunityMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $member = [
            [
                'user_id' => 1, 'status' => 'Active', 'community_id' => 3, 'created_at' => now(), 'updated_at' => now()
            ],
        ];

        DB::table('community_members')->insert($member);
    }
}
