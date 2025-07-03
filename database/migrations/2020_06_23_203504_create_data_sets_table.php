<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_sets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('knowledge_theme_id')->nullable();
            // $table->bigInteger('sub_theme_id')->nullable();

            $table->string('title')->nullable();

            $table->text('summary')->nullable();

            $table->text('url')->nullable();
            $table->string('pdf')->nullable();

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
        Schema::dropIfExists('data_sets');
    }
}
