<?php

class RoomsSeeder extends DatabaseSeeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 400; $i++)
        {
            Room::create(array(
                "description" => $faker->numberBetween($min = 1, $max = 4),
                "name" => $faker->firstName($gender = 'male'|'female'),
                "capacity" => $faker->numberBetween($min = 1, $max = 10),
                "stars"    => 0,

                "description" => $faker->text(400),
                "price"    => $faker->numberBetween($min = 1, $max = 90),
                "apartment_id"    => $faker->numberBetween($min = 1, $max = 20),
            ));
        }
    }

}
