<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagnetismPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magnetism_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('option_id');
            $table->string('title');
            $table->text('description');
            $table->string('icon');
            $table->integer('points');
            $table->integer('status');
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
        Schema::dropIfExists('magnetism_packages');
    }
}
