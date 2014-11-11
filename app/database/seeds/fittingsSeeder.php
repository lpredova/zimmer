<?php

class FittingsSeeder extends DatabaseSeeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 40; $i++)
        {
            Fitting::create(array(

                "name" => $faker->text(5),
                "description" => $faker->text(400),
                "icon"    => $faker->imageUrl($width = 10, $height = 10),
            ));
        }
    }

}
