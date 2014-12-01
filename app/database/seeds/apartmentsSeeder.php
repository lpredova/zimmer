
<?php

class ApartmentsSeeder extends DatabaseSeeder
{

    public function run()
    {

        //all other users
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 20; $i++)
        {
            Apartment::create(array(
                "owner_id" => $faker->numberBetween($min = 2, $max = 99),
                "type_id" => $faker->numberBetween($min = 1, $max = 4),
                "city_id" => 1,
                "name" => $faker->firstName($gender = 'male'|'female'),
                "description" => $faker->text(400),
                "capacity"    => $faker->numberBetween($min = 1, $max = 10),
                "stars"    => 0,
                "address"    => $faker->address,
                "email"    => $faker->email,
                "phone"    => $faker->phoneNumber,
                "phone_2"    => $faker->phoneNumber,
                "rating"    => $faker->numberBetween($min = 0, $max = 5),
                "lat"    => $faker->randomFloat($nbMaxDecimals = NULL, $min = 46.2, $max = 46.5) ,
                "lng"    => $faker->randomFloat($nbMaxDecimals = NULL, $min = 16.0, $max = 16.5) ,
                "price"    => $faker->randomFloat($nbMaxDecimals = 2, $min = 10.0, $max = 90.0) ,
                "cover_photo" => "http://www.crobooking.com/slike/objekti/140/profilna.jpg",
            ));
        }
    }

}
