<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToActivitiesRisksTable extends Migration
{
    public function up()
    {
        Schema::table('activities_risks', function (Blueprint $table) {
            $table->unsignedBigInteger('activity_id')->nullable();
            $table->foreign('activity_id', 'activity_fk_9107095')->references('id')->on('processes_activities');
            $table->unsignedBigInteger('politic_id')->nullable();
            $table->foreign('politic_id', 'politic_fk_9107115')->references('id')->on('activities_risks_politics');
            $table->unsignedBigInteger('probability_id')->nullable();
            $table->foreign('probability_id', 'probability_fk_9107116')->references('id')->on('activities_risks_probabilities');
            $table->unsignedBigInteger('impact_id')->nullable();
            $table->foreign('impact_id', 'impact_fk_9107117')->references('id')->on('activities_risks_impacts');
        });
    }
}
