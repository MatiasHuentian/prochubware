<?php

namespace Database\Seeders;

use App\Models\ActivitiesRisksCause;
use App\Models\ActivitiesRisksImpact;
use App\Models\ActivitiesRisksPolitic;
use App\Models\ActivitiesRisksProbability;
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
            ],
            [
                'name' => 'Permanente'
            ]
        );
        $i++;
        RisksControlsFrecuency::firstOrCreate(
            [
                'id' => $i
            ],
            [
                'name' => 'Periódico'
            ]
        );
        $i++;
        RisksControlsFrecuency::firstOrCreate(
            [
                'id' => $i
            ],
            [
                'name' => 'Ocasional'
            ]
        );

        $i = 0;

        $i++;
        RisksControlsType::firstOrCreate(
            [
                'id' => $i
            ],
            [
                'name' => 'Preventivo'
            ]
        );
        $i++;
        RisksControlsType::firstOrCreate(
            [
                'id' => $i
            ],
            [
                'name' => 'Correctivo'
            ]
        );
        $i++;
        RisksControlsType::firstOrCreate(
            [
                'id' => $i
            ],
            [
                'name' => 'Detectivo'
            ]
        );

        $i = 0;
        $i++;
        RisksControlsMethod::firstOrCreate(
            [
                'id' => $i
            ],
            [
                'name' => 'Automatizado'
            ]
        );
        $i++;
        RisksControlsMethod::firstOrCreate(
            [
                'id' => $i
            ],
            [
                'name' => 'Semi-automatizado'
            ]
        );
        $i++;
        RisksControlsMethod::firstOrCreate(
            [
                'id' => $i
            ],
            [
                'name' => 'Manual'
            ]
        );

        $i = 0;
        $i++;
        ActivitiesRisksProbability::firstOrCreate(
            ['id' => $i],
            [
                'name' => 'Muy Probable',
                // 'value' => 5
            ]
        );
        $i++;
        ActivitiesRisksProbability::firstOrCreate(
            ['id' => $i],
            [
                'name' => 'Probable',
                // 'value' => 4
            ]
        );
        $i++;
        ActivitiesRisksProbability::firstOrCreate(
            ['id' => $i],
            [
                'name' => 'Moderado',
                // 'value' => 3
            ]
        );
        $i++;
        ActivitiesRisksProbability::firstOrCreate(
            ['id' => $i],
            [
                'name' => 'Improbable',
                // 'value' => 2
            ]
        );
        $i++;
        ActivitiesRisksProbability::firstOrCreate(
            ['id' => $i],
            [
                'name' => 'Muy Improbable',
                // 'value' => 1
            ]
        );

        $i = 0;
        $i++;
        ActivitiesRisksImpact::firstOrCreate(['id' => $i], [
            'name' => 'Muy Alto',
            // 'value' => ($i+1),
        ]);
        $i++;
        ActivitiesRisksImpact::firstOrCreate(['id' => $i], [
            'name' => 'Mayor',
            // 'value' => ($i+1),
        ]);
        $i++;
        ActivitiesRisksImpact::firstOrCreate(['id' => $i], [
            'name' => 'Moderado',
            // 'value' => ($i+1),
        ]);
        $i++;
        ActivitiesRisksImpact::firstOrCreate(['id' => $i], [
            'name' => 'Menor',
            // 'value' => ($i+1),
        ]);
        $i++;
        ActivitiesRisksImpact::firstOrCreate(['id' => $i], [
            'name' => 'Insignificante',
            // 'value' => ($i+1),
        ]);

        $i = 0;
        $i++;
        ActivitiesRisksPolitic::firstOrCreate(['id' => $i], [
            'name' => 'Calidad',
        ]);
        $i++;
        ActivitiesRisksPolitic::firstOrCreate(['id' => $i], [
            'name' => 'Género',
        ]);
        $i++;
        ActivitiesRisksPolitic::firstOrCreate(['id' => $i], [
            'name' => 'Providad',
        ]);
    }
}
