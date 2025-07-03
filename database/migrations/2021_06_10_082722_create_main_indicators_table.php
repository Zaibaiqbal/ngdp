<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainIndicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_indicators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('indicator_id')->nullable();
            $table->string('survey_level')->nullable();
            $table->bigInteger('province_id')->nullable();
            $table->bigInteger('district_id')->nullable();
            $table->bigInteger('division_id')->nullable();
            $table->string('nature')->nullable();
            $table->string('data_source_name')->nullable();
            $table->string('source_link')->nullable();
            $table->string('unit')->nullable();
            $table->string('base_year')->nullable();
            $table->string('base_value')->nullable();
            $table->string('current_year')->nullable();
            $table->string('current_value')->nullable();
            $table->string('footnote')->nullable();
            $table->string('lower_year')->nullable();
            $table->string('upper_year')->nullable();
            $table->string('sex')->nullable();
            $table->string('age_group')->nullable();
            $table->string('residence')->nullable();
            $table->string('specific_name1')->nullable();
            $table->string('specific_description1')->nullable();
            $table->string('specific_name2')->nullable();
            $table->string('specific_description2')->nullable();
            $table->string('specific_name3')->nullable();
            $table->string('specific_description3')->nullable();
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
        Schema::dropIfExists('main_indicators');
    }
}
