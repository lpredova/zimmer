<?php

class RoomsPicturesSeeder extends DatabaseSeeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 80; $i++)
        {
            RoomPicture::create(array(

                "title" => $faker->text(30),
                "url" => $faker->imageUrl($width = 200, $height = 200),
                "room_id"    => $faker->numberBetween($min = 1, $max = 40),
            ));
        }
    }

}
