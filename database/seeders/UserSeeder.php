<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin 1',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123123123'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'User 1',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123123123'),
            'role' => 'user'
        ]);

        User::create([
            'name' => 'Nadheva',
            'email' => 'nadheva17@gmail.com',
            'password' => bcrypt('user'),
            'role' => 'user'
        ]);

        User::create([
            'name' => 'Resepsionis',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 'admin'
        ]);
    }
}
