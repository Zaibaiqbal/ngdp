<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('knowledge_theme_id')->nullable();
            // $table->bigInteger('sub_theme_id')->nullable();

            $table->string('title')->nullable();

            $table->text('url')->nullable();

            // NEW CHANGES AT 18TH OF AUG 2020
            $table->string('author')->nullable();
            $table->string('year')->nullable();
            $table->string('author_affilication')->nullable();
            $table->string('volume')->nullable();
            $table->string('issues')->nullable();
            $table->string('pages')->nullable();
            $table->string('isbn')->nullable();
            // END CHANGES AT 18TH OF AUG 2020
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
        Schema::dropIfExists('articles');
    }
}
