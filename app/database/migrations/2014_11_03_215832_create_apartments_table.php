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
            $table->text('address');
            $table->string('email');
            $table->string('phone');
            $table->string('phone_2');
            $table->integer('rating');
            $table->float('lat');
            $table->float('lng');


            //owners foreign key
            $table->integer('owner_id')->unsigned();
            $table->foreign('owner_id')->references('id')->on('users');

            //type foreign key
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('apartment_types');

            //country foreign key
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('country');

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
