<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewIndicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_indicators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('target_name')->nullable();
            $table->string('indicator_number')->nullable();
            // $table->bigInteger('sub_theme_id')->nullable();

            $table->string('indicator_name')->nullable();
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
        Schema::dropIfExists('new_indicators');
    }
}
