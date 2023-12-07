<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutputProcessPivotTable extends Migration
{
    public function up()
    {
        Schema::create('output_process', function (Blueprint $table) {
            $table->unsignedBigInteger('process_id');
            $table->foreign('process_id', 'process_id_fk_9103157')->references('id')->on('processes')->onDelete('cascade');
            $table->unsignedBigInteger('output_id');
            $table->foreign('output_id', 'output_id_fk_9103157')->references('id')->on('outputs')->onDelete('cascade');
        });
    }
}
