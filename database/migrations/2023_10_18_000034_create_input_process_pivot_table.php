<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputProcessPivotTable extends Migration
{
    public function up()
    {
        Schema::create('input_process', function (Blueprint $table) {
            $table->unsignedBigInteger('process_id');
            $table->foreign('process_id', 'process_id_fk_9103156')->references('id')->on('processes')->onDelete('cascade');
            $table->unsignedBigInteger('input_id');
            $table->foreign('input_id', 'input_id_fk_9103156')->references('id')->on('inputs')->onDelete('cascade');
        });
    }
}
