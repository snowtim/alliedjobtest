<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstellationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constellations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->date('today_date');
            $table->string('constellation_name');
            $table->string('all_score');
            $table->string('all_description');
            $table->string('love_score');
            $table->string('love_description');
            $table->string('work_score');
            $table->string('work_description');
            $table->string('fortune_score');
            $table->string('fortune_description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('constellations');
    }
}
