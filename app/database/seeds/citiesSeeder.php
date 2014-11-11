
<?php

class CitiesSeeder extends DatabaseSeeder
{

    public function run()
    {
        //basic users
        $cities = [
            [
                "name" => "Varaždin",
                "lat" => 46.305746,
                "lng" => 16.336607,
                "country_id" => "1",
            ],
            [
                "name" => "Zagreb",
                "lat" => 45.815011,
                "lng" => 15.981919,
                "country_id" => "1",
            ],
            [
                "name" => "Zadar",
                "lat" => 44.119371,
                "lng" => 15.231365,
                "country_id" => "1",
            ],
            [
                "name" => "Split",
                "lat" => 43.508132,
                "lng" => 16.440193,
                "country_id" => "1",
            ],
            [
                "name" => "Rijeka",
                "lat" => 45.327063,
                "lng" => 14.442176,
                "country_id" => "1",
            ],
            [
                "name" => "Pula",
                "lat" => 44.866623,
                "lng" => 13.849579,
                "country_id" => "1",
            ],
            [
                "name" => "Osijek",
                "lat" => 45.554962,
                "lng" => 18.695514,
                "country_id" => "1",
            ],
        ];
        foreach ($cities as $city)
        {
            City::create($city);
        }

    }

}
