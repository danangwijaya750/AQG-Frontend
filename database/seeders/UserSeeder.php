<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
                'instance' => 'admin',
                'profession' => 'admin',
                'role_id' => 1,
            ],
            [
                'name' => 'user',
                'email' => 'user@user.com',
                'password' => bcrypt('password'),
                'instance' => 'user',
                'profession' => 'user',
                'role_id' => 2,
            ]

        ];

        foreach($users as $user){
            User::create($user);
        }



    }
}
