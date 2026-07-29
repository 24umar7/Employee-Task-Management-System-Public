<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        $users = [
            [
                'username' => 'admin',
                'password' => '123',
                'role' => 'admin'

            ],
            [
                'username' => 'ali',
                'password' => '123',
                'role' => 'employee',
                'email'=> 'mumarshakoor.cs@gmail.com'
            ],
            [
                'username' => 'umar',
                'password' => '123',
                'role' => 'employee',
                'email'=>'umark32195@gmail.com'
            ]

        ];
        foreach($users as $user)
            {
                User::firstOrCreate($user);
            }
    }
}
