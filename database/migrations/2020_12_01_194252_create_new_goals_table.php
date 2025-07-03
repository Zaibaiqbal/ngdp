<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_goals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('goal_number')->nullable();
            // $table->bigInteger('sub_theme_id')->nullable();

            $table->string('goal_name')->nullable();
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
        Schema::dropIfExists('new_goals');
    }
}
