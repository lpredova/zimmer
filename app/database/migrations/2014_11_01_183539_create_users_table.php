<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('name');
            $table->string('surname');
            $table->string('username');
            $table->string('password');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('avatar')->nullable();
            $table->boolean('activated');
            $table->text('activation_token');
            $table->rememberToken();


            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');

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
