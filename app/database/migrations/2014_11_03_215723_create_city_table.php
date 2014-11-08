<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('city', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('name');
            $table->float('lat');
            $table->float('lng');

            $table->integer('apartment_id')->unsigned();
            $table->foreign('apartment_id')->references('id')->on('country');
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
        Schema::drop('city');
	}

}
