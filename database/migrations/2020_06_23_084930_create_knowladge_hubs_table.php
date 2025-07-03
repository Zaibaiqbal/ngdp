<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKnowladgeHubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowladge_hubs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('knowledge_theme_id')->nullable();
            $table->string('title')->nullable();
            $table->timestamp('publication_date')->nullable();
            $table->string('author')->nullable();

            // $table->text('short_description')->nullable();
            $table->string('organization')->nullable();

            $table->text('summary')->nullable();
            $table->text('url')->nullable();
            $table->string('thumbnail')->nullable();
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
        Schema::dropIfExists('knowladge_hubs');
    }
}
