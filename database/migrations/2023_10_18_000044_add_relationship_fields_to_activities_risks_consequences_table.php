<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToActivitiesRisksConsequencesTable extends Migration
{
    public function up()
    {
        Schema::table('activities_risks_consequences', function (Blueprint $table) {
            $table->unsignedBigInteger('risk_id')->nullable();
            $table->foreign('risk_id', 'risk_fk_9107206')->references('id')->on('activities_risks');
        });
    }
}
