<?php

namespace Database\Seeders;

use App\Models\RisksControlsFrecuency;
use App\Models\RisksControlsMethod;
use App\Models\RisksControlsType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RisksSeeders extends Seeder
{
    public function run(): void
    {
        $i = 0;
        $i++;
        RisksControlsFrecuency::firstOrCreate(
            [
                'id' => $i
            ],[
                'name' => 'Permanente'
            ]
        );
        $i++;
        RisksControlsFrecuency::firstOrCreate(
            [
                'id' => $i
            ],[
                'name' => 'Periódico'
            ]
        );
        $i++;
        RisksControlsFrecuency::firstOrCreate(
            [
                'id' => $i
            ],[
                'name' => 'Ocasional'
            ]
        );

        $i = 0;

        $i++;
        RisksControlsType::firstOrCreate(
            [
                'id' => $i
            ],[
                'name' => 'Preventivo'
            ]
        );
        $i++;
        RisksControlsType::firstOrCreate(
            [
                'id' => $i
            ],[
                'name' => 'Correctivo'
            ]
        );
        $i++;
        RisksControlsType::firstOrCreate(
            [
                'id' => $i
            ],[
                'name' => 'Detectivo'
            ]
        );

        $i = 0;
        $i++;
        RisksControlsMethod::firstOrCreate(
            [
                'id' => $i
            ],[
                'name' => 'Automatizado'
            ]
        );
        $i++;
        RisksControlsMethod::firstOrCreate(
            [
                'id' => $i
            ],[
                'name' => 'Semi-automatizado'
            ]
        );
        $i++;
        RisksControlsMethod::firstOrCreate(
            [
                'id' => $i
            ],[
                'name' => 'Manual'
            ]
        );
    }
}
