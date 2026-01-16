<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name'          => 'Mohammad Rizqy Akmaluddin',
                'password'      => Hash::make('password123'),
                'phone'         => '081908196194',
                'email'         => 'mohammad.rizqy@gmail.com',
                'profile_image' => 'male1.jpg',
            ],
            [
                'name'          => 'Ahmad Fauzi',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567802',
                'email'         => 'ahmad.fauzi@gmail.com',
                'profile_image' => 'male2.jpg',
            ],
            [
                'name'          => 'Siti Nur Aisyah',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567803',
                'email'         => 'siti.nur@gmail.com',
                'profile_image' => 'female3.jpg',
            ],
            [
                'name'          => 'Budi Santoso Wijaya',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567804',
                'email'         => 'budi.santoso@gmail.com',
                'profile_image' => 'male4.jpg',
            ],
            [
                'name'          => 'Dewi Lestari',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567805',
                'email'         => 'dewi.lestari@gmail.com',
                'profile_image' => 'female5.jpg',
            ],
            [
                'name'          => 'Rizky Ramadhan',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567806',
                'email'         => 'rizky.ramadhan@gmail.com',
                'profile_image' => 'male6.jpg',
            ],
            [
                'name'          => 'Putri Ayu Safitri',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567807',
                'email'         => 'putri.ayu@gmail.com',
                'profile_image' => 'female7.jpg',
            ],
            [
                'name'          => 'Fajar Pratama',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567808',
                'email'         => 'fajar.pratama@gmail.com',
                'profile_image' => 'male8.jpg',
            ],
            [
                'name'          => 'Nabila Rahmawati',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567809',
                'email'         => 'nabila.rahmawati@gmail.com',
                'profile_image' => 'female9.jpg',
            ],
            [
                'name'          => 'Arif Hidayat',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567810',
                'email'         => 'arif.hidayat@gmail.com',
                'profile_image' => 'male10.jpg',
            ],
            [
                'name'          => 'Intan Permata Sari',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567811',
                'email'         => 'intan.permata@gmail.com',
                'profile_image' => 'female11.jpg',
            ],
            [
                'name'          => 'Dimas Saputra',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567812',
                'email'         => 'dimas.saputra@gmail.com',
                'profile_image' => 'male12.jpg',
            ],
            [
                'name'          => 'Aulia Rahman',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567813',
                'email'         => 'aulia.rahman@gmail.com',
                'profile_image' => 'male13.jpg',
            ],
            [
                'name'          => 'Nurul Hidayati',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567814',
                'email'         => 'nurul.hidayati@gmail.com',
                'profile_image' => 'female14.jpg',
            ],
            [
                'name'          => 'Yoga Prasetyo',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567815',
                'email'         => 'yoga.prasetyo@gmail.com',
                'profile_image' => 'male15.jpg',
            ],
            [
                'name'          => 'Maya Sari',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567816',
                'email'         => 'maya.sari@gmail.com',
                'profile_image' => 'female16.jpg',
            ],
            [
                'name'          => 'Randy Kurniawan',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567817',
                'email'         => 'randy.kurniawan@gmail.com',
                'profile_image' => 'male17.jpg',
            ],
            [
                'name'          => 'Fitri Handayani',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567818',
                'email'         => 'fitri.handayani@gmail.com',
                'profile_image' => 'female18.jpg',
            ],
            [
                'name'          => 'Ilham Maulana',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567819',
                'email'         => 'ilham.maulana@gmail.com',
                'profile_image' => 'male19.jpg',
            ],
            [
                'name'          => 'Rina Oktaviani',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567820',
                'email'         => 'rina.oktaviani@gmail.com',
                'profile_image' => 'female20.jpg',
            ],
            [
                'name'          => 'Agus Setiawan',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567821',
                'email'         => 'agus.setiawan@gmail.com',
                'profile_image' => 'male21.jpg',
            ],
            [
                'name'          => 'Bayu Pradana',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567822',
                'email'         => 'bayu.pradana@gmail.com',
                'profile_image' => 'male22.jpg',
            ],
            [
                'name'          => 'Lina Marlina',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567823',
                'email'         => 'lina.marlina@gmail.com',
                'profile_image' => 'female23.jpg',
            ],
            [
                'name'          => 'Rafi Nugroho',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567824',
                'email'         => 'rafi.nugroho@gmail.com',
                'profile_image' => 'male24.jpg',
            ],
            [
                'name'          => 'Salsa Putri',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567825',
                'email'         => 'salsa.putri@gmail.com',
                'profile_image' => 'female25.jpg',
            ],
            [
                'name'          => 'Aditya Saputra',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567826',
                'email'         => 'aditya.saputra@gmail.com',
                'profile_image' => 'male26.jpg',
            ],
            [
                'name'          => 'Wulan Anggraini',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567827',
                'email'         => 'wulan.anggraini@gmail.com',
                'profile_image' => 'female27.jpg',
            ],
            [
                'name'          => 'Hendra Gunawan',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567828',
                'email'         => 'hendra.gunawan@gmail.com',
                'profile_image' => 'male28.jpg',
            ],
            [
                'name'          => 'Melati Puspitasari',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567829',
                'email'         => 'melati.puspitasari@gmail.com',
                'profile_image' => 'female29.jpg',
            ],
            [
                'name'          => 'Rangga Wijaya',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567830',
                'email'         => 'rangga.wijaya@gmail.com',
                'profile_image' => 'male30.jpg',
            ],
            [
                'name'          => 'Citra Lestari',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567831',
                'email'         => 'citra.lestari@gmail.com',
                'profile_image' => 'female31.jpg',
            ],
            [
                'name'          => 'Fikri Alamsyah',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567832',
                'email'         => 'fikri.alamsyah@gmail.com',
                'profile_image' => 'male32.jpg',
            ],
            [
                'name'          => 'Anisa Kurniati',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567833',
                'email'         => 'anisa.kurniati@gmail.com',
                'profile_image' => 'female33.jpg',
            ],
            [
                'name'          => 'Rio Pamungkas',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567834',
                'email'         => 'rio.pamungkas@gmail.com',
                'profile_image' => 'male34.jpg',
            ],
            [
                'name'          => 'Selvi Oktarina',
                'password'      => Hash::make('password123'),
                'phone'         => '081234567835',
                'email'         => 'selvi.oktarina@gmail.com',
                'profile_image' => 'female35.jpg',
            ],
        ];

        DB::table('users')->insert($users);
    }
}
