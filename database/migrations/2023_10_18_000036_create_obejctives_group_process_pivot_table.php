<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObejctivesGroupProcessPivotTable extends Migration
{
    public function up()
    {
        Schema::create('obejctives_group_process', function (Blueprint $table) {
            $table->unsignedBigInteger('process_id');
            $table->foreign('process_id', 'process_id_fk_9103158')->references('id')->on('processes')->onDelete('cascade');
            $table->unsignedBigInteger('obejctives_group_id');
            $table->foreign('obejctives_group_id', 'obejctives_group_id_fk_9103158')->references('id')->on('obejctives_groups')->onDelete('cascade');
        });
    }
}
