
<?php

class TypesSeeder extends DatabaseSeeder
{

    public function run()
    {
        //basic users
        $users = [
            [
                "name" => "Hotel",
            ],
            [
                "name" => "Motel",
            ],
            [
                "name" => "Pansion",
            ],
            [
                "name" => "Apartment",
            ],
            [
                "name" => "room",
            ]
        ];
        foreach ($users as $user)
        {
            ApartmentType::create($user);
        }

    }

}
