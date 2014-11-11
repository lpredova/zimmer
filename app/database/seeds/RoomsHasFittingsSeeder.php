<?php

class RoomsHasFittingsSeeder extends DatabaseSeeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 40; $i++)
        {
            RoomHasFitting::create(array(
                "room_id"    => $faker->numberBetween($min = 1, $max = 40 ),
                "fitting_id"    => $faker->numberBetween($min = 1, $max = 40),
            ));
        }
    }

}
