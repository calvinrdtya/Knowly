<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BloodGroupsTableSeeder::class);
        $this->call(GradesTableSeeder::class);
        $this->call(ClassTypesTableSeeder::class);
        $this->call(UserTypesTableSeeder::class);
        $this->call(MyClassesTableSeeder::class);
        $this->call(NationalitiesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(DummyDataSeeder::class);
        $this->call(JadwalSeeder::class);
    }
}