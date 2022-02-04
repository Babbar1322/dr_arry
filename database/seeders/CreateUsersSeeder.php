<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'is_admin' => '1',
                'password' => bcrypt('admin'),
            ],
            [
                'name' => 'Branch',
                'email' => 'branch@gmail.com',
                'is_admin' => '2',
                'password' => bcrypt('admin'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}