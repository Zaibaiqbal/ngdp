<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_targets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('goal_number_id')->nullable();
            $table->string('target_number')->nullable();
            // $table->bigInteger('sub_theme_id')->nullable();

            $table->string('target_name',1000)->nullable();
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
        Schema::dropIfExists('new_targets');
    }
}
