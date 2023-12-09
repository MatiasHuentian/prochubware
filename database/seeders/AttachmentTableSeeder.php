<?php

namespace Database\Seeders;

use App\Models\AttachmentsCategory;
use App\Models\AttachmentsType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttachmentTableSeeder extends Seeder
{
    public function run(): void
    {
        $i=0;

        $i++;
        AttachmentsCategory::firstOrCreate(['id' => $i],[
            'name' => 'Leyes'
        ]);
        $i++;
        AttachmentsCategory::firstOrCreate(['id' => $i],[
            'name' => 'Pruebas'
        ]);
        $i++;
        AttachmentsCategory::firstOrCreate(['id' => $i],[
            'name' => 'Reemplazo de categoría'
        ]);
    }
}
