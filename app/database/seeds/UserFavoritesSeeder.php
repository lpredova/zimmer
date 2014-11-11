<?php

class UserFavoritesSeeder extends DatabaseSeeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 40; $i++)
        {
            UserFavorite::create(array(

                "apartment_id"    => $faker->numberBetween($min = 1, $max = 20),
                "user_id"    => $faker->numberBetween($min = 1, $max = 99),

                "title" => $faker->text(30),
                "description" => $faker->text(400),
            ));
        }
    }

}
