<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            'Great place, very clean and well maintained.',
            'The staff was friendly and helpful.',
            'Nice venue but could be better.',
            'Amazing experience, will come again!',
            'Not bad, but parking was limited.',
            'The court quality is excellent.',
            'Worth the price.',
            'Lighting could be improved.',
            'Overall a good experience.',
            'The venue is clean and well maintained,and the overall atmosphere is comfortable.The staff was helpful from the moment we arrived until we finished playing. Definitely a place I would recommend to friends.',
            'Great place to play sports, especially if you come with friends. Booking was easy and the staff explained everything clearly. I’ll probably come back again in the near future',
            'I enjoyed my time here. The court surface is nice and feels well taken care of. It can get a bit crowded during peak hours, so coming earlier might be a better option',
            'I had a really good experience here. The court quality is solid and the lighting is good enough for evening games. There are a few minor things that could be improved, but overall it’s worth the price.',
            'Tempatnya cukup nyaman dan bersih. Fasilitas yang disediakan juga lengkap dan masih terawat dengan baik. Pelayanan staf ramah dan membantu, jadi overall pengalamannya cukup memuaskan.',
            'Tempat ini recommended untuk yang cari venue dengan kualitas yang konsisten. Pelayanannya cepat dan staf cukup sigap. Harga juga masih masuk akal dengan fasilitas yang didapat.',
            'Overall pengalamannya cukup baik. Suasana nyaman dan tidak terlalu berisik. Cocok untuk main bareng teman tanpa harus khawatir soal kenyamanan.',
            'Tempatnya nyaman dan bersih.',
            'Pelayanan ramah dan cepat.',
            'Cukup bagus untuk main bareng teman.',
            'Fasilitas lengkap dan terawat.',
            'Kurang puas dengan pelayanannya.',
            'Lapangan bagus, recommended.',
            'Harga sesuai dengan kualitas.',
            'Parkiran agak sempit.',
            'Overall oke sih.'
        ];

        $data = [];

        for ($userId = 1; $userId <= 35; $userId++) {

            $totalRatings = rand(5, 20);

            $venueIds = collect(range(1, 49))
                ->shuffle()
                ->take($totalRatings);

            foreach ($venueIds as $venueId) {
                $data[] = [
                    'user_id'   => $userId,
                    'venue_id'  => $venueId,
                    'rate'      => rand(3, 5),
                    'review'    => rand(0, 100) < 25
                                    ? null
                                    : Arr::random($reviews),
                    'created_at'=> Carbon::now()->subDays(rand(0, 60)),
                    'updated_at'=> Carbon::now(),
                ];
            }
        }

        DB::table('ratings')->insert($data);
    }
}
