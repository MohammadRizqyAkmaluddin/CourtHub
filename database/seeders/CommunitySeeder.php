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

        shuffle($communities);

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

        $descriptionTemplates = [

            <<<HTML
            <p><strong>About This Community</strong></p>

            <p>
            Komunitas ini dibuat untuk orang-orang yang ingin punya rutinitas aktif setiap minggu tanpa tekanan kompetitif.
            Tujuannya sederhana: datang, gerak, ngobrol, dan pulang dengan mood lebih baik.
            Banyak member awalnya datang sendirian, tapi lama-lama jadi punya circle tetap.
            </p>

            <p>
            Kami percaya konsistensi lebih penting daripada skill.
            Karena itu sesi dibuat santai, semua orang dapat giliran, dan gak ada senioritas.
            Yang baru pertama datang pun akan tetap diajak main bareng.
            </p>

            <ul>
            <li>Kapasitas maksimal: <strong>{{ community.max_slot }} orang</strong></li>
            <li>Level pemain: <strong>{{ community.level.level }}</strong></li>
            <li>Kontribusi sesi: <strong>{{ formatCurrency(community.membership_fee) }}</strong></li>
            </ul>

            <p>
            Biasanya setelah sesi selesai, beberapa member lanjut ngobrol atau makan bareng.
            Jadi bukan cuma aktivitas fisik — tapi juga tempat recharge sosial mingguan.
            </p>
            HTML
            ,

            <<<HTML
            <p><strong>Weekly Gathering Session</strong></p>

            <p>
            Ini bukan tempat buat pamer jago.
            Ini tempat buat datang rutin, ketemu orang yang sama tiap minggu, dan ngebangun kebiasaan sehat.
            Tempo permainan disesuaikan supaya semua bisa ikut tanpa merasa tertinggal.
            </p>

            <p>
            Host akan bantu rotasi pemain agar semua dapat kesempatan yang adil.
            Member baru akan dipandu di awal, jadi gak perlu takut awkward.
            </p>

            <ul>
            <li>Slot tersedia: <strong>{{ community.max_slot - community.total_member}} peserta</strong></li>
            <li>Kategori kemampuan: <strong>{{ community.level.level }}</strong></li>
            <li>Biaya partisipasi: <strong>{{ formatCurrency(community.membership_fee) }}</strong></li>
            </ul>

            <p>
            Mayoritas member datang bukan cuma buat main, tapi buat reset pikiran setelah aktivitas harian.
            Datang capek, pulang lebih ringan.
            </p>
            HTML
            ,

            <<<HTML
            <p><strong>Community Session</strong></p>

            <p>
            Sesi ini dirancang sebagai ruang aktif mingguan yang konsisten.
            Tidak terlalu serius, tapi tetap cukup terstruktur supaya semua orang merasa terlibat.
            Atmosfer dibuat suportif — kesalahan itu normal dan justru bagian dari proses.
            </p>

            <p>
            Setiap minggu biasanya komposisi orangnya campur:
            ada yang baru pertama, ada yang sudah rutin berbulan-bulan.
            Justru di situ serunya, karena interaksi selalu beda.
            </p>

            <ul>
            <li>Maksimal peserta: <strong>{{ community.max_slot }}</strong></li>
            <li>Tingkat permainan: <strong>{{ community.level.level }}</strong></li>
            <li>Iuran sesi: <strong>{{ formatCurrency(community.membership_fee) }}</strong></li>
            </ul>

            <p>
            Harap datang tepat waktu supaya flow sesi tetap enak buat semua.
            Datang untuk aktivitasnya, pulang bawa kenalan baru 🙌
            </p>
            HTML

            ,

            <<<HTML
            <p><strong>A Place To Stay Active</strong></p>

            <p>
            Banyak orang pengen rutin aktif tapi sering berhenti di tengah jalan.
            Di sini kita bikin rutinitas itu lebih ringan — gak harus jago, gak harus kenal siapa-siapa dulu.
            Datang beberapa kali biasanya sudah mulai hafal muka-muka yang sama.
            </p>

            <p>
            Member lama biasanya bantu cairin suasana, jadi yang baru gak akan ditinggal sendiri.
            Tujuan utamanya bukan performa, tapi konsistensi.
            </p>

            <ul>
            <li>Kapasitas sesi: <strong>{{ community.max_slot }} peserta</strong></li>
            <li>Kategori: <strong>{{ community.level.level }}</strong></li>
            <li>Kontribusi: <strong>{{ formatCurrency(community.membership_fee) }}</strong></li>
            </ul>

            <p>
            Kalau lagi hectic kerja atau kuliah, sesi ini sering jadi “pause button” mingguan.
            Gerak sebentar, ketawa sebentar, lalu balik ke rutinitas lagi.
            </p>
            HTML
            ,

            <<<HTML
            <p><strong>Routine Weekly Meetup</strong></p>

            <p>
            Komunitas ini cocok buat yang cari aktivitas stabil, bukan event sekali datang lalu hilang.
            Banyak member menjadikannya agenda tetap setiap minggu.
            </p>

            <p>
            Interaksinya santai, ngobrol ngalir, dan semua orang punya kesempatan ikut.
            Tidak ada tekanan harus tampil bagus — cukup hadir dan ikut flow.
            </p>

            <ul>
            <li>Peserta maksimal: <strong>{{ community.max_slot }}</strong></li>
            <li>Level: <strong>{{ community.level.level }}</strong></li>
            <li>Biaya: <strong>{{ formatCurrency(community.membership_fee) }}</strong></li>
            </ul>

            <p>
            Beberapa orang awalnya cuma coba-coba,
            tapi akhirnya malah jadi rutinitas paling ditunggu tiap minggu.
            </p>
            HTML
            ,

            <<<HTML
            <p><strong>Social Activity Session</strong></p>

            <p>
            Fokus utama komunitas ini bukan kompetisi, tapi interaksi.
            Aktivitas fisik jadi media supaya orang bisa kenalan tanpa canggung.
            </p>

            <p>
            Biasanya setelah beberapa pertemuan, suasana berubah jadi lebih cair karena sudah saling kenal.
            Makanya banyak yang betah lama di sini.
            </p>

            <ul>
            <li>Slot tersedia: <strong>{{ community.max_slot - community.total_member}}</strong></li>
            <li>Kemampuan: <strong>{{ community.level.level }}</strong></li>
            <li>Iuran: <strong>{{ formatCurrency(community.membership_fee) }}</strong></li>
            </ul>

            <p>
            Kalau lagi cari aktivitas yang gak monoton sendirian,
            ini bisa jadi salah satu opsi paling ringan buat mulai.
            </p>
            HTML
            ,

            <<<HTML
            <p><strong>Casual Group Session</strong></p>

            <p>
            Tidak semua orang nyaman langsung masuk lingkungan baru.
            Karena itu ritme sesi dibuat santai supaya adaptasinya natural.
            Biasanya dalam 2–3 kali datang sudah mulai kenal beberapa orang.
            </p>

            <p>
            Host akan bantu memastikan semua kebagian giliran dan gak ada yang tersisih.
            Tujuan kita semua pulang dalam keadaan lebih enak dari saat datang.
            </p>

            <ul>
            <li>Kapasitas: <strong>{{ community.max_slot }} orang</strong></li>
            <li>Tingkat: <strong>{{ community.level.level }}</strong></li>
            <li>Partisipasi: <strong>{{ formatCurrency(community.membership_fee) }}</strong></li>
            </ul>

            <p>
            Datang sendiri itu normal — hampir semua member awalnya begitu.
            </p>
            HTML
            ,

            <<<HTML
            <p><strong>Weekly Recharge Session</strong></p>

            <p>
            Anggap ini sebagai waktu jeda dari aktivitas harian.
            Beberapa jam untuk gerak, ngobrol, dan lepas dari layar.
            </p>

            <p>
            Tidak ada target performa.
            Yang penting hadir rutin dan menikmati prosesnya.
            </p>

            <ul>
            <li>Maksimal: <strong>{{ community.max_slot }} peserta</strong></li>
            <li>Level bermain: <strong>{{ community.level.level }}</strong></li>
            <li>Biaya sesi: <strong>{{ formatCurrency(community.membership_fee) }}</strong></li>
            </ul>

            <p>
            Banyak member bilang mereka datang capek,
            tapi pulang dengan energi baru.
            </p>
            HTML

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

            $template = $descriptionTemplates[array_rand($descriptionTemplates)];

            DB::table('communities')->insert([
                'user_id' => rand(1, 15),
                'venue_id' => $venueId,
                'sport_type_id' => $data['sport'],
                'city_id' => $useVenue ? null : $cityId,

                'level_id' => rand(1, 5),

                'name' => $data['name'],

                'venue_name' => $useVenue
                    ? null
                    : 'Lapangan Mandiri ' . fake()->citySuffix(),

                'address' => $address,

                'latitude' => $useVenue ? null : fake()->latitude(-6.6, -6.1),
                'longitude' => $useVenue ? null : fake()->longitude(106.5, 107.0),

                'membership_fee' => rand(50, 300) * 1000,
                'total_member' => $totalMember,
                'max_slot' => $maxSlot,

                'description' => $template,

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
