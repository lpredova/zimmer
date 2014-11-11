<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeTableRoomHasFitting extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('room_has_fitting', function(Blueprint $table)
		{
            $table->integer('room_id')->unsigned();
            $table->foreign('room_id')->references('id')->on('rooms');

            $table->integer('fitting_id')->unsigned();
            $table->foreign('fitting_id')->references('id')->on('fittings');

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
        Schema::drop('room_has_fitting');

    }

}
