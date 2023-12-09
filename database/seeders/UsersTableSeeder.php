<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'locale'         => 'es',
            ],
        ];
        if (User::where( 'id' , '=' , 1)->count() < 1) {
            User::insert($users);
        }

        $users = [
            [
                'id'             => 2,
                'name'           => 'Usuario prueba',
                'email'          => 'usuario@test.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'locale'         => 'es',
            ],
        ];
        if (User::where( 'id' , '=' , 2)->count() < 1) {
            User::insert($users);
        }
    }
}
