<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informations', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('requirement_id')->nullable();
          $table->string('survey_level')->nullable();
          $table->bigInteger('province_id')->nullable();
          $table->string('sex')->nullable();
          $table->string('age_group')->nullable();
          $table->string('residence')->nullable();
          $table->string('data_source_name')->nullable();
          $table->string('source_link')->nullable();
          $table->string('unit')->nullable();
          $table->string('base_year')->nullable();
          $table->string('base_value')->nullable();
          $table->string('current_year')->nullable();
          $table->string('current_value')->nullable();
          $table->string('footnote')->nullable();
          $table->string('nature')->nullable();
          $table->string('specific_name')->nullable();
          $table->string('specific_title')->nullable();
          $table->string('last_updated')->nullable();
          $table->string('year_one')->nullable();
          $table->string('year_two')->nullable();
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
        Schema::dropIfExists('informations');
    }
}
