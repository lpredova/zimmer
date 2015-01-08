
<?php

class ApartmentsSeeder extends DatabaseSeeder
{

    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 1000; $i++)
        {
            Apartment::create(array(
                "owner_id" => $faker->numberBetween($min = 2, $max = 99),
                "type_id" => $faker->numberBetween($min = 1, $max = 4),
                "city_id" =>  $faker->numberBetween($min = 1, $max = 7),
                "name" => $faker->firstName($gender = 'male'|'female'),
                "description" => $faker->text(400),
                "capacity"    => $faker->numberBetween($min = 1, $max = 10),
                "stars"    => 0,
                "address"    => $faker->address,
                "email"    => $faker->email,
                "phone"    => $faker->phoneNumber,
                "phone_2"    => $faker->phoneNumber,
                "rating"    => $faker->numberBetween($min = 0, $max = 5),
                "lat"    => $faker->randomFloat($nbMaxDecimals = 6, $min = 42.25, $max = 46.60) ,
                "lng"    => $faker->randomFloat($nbMaxDecimals = 6, $min = 13.56, $max = 19.38) ,
                "price"    => $faker->numberBetween($min = 10, $max = 120),
                "special"    => $faker->boolean($chanceOfGettingTrue = 10),
                "active"    => $faker->boolean($chanceOfGettingTrue = 98),
                "cover_photo" => "http://www.crobooking.com/slike/objekti/140/profilna.jpg",
            ));
        }
    }
}

