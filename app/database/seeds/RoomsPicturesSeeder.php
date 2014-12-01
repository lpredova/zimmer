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
                //"url" => $faker->imageUrl($width = 200, $height = 200),
                "url" => "http://ext.homedepot.com/community/blog/wp-content/wpuploads/home_depot_blog_planning_for_room_makeover.jpg",
                "room_id"    => $faker->numberBetween($min = 1, $max = 40),
            ));
        }
    }

}
