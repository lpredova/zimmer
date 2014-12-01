<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('apartments', function(Blueprint $table)
		{
            $table->increments('id');

            $table->string('name');
            $table->string('description');
            $table->integer('capacity');
            $table->integer('stars');
            $table->text('address');
            $table->string('email');
            $table->string('phone');
            $table->string('phone_2');
            $table->integer('rating');
            $table->float('lat');
            $table->float('lng');
            $table->float('price');
            $table->text('cover_photo');


            //owners foreign key
            $table->integer('owner_id')->unsigned();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');

            //type foreign key
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('apartment_types')->onDelete('cascade');

            //country foreign key
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('city')->onDelete('cascade');

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
        Schema::drop('apartments');

    }

}
