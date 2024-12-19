<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Qs;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $this->createNewUsers();
    }

    protected function createNewUsers()
    {
        $password = Hash::make('knowly');

        $d = [
            [
                'name' => 'Knowly',
                'email' => 'superadmin@gmail.com',
                'username' => 'Knowly',
                'my_class_id' => '0',
                'gender' => 'L',
                'absen' => null,
                'password' => $password,
                'user_type' => 'super_admin',
                'code' => strtoupper(Str::random(10)),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Guru',
                'email' => 'guru@gmail.com',
                'user_type' => 'teacher',
                'username' => 'Guru',
                'my_class_id' => '1',
                'gender' => 'P',
                'absen' => null,
                'password' => $password,
                'code' => strtoupper(Str::random(10)),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Siswa',
                'email' => 'siswa@gmail.com',
                'user_type' => 'student',
                'username' => 'Siswa',
                'my_class_id' => '1',
                'gender' => 'L',
                'absen' => '1',
                'password' => $password,
                'code' => strtoupper(Str::random(10)),
                'remember_token' => Str::random(10),
            ],
        ];
        DB::table('users')->insert($d);
    }
}
