<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('fname')->nullable();
            $table->string('cnic')->nullable();
            $table->string('contact')->nullable();
            $table->string('address')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->unique();
            $table->string('designation')->nullable();
            $table->string('level')->nullable();
            $table->string('degree')->nullable();
            $table->string('organization')->nullable();
            $table->string('profession')->nullable();
            $table->string('option1')->nullable();
            $table->string('option2')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('registrations');
    }
}
