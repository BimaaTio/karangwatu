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
        User::create([
            'name' => 'sa',
            'email' => 'sa@gmail.com',
            'roles' => 'admin',
            'password' => bcrypt('123'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'roles' => 'admin',
            'password' => bcrypt('12345'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'roles' => 'user',
            'password' => bcrypt('12345'),
            'email_verified_at' => now()
        ]);
    }
}
