
<?php

class CountriesSeeder extends DatabaseSeeder
{

    public function run()
    {
        //basic users
        $countries = [
            [
                "name" => "Croatia",
            ],
            [
                "name" => "Serbia",
            ],
            [
                "name" => "Bosnia and Herzegovina",
            ],
            [
                "name" => "Slovenia",
            ],
            [
                "name" => "Montenegro",
            ]
        ];
        foreach ($countries as $country)
        {
            Country::create($country);
        }

    }

}
