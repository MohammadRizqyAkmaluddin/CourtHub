<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['city' => 'Jakarta Pusat', 'province' => 'DKI Jakarta'],
            ['city' => 'Jakarta Barat', 'province' => 'DKI Jakarta'],
            ['city' => 'Jakarta Utara', 'province' => 'DKI Jakarta'],
            ['city' => 'Jakarta Selatan', 'province' => 'DKI Jakarta'],
            ['city' => 'Jakarta Timur', 'province' =>'DKI Jakarta'],

            ['city' => 'Bandung', 'province' =>'Jawa Barat'],
            ['city' => 'Bekasi', 'province' =>'Jawa Barat'],
            ['city' => 'Bogor', 'province' =>'Jawa Barat'],
            ['city' => 'Depok', 'province' =>'Jawa Barat'],
            ['city' => 'Cimahi', 'province' =>'Jawa Barat'],
            ['city' => 'Tasikmalaya', 'province' =>'Jawa Barat'],
            ['city' => 'Banjar', 'province' =>'Jawa Barat'],
            ['city' => 'Sukabumi', 'province' =>'Jawa Barat'],
            ['city' => 'Cirebon', 'province' =>'Jawa Barat'],

            ['city' => 'Semarang', 'province' =>'Jawa Tengah'],
            ['city' => 'Surakarta', 'province' =>'Jawa Tengah'],
            ['city' => 'Salatiga', 'province' =>'Jawa Tengah'],
            ['city' => 'Pekalongan', 'province' =>'Jawa Tengah'],
            ['city' => 'Tegal', 'province' =>'Jawa Tengah'],
            ['city' => 'Magelang', 'province' =>'Jawa Tengah'],
            ['city' => 'Yogyakarta', 'province' =>'Jawa Tengah'],

            ['city' => 'Surabaya', 'province' =>'Jawa Timur'],
            ['city' => 'Malang', 'province' =>'Jawa Timur'],
            ['city' => 'Kediri', 'province' =>'Jawa Timur'],
            ['city' => 'Blitar', 'province' =>'Jawa Timur'],
            ['city' => 'Madiun', 'province' =>'Jawa Timur'],
            ['city' => 'Mojokerto', 'province' =>'Jawa Timur'],
            ['city' => 'Pasuruan', 'province' =>'Jawa Timur'],
            ['city' => 'Probolinggo', 'province' =>'Jawa Timur'],
            ['city' => 'Batu', 'province' =>'Jawa Timur'],

            ['city' => 'Tangerang', 'province' =>'Banten'],
            ['city' => 'Tangerang Selatan', 'province' =>'Banten'],
            ['city' => 'Serang', 'province' =>'Banten'],
            ['city' => 'Cilegon', 'province' =>'Banten'],
        ];

        foreach ($cities as $city) {
            DB::table('cities')->insert([
                'city' => $city['city'],
                'province' => $city['province'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
