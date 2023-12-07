<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRisksControlsTable extends Migration
{
    public function up()
    {
        Schema::table('risks_controls', function (Blueprint $table) {
            $table->unsignedBigInteger('risk_id')->nullable();
            $table->foreign('risk_id', 'risk_fk_9107213')->references('id')->on('activities_risks');
            $table->unsignedBigInteger('frecuency_id')->nullable();
            $table->foreign('frecuency_id', 'frecuency_fk_9107215')->references('id')->on('risks_controls_frecuencies');
            $table->unsignedBigInteger('method_id')->nullable();
            $table->foreign('method_id', 'method_fk_9107216')->references('id')->on('risks_controls_methods');
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id', 'type_fk_9107217')->references('id')->on('risks_controls_types');
        });
    }
}
