<?php

class PicturesSeeder extends DatabaseSeeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 200; $i++)
        {
            Picture::create(array(
                "title" => $faker->text(5),
                //"url" => $faker->imageUrl($width = 200, $height = 200),
                "url" => "http://www.crobooking.com/slike/objekti/140/profilna.jpg",
                "apartment_id"    => $faker->numberBetween($min = 1, $max = 20),
            ));
        }
    }

}
