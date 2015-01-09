<?php

class UserRatingsSeeder extends DatabaseSeeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 40; $i++)
        {
            UserRating::create(array(

                "apartment_id"    => $faker->numberBetween($min = 1, $max = 20),
                "user_id"    => $faker->numberBetween($min = 1, $max = 99),
                "rating" => $faker->numberBetween($min = 1, $max = 5),
            ));
        }
    }

}
