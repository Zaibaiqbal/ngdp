<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sub_theme_id')->nullable();
            $table->string('type')->nullable();
            $table->string('data_depiction')->nullable();
            $table->text('data_requirement')->nullable();
            $table->text('sdg_id')->nullable();
            $table->text('target_id')->nullable();
            $table->text('target_name')->nullable();
            $table->text('remarks')->nullable();
            $table->bigInteger('new_indicator_id')->nullable();
            $table->bigInteger('beijing_id')->nullable();
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
        Schema::dropIfExists('indicators');
    }
}
