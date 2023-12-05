<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessesKpisTable extends Migration
{
    public function up()
    {
        Schema::create('processes_kpis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->longText('calculate_form')->nullable();
            $table->longText('ubication_data')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
