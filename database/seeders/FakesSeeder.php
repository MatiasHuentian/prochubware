<?php

namespace Database\Seeders;

use App\Models\Dependency;
use App\Models\Direction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakesSeeder extends Seeder
{

    public function run(): void
    {
        $i = 0;
        $i++;
        Direction::firstOrCreate([
            'id' => $i
        ],[
            'name' => 'Tránsito'
        ]);
        $i++;
        Direction::firstOrCreate([
            'id' => $i
        ],[
            'name' => 'Dideco'
        ]);
        $i++;
        Direction::firstOrCreate([
            'id' => $i
        ],[
            'name' => 'Emergencias'
        ]);
        $i++;
        Direction::firstOrCreate([
            'id' => $i
        ],[
            'name' => 'Seguridad'
        ]);
        $i++;
        Direction::firstOrCreate([
            'id' => $i
        ],[
            'name' => 'Aseo y ornato'
        ]);

        $i = 0;
        for ($index=0; $index < 5 ; $index++) {
            $i++;
            $direction_id = ($index+1);
            Dependency::firstOrCreate([
                'id' => $i
            ],[
                'name' => 'RRHH',
                'direction_id' => $direction_id
            ]);
            $i++;
            Dependency::firstOrCreate([
                'id' => $i
            ],[
                'name' => 'Finanzas',
                'direction_id' => $direction_id
            ]);
            $i++;
            Dependency::firstOrCreate([
                'id' => $i
            ],[
                'name' => 'Control de Gestión',
                'direction_id' => $direction_id
            ]);
        }

    }
}
