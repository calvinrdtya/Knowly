<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'hari' => 'Senin',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '09:30:00',
                'class_id' => 1,
                'subject_id' => 1,
                'teacher_id' => 2,
                'room' => 'Ruang 101',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'hari' => 'Selasa',
                'jam_mulai' => '10:00:00',
                'jam_selesai' => '11:30:00',
                'class_id' => 1,
                'subject_id' => 1,
                'teacher_id' => 2,
                'room' => 'Ruang 202',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'hari' => 'Rabu',
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '14:30:00',
                'class_id' => 1,
                'subject_id' => 1,
                'teacher_id' => 2,
                'room' => 'Ruang 303',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('jadwals')->insert($data);

    }
}
