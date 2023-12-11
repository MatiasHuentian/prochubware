<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'title' => 'Super Administrador',
            ],
            [
                'id'    => 2,
                'title' => 'Usuario - administrador',
            ],
            [
                'id'    => 3,
                'title' => 'Usuario - invitado',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['id' => $role['id']],
                ['title' => $role['title']]
            );
        }

    }
}
