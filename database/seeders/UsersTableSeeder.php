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
        $this->createManyUsers( 3);
    }

    protected function createNewUsers()
    {
        $password = Hash::make('11111111');

        $d = [

            [
                'name' => 'Knowly',
                'email' => 'superadmin@gmail.com',
                'username' => 'Knowly',
                'password' => $password,
                'user_type' => 'super_admin',
                'code' => strtoupper(Str::random(10)),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => $password,
                'user_type' => 'admin',
                'username' => 'admin',
                'code' => strtoupper(Str::random(10)),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Guru  1',
                'email' => 'guru@gmail.com',
                'user_type' => 'teacher',
                'username' => 'Guru 1',
                'password' => $password,
                'code' => strtoupper(Str::random(10)),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Ortu',
                'email' => 'ortu@gmail.com',
                'user_type' => 'parent',
                'username' => 'ortu',
                'password' => $password,
                'code' => strtoupper(Str::random(10)),
                'remember_token' => Str::random(10),
            ],

            [
                'name' => 'keuangan',
                'email' => 'keuangan@gmail.com',
                'user_type' => 'accountant',
                'username' => 'keuangan',
                'password' => $password,
                'code' => strtoupper(Str::random(10)),
                'remember_token' => Str::random(10),
            ],
        ];
        DB::table('users')->insert($d);
    }

    protected function createManyUsers(int $count)
    {
        $data = [];
        $user_type = Qs::getAllUserTypes(['super_admin', 'librarian', 'student']);

        for($i = 1; $i <= $count; $i++){

            foreach ($user_type as $k => $ut){

                $data[] = ['name' => ucfirst($user_type[$k]).' '.$i,
                    'email' => $user_type[$k].$i.'@'.$user_type[$k].'.com',
                    'user_type' => $user_type[$k],
                    'username' => $user_type[$k].$i,
                    'password' => Hash::make($user_type[$k]),
                    'code' => strtoupper(Str::random(10)),
                    'remember_token' => Str::random(10),
                ];

            }

        }

        DB::table('users')->insert($data);
    }
}
