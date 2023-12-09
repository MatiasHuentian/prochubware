<?php

namespace Database\Seeders;

use App\Models\Dependency;
use App\Models\Direction;
use App\Models\Glossary;
use App\Models\Input;
use App\Models\ObejctivesGroup;
use App\Models\Output;
use App\Models\Process;
use Database\Factories\objectivesGroupsFactory;
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
        ], [
            'name' => 'Tránsito'
        ]);
        $i++;
        Direction::firstOrCreate([
            'id' => $i
        ], [
            'name' => 'Dideco'
        ]);
        $i++;
        Direction::firstOrCreate([
            'id' => $i
        ], [
            'name' => 'Emergencias'
        ]);
        $i++;
        Direction::firstOrCreate([
            'id' => $i
        ], [
            'name' => 'Seguridad'
        ]);
        $i++;
        Direction::firstOrCreate([
            'id' => $i
        ], [
            'name' => 'Aseo y ornato'
        ]);

        $i = 0;
        for ($index = 0; $index < 5; $index++) {
            $i++;
            $direction_id = ($index + 1);
            Dependency::firstOrCreate([
                'id' => $i
            ], [
                'name' => 'RRHH',
                'direction_id' => $direction_id
            ]);
            $i++;
            Dependency::firstOrCreate([
                'id' => $i
            ], [
                'name' => 'Finanzas',
                'direction_id' => $direction_id
            ]);
            $i++;
            Dependency::firstOrCreate([
                'id' => $i
            ], [
                'name' => 'Control de Gestión',
                'direction_id' => $direction_id
            ]);
        }

        if (Glossary::all()->count() < 1) {
            Glossary::factory(10)->create();
        }
        if (Input::all()->count() < 1) {
            Input::factory(10)->create();
        }
        if (ObejctivesGroup::all()->count() < 1) {
            ObejctivesGroup::factory(10)->create();
        }
        if (Output::all()->count() < 1) {
            Output::factory(10)->create();
        }

        $this->call([
            AttachmentTableSeeder::class,
        ]);

        if (Process::all()->count() < 1 ){
            Process::factory(10)->create();
        }
    }
}
