
<?php

class UsersSeeder extends DatabaseSeeder
{

    public function run()
    {
        //basic users
        $users = [
            [
                "name" => "Admin",
                "surname" => "Admin",
                "username"    => "admin",
                "password"    => Hash::make("admin"),
                "phone"    => "000000",
                "avatar"    => "https://success.salesforce.com/resource/1414972800000/sharedlayout/img/new-user-image-default.png",
                "activated"    => "0",
                "role_id"    => "1",
                "activation_token"    => Hash::make("admin")
            ],
            [
                "name" => "Owner",
                "surname" => "Owner",
                "username"    => "owner",
                "password"    => Hash::make("owner"),
                "phone"    => "000000",
                "avatar"    => "https://success.salesforce.com/resource/1414972800000/sharedlayout/img/new-user-image-default.png",
                "activated"    => "0",
                "role_id"    => "2",
                "activation_token"    => Hash::make("owner")
            ],
            [
                "name" => "User",
                "surname" => "User",
                "username"    => "user",
                "password"    => Hash::make("user123"),
                "phone"    => "000000",
                "avatar"    => "https://success.salesforce.com/resource/1414972800000/sharedlayout/img/new-user-image-default.png",
                "activated"    => "0",
                "role_id"    => "3",
                "activation_token"    => Hash::make("user")
            ]
        ];
        foreach ($users as $user)
        {
            User::create($user);
        }

        //all other users
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 100; $i++)
        {
                User::create(array(
                "name" => $faker->firstName($gender ='male'|'female'),
                "surname" => $faker-> lastname,
                "username"    => $faker->userName,
                "password"    => Hash::make("user123"),
                "phone"    => $faker->phoneNumber,
                "email"    => $faker->email,
                "avatar"    => "http://i-cdn.phonearena.com/images/article/26035-image/Woohoo-Verizon-4G-LTE-is-coming-to-5-new-markets-and-expanding-in-others-starting-tomorrow.jpg",
                "activated"    => "0",
                "role_id"    => "3",
                "activation_token"    => Hash::make("user")
            ));
        }
    }

}
