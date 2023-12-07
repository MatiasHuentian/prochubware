<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProcessesTable extends Migration
{
    public function up()
    {
        Schema::table('processes', function (Blueprint $table) {
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->foreign('owner_id', 'owner_fk_9103149')->references('id')->on('users');
            $table->unsignedBigInteger('dependency_id')->nullable();
            $table->foreign('dependency_id', 'dependency_fk_9103150')->references('id')->on('dependencies');
            $table->unsignedBigInteger('state_id')->nullable();
            $table->foreign('state_id', 'state_fk_9103151')->references('id')->on('processes_states');
        });
    }
}
