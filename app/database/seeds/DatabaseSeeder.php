<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('RolesSeeder');
		$this->call('UsersSeeder');
		$this->call('TypesSeeder');
		$this->call('CountriesSeeder');
		$this->call('CitiesSeeder');
		$this->call('ApartmentsSeeder');
		$this->call('PicturesSeeder');
		$this->call('UserRatingsSeeder');
		$this->call('UserFavoritesSeeder');
		$this->call('RoomsSeeder');
		$this->call('RoomsPicturesSeeder');
		$this->call('BookingsSeeder');
		$this->call('FittingsSeeder');
		$this->call('ApartmentsHasFittingSeeder');
		$this->call('RoomsHasFittingsSeeder');
	}

}
