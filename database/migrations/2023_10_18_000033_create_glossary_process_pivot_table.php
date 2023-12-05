<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlossaryProcessPivotTable extends Migration
{
    public function up()
    {
        Schema::create('glossary_process', function (Blueprint $table) {
            $table->unsignedBigInteger('process_id');
            $table->foreign('process_id', 'process_id_fk_9085895')->references('id')->on('processes')->onDelete('cascade');
            $table->unsignedBigInteger('glossary_id');
            $table->foreign('glossary_id', 'glossary_id_fk_9085895')->references('id')->on('glossaries')->onDelete('cascade');
        });
    }
}
