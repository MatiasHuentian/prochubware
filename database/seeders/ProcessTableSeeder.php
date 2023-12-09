<?php

namespace Database\Seeders;

use App\Models\ProcessesState;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProcessTableSeeder extends Seeder
{
    public function run(): void
    {
        $i = 0;
        $i++;
        ProcessesState::firstOrCreate([
            'id' => $i,

        ],[
            'name' => 'Borrador',
            'color' => 'FFB534'
        ]);

        $i++;
        ProcessesState::firstOrCreate([
            'id' => $i,
        ],[
            'name' => 'Finalizado',
            'color' => 'C1F2B0'
        ]);
    }
}
