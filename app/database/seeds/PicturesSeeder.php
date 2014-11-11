<?php

class PicturesSeeder extends DatabaseSeeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 20; $i++)
        {
            Picture::create(array(
                "title" => $faker->text(5),
                "url" => $faker->imageUrl($width = 200, $height = 200),
                "apartment_id"    => $faker->numberBetween($min = 1, $max = 20),
            ));
        }
    }

}
