
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
                "name" => $faker->name,
                "surname" => $faker->lastname,
                "username"    => $faker->userName,
                "password"    => Hash::make("user123"),
                "phone"    => $faker->phoneNumber,
                "email"    => $faker->email,
                "avatar"    => $faker->imageUrl($width = 200, $height = 200),
                "activated"    => "0",
                "role_id"    => "3",
                "activation_token"    => Hash::make("user")
            ));
        }
    }

}
