<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDependenciesTable extends Migration
{
    public function up()
    {
        Schema::table('dependencies', function (Blueprint $table) {
            $table->unsignedBigInteger('direction_id')->nullable();
            $table->foreign('direction_id', 'direction_fk_9080325')->references('id')->on('directions');
        });
    }
}
