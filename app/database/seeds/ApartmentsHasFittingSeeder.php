<?php

class ApartmentsHasFittingSeeder extends DatabaseSeeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 40; $i++)
        {
            ApartmentHasFitting::create(array(
                "apartment_id"    => $faker->numberBetween($min = 1, $max = 20 ),
                "fitting_id"    => $faker->numberBetween($min = 1, $max = 40),
            ));
        }
    }

}
