<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pictures', function(Blueprint $table)
		{
            $table->increments('id');

            $table->string('title');
            $table->text('url');

            $table->integer('apartment_id')->unsigned();
            $table->foreign('apartment_id')->references('id')->on('apartments');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('pictures');

    }

}
