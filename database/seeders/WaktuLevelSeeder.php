<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WaktuLevelSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['waktu' => '08:00-09:00'],
            ['waktu' => '09:00-10:00'],
            ['waktu' => '10:00-11:00'],
            ['waktu' => '11:00-12:00'],
            ['waktu' => '12:00-01:00'],
            ['waktu' => '13:00-14:00'],
            ['waktu' => '14:00-15:00'],
            ['waktu' => '15:00-16:00'],
            ['waktu' => '16:00-17:00'],
        ];

        DB::table('waktu_levels')->insert($data);
    }
}
