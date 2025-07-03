<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLawAndRegulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('law_and_regulations', function (Blueprint $table) {
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
        Schema::dropIfExists('law_and_regulations');
    }
}
