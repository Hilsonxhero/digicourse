<?php

namespace User\database\seeders;

use Illuminate\Database\Seeder;
use User\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::$defaultUsers as $user) {
            User::firstOrCreate(
                [
                    'email' => $user['email']
                ]
                , [
                'name' => $user['name'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                'password' => bcrypt($user['password']),
            ])->assignRole($user['role'])->markEmailAsVerified();
        }

    }
}
