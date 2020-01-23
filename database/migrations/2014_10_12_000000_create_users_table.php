<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->date('born_date')->nullable();
            $table->integer('gender')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('theme')->nullable();
            $table->integer('status');
            $table->integer('role');
            $table->string('one_signal_id')->nullable();
            $table->string('username')->nullable();
            $table->string('instagram_id')->nullable();
            $table->string('last_name')->nullable();
            $table->string('likes')->nullable();
            $table->string('followers')->nullable();
            $table->string('comments')->nullable();
            $table->string('videos')->nullable();
            $table->string('followers_count')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
