<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlossariesTable extends Migration
{
    public function up()
    {
        Schema::create('glossaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('term');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
