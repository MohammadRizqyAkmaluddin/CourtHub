<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // venue_id => default sport_type_id
        $venueSportMap = [
            1 => 5, 2 => 5, 3 => 5, 4 => 5,
            5 => 4,
            6 => 6,
            7 => 11,
            8 => 5, 9 => 5, 10 => 5, 11 => 5,
            12 => 6, 13 => 6,
            14 => 4,
            15 => 2, 16 => 2,
            17 => 5,
            18 => 6, 19 => 6,
            20 => 5,
            21 => 3,
            22 => 7,
            23 => 5,
            24 => 7, 25 => 7,
            26 => 9,
            27 => 1,
            28 => 5,
            29 => 7,
            30 => 3,
        ];

        $courtNames = [
            'Black Mamba Court',
            'Blue Ocean Court',
            'Lava Court',
            'Sky Arena',
            'Court A',
            'Court B',
            'Court C',
            'Prime Court',
            'Elite Court',
            'Alpha Court',
            'Phoenix Court',
            'Nebula Court',
        ];

        // harga normal Indonesia
        $sportBasePrice = [
            1 => [300000, 600000],
            2 => [150000, 300000],
            3 => [120000, 250000],
            4 => [40000, 80000],
            5 => [200000, 400000],
            6 => [150000, 350000],
            7 => [150000, 300000],
            8 => [100000, 200000],
            9 => [200000, 500000],
            10 => [200000, 400000],
            11 => [150000, 300000],
        ];

        // mapping image per sport
        $sportImages = [
            1  => ['football', 5],
            2  => ['minisoccer', 5],
            3  => ['futsal', 5],
            4  => ['badminton', 10],
            5  => ['padel', 20],
            6  => ['tennis', 10],
            7  => ['basketball', 10],
            8  => ['volley', 10],
            9  => ['golf', 5],
            10 => ['baseball', 5],
            11 => ['softball', 5],
        ];

        $rows = [];

        $duration = 0;

        foreach ($venueSportMap as $venueId => $defaultSport) {
            $totalCourts = rand(2, 6);

            for ($i = 1; $i <= $totalCourts; $i++) {

                if ($defaultSport === 5) {
                    $sportTypeId = rand(1, 100) <= 70
                        ? 5
                        : array_rand($sportBasePrice);
                } else {
                    $sportTypeId = rand(1, 100) <= 75
                        ? $defaultSport
                        : array_rand($sportBasePrice);
                }

                [$min, $max] = $sportBasePrice[$sportTypeId] ?? [100000, 250000];

                $rawPrice = rand($min, $max);
                $price = floor($rawPrice / 5000) * 5000;

                if (isset($sportImages[$sportTypeId])) {
                    [$prefix, $maxImage] = $sportImages[$sportTypeId];
                    $image = $prefix . rand(1, $maxImage) . '.jpg';
                } else {
                    $image = 'default.jpg';
                }

                if ($sportTypeId <= 2 || $sportTypeId === 9) {
                    $duration = 120;
                } else {
                    $duration = 60;
                }

                $rows[] = [
                    'venue_id' => $venueId,
                    'sport_type_id' => $sportTypeId,
                    'court_type_id' => rand(1, 2),
                    'court_material_id' => rand(1, 3),
                    'name' => $courtNames[array_rand($courtNames)],
                    'price' => $price,
                    'image' => $image,
                    'session_duration' => $duration
                ];
            }
        }

        // 🚀 bulk insert
        DB::table('courts')->insert($rows);
    }

}





// venue_id id(1 = padel, 2 = padel, 3 = padel, 4 = padel, 5 = badminton, 6 = tennis, 7 = softball, 8 = padel, 9 = padel, 10 = padel, 11 = padel, 12 = tennis, 13 = tennis, 14 = badminton, 15 = minisoccer, 16 = minisoccer, 17 = padel, 18 = tennis, 19 = tennis, 20 = padel, 21 = futsal, 22 = basketball, 23 = padel, 24 = basketball, 25 = basketball, 26 = golf indor, 27 = footbal, 28 = padel, 29 = basketball, 30 = futsal),
// court_material_id id(1 = hard court, 2 = clay court, 3 = grass court),
// court_type id(1 = indoor, 2 = outdoor),
// sport_type_id id(1 = Football, 2 = minisoccer, 3 = futsal, 4 = badminton, 5 = padel, 6 = tennis, 7 = basketball, 8 = volley, 9 = golf, 10 = baseball, 11 = softball, 12 = pilates, 13 = yoga, 14 = shootingrange)


// dari data diatas buatin seeder courts dengan kompleksitas tercepat untuk data yang besar
// note: - satu venue memiliki 2 sampai 6 court,
//       - khusus untuk venue padel pasti memiliki beberapa court dengan sport type padel, dan juga bisa punya court dengan tipe sport lainnya (tidak harus, bisa padel saja)
//       - untuk venue selain padel buatkan court dengan sport type sesuai dengan konteks venue tersebut, dan juga bisa ditambahkan court dengan sport type random lainnya
//       - untuk court_type dan court_material bebas saja secara random
//       - price buat senormal mungkin dengan harga di indonesia
//       - buatkan name yang keren ataupun yang cocok (boleh bahasa inggris boleh indo) contohnya Black Mamba Court, Blue Ocean Court, Lava Court , Court A, Court B, dll





// - kalau sport_type_id = 1, image = random(football1.jpg sampai football5.jpg)
// - kalau sport_type_id = 2, image = random(minisoccer1.jpg sampai minisocer5.jpg)
// - kalau sport_type_id = 3, image = random(futsal1.jpg sampai futsal5.jpg)
// - kalau sport_type_id = 4, image = random(badminton1.jpg sampai badminton10.jpg)
// - kalau sport_type_id = 5, image = random(padel1.jpg sampai padel15.jpg)
// - kalau sport_type_id = 6, image = random(tennis1.jpg sampai tennis10.jpg)
// - kalau sport_type_id = 7, image = random(basketball1.jpg sampai basketball10.jpg)
// - kalau sport_type_id = 8, image = random(volley1.jpg sampai volley10.jpg)
// - kalau sport_type_id = 9, image = random(golf1.jpg sampai golf5.jpg)
// - kalau sport_type_id = 10, image = random(baseball1.jpg sampai baseball5.jpg)
// - kalau sport_type_id = 11, image = random(softball1.jpg sampai softball5.jpg)
