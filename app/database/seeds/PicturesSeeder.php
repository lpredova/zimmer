<?php

class PicturesSeeder extends DatabaseSeeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 10000; $i++)
        {
            Picture::create(array(
                "title" => $faker->text(5),
                "url" => $faker->randomElement($array = array(
                    'http://www.hoteligieapalermo.com/images/luxury-room-1.jpg',
                    'https://d1p98clqffzjxh.cloudfront.net/amphitryon-slrsv/L27328.jpg',
                    'http://www.iseecubed.com/wp-content/uploads/innovative-porto-luxury-room.jpg',
                    'http://homecreate.info/wp-content/uploads/2011/04/mood-luxury-modern-living-room.jpg',
                    'http://www.luxurytraveladvisor.com/files/luxurytraveladvisor/nodes/2013/10276/pg24_1_3.jpg',
                    'http://cdn.freshome.com/wp-content/uploads/2011/01/RussianHillHigh-Rise-11.jpg',
                    'http://www.prestige-mls.com/blog/wp-content/uploads/2013/02/Luxury-Apartment-Tuscany-Italy.jpg',
                )),
                "apartment_id"    => $faker->numberBetween($min = 1, $max = 999),
            ));
        }
    }

}
