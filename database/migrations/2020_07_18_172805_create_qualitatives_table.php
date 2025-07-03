<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualitativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualitatives', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sub_theme_id')->nullable();
            $table->bigInteger('requirement_id')->nullable();
            $table->text('policy_name')->nullable();
            $table->text('legal_name')->nullable();
            $table->text('links')->nullable();
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
        Schema::dropIfExists('qualitatives');
    }
}
