<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CommunitySeeder extends Seeder
{
    public function run(): void
    {
        $communities = [
            ['sport' => 1, 'name' => 'Jakarta Football United'],
            ['sport' => 2, 'name' => 'Urban Minisoccer League'],
            ['sport' => 3, 'name' => 'Night Futsal Society'],
            ['sport' => 3, 'name' => 'Elite Futsal Squad'],
            ['sport' => 4, 'name' => 'Smash Badminton Crew'],
            ['sport' => 4, 'name' => 'Jakarta Shuttle Club'],
            ['sport' => 5, 'name' => 'Padel Republic ID'],
            ['sport' => 6, 'name' => 'Jakarta Tennis Circle'],
            ['sport' => 7, 'name' => 'Downtown Basketball Squad'],
            ['sport' => 8, 'name' => 'Volley Vibes Community'],
            ['sport' => 9, 'name' => 'Weekend Golf Society'],
            ['sport' => 10, 'name' => 'Jakarta Baseball Brotherhood'],
            ['sport' => 11, 'name' => 'Softball Sisters Jakarta'],
            ['sport' => 14, 'name' => 'Sunrise Yoga Collective'],
            ['sport' => 1, 'name' => 'Bekasi Football Arena'],
        ];

        shuffle($communities); // random urutan tapi tetap unik

        $addressTemplates = [
            'Jl. Melati No. %d, RT %d/RW %d',
            'Jl. Kenanga Raya Blok %s No. %d',
            'Komplek Griya Olahraga Blok %s%d',
            'Jl. Anggrek Sport Center Kav %d',
            'Jl. Boulevard Atletik No. %d',
            'Area Lapangan Terbuka %s %d',
            'Jl. Pahlawan Arena No. %d',
            'Gedung Serbaguna %s Lantai %d',
            'Jl. Taman Rekreasi No. %d',
            'Lapangan Komunitas Blok %s-%d'
        ];

        foreach ($communities as $index => $data) {

            $useVenue = $index % 2 === 0;

            $totalMember = rand(15, 35);
            $maxSlot = rand($totalMember + 5, $totalMember + 20);

            $startTime = Carbon::createFromTime(rand(6, 19), 0);
            $endTime = (clone $startTime)->addHours(rand(1, 3));

            $cityId = rand(1, 8);

            $imageName = 'image-' . str_replace('-', '', Str::slug($data['name'])) . '.jpg';

            $venueId = $useVenue ? rand(1, 20) : null;

            $address = null;
            if (!$useVenue) {
                $format = $addressTemplates[array_rand($addressTemplates)];

                $address = sprintf(
                    $format,
                    rand(1,200),
                    rand(1,20),
                    rand(1,20),
                    strtoupper(fake()->randomLetter()),
                    rand(1,50)
                );
            }

            DB::table('communities')->insert([
                'user_id' => rand(1, 15),
                'venue_id' => $venueId,
                'sport_type_id' => $data['sport'],
                'city_id' => $useVenue ? null : $cityId,

                'name' => $data['name'],

                // ⭐ NEW FIELD
                'venue_name' => $useVenue
                    ? null
                    : 'Lapangan Mandiri ' . fake()->citySuffix(),

                'address' => $address,

                'latitude' => $useVenue ? null : fake()->latitude(-6.6, -6.1),
                'longitude' => $useVenue ? null : fake()->longitude(106.5, 107.0),

                'membership_fee' => rand(50, 300) * 1000,
                'total_member' => $totalMember,
                'max_slot' => $maxSlot,

                'description' => 'Komunitas aktif dengan sesi latihan rutin mingguan.',

                'image' => $imageName,

                'day_of_week' => rand(1, 7),
                'start_time' => $startTime->format('H:i:s'),
                'end_time' => $endTime->format('H:i:s'),

                'created_at' => now(),
                'updated_at' => now(),
            ]);

        }
    }
}
