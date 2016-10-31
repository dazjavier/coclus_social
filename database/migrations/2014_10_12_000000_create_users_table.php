<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('lastname')->nullable();
            $table->string('username')->nullable();
            $table->string('profile_type')->nullable();
            $table->string('comuna')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('avatar')->default('default.png');
            $table->string('password')->nullable();
            $table->string('address')->nullable();
            $table->tinyInteger('has_profile_set');
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
        Schema::drop('users');
    }
}
