
<?php

class UsersSeeder extends DatabaseSeeder
{

    public function run()
    {
        //we have to make some improvements
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
                "password"    => Hash::make("user"),
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
    }

}
