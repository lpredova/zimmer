<?php

class BookingsSeeder extends DatabaseSeeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 40; $i++)
        {
            Booking::create(array(
                "room_id"    => $faker->numberBetween($min = 1, $max = 40 ),
                "apartment_id"    => $faker->numberBetween($min = 1, $max = 20),

                "booking_start" => $faker-> unixTime($max = 'now'),
                "booking_end" => $faker-> unixTime($max = 'now'),
                "notice" => $faker-> text(100),
            ));
        }
    }

}
