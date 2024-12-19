<?php
namespace Database\Seeders;

use App\Models\Nationality;
use Illuminate\Database\Seeder;


class NationalitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nationals = array(
            'Indonesia'
        );

        foreach ($nationals as $n) {
            Nationality::create(['name' => $n]);
        }
    }
}
