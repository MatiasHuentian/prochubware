<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProcessesUpgradeProposalsTable extends Migration
{
    public function up()
    {
        Schema::table('processes_upgrade_proposals', function (Blueprint $table) {
            $table->unsignedBigInteger('process_id')->nullable();
            $table->foreign('process_id', 'process_fk_9106979')->references('id')->on('processes');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_9106980')->references('id')->on('upgrade_proposals_states');
        });
    }
}
