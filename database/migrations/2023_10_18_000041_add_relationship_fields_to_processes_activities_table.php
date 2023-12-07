<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProcessesActivitiesTable extends Migration
{
    public function up()
    {
        Schema::table('processes_activities', function (Blueprint $table) {
            $table->unsignedBigInteger('process_id')->nullable();
            $table->foreign('process_id', 'process_fk_9106997')->references('id')->on('processes');
        });
    }
}
