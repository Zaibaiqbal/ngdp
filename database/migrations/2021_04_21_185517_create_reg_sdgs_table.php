<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegSdgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_sdgs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sdg_id')->nullable();
            $table->bigInteger('target_id')->nullable();
            $table->bigInteger('new_indicator_id')->nullable();
            $table->bigInteger('requirement_id')->nullable();
            $table->bigInteger('sub_theme_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reg_sdgs');
    }
}
