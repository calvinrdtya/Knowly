<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('class_types')->delete();

        $data = [
            ['name' => 'A', 'code' => 'A'],
            ['name' => 'B', 'code' => 'B'],
            ['name' => 'C', 'code' => 'C'],
            ['name' => 'D', 'code' => 'D'],
            ['name' => 'E', 'code' => 'E'],
            ['name' => 'F', 'code' => 'F'],
        ];
        DB::table('class_types')->insert($data);
    }
}