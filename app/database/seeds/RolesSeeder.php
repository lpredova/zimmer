
<?php

class RolesSeeder extends DatabaseSeeder
{

    public function run()
    {
        $roles = [
            [
                "name" => "admin",
            ],
            [
                "name" => "owner",
            ],
            [
                "name" => "user",
            ]
        ];

        foreach ($roles as $role)
        {
            Role::create($role);
        }
    }

}
