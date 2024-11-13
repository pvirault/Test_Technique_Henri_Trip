<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('superadminpassword'),
            'role' => 'admin',
            'api_key' => Str::random(60),
        ]);

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('adminpassword'),
            'role' => 'admin',
            'api_key' => Str::random(60),
        ]);

        User::create([
            'name' => 'Normal User 1',
            'email' => 'user1@example.com',
            'password' => Hash::make('userpassword1'),
            'role' => 'user',
            'api_key' => Str::random(60),
        ]);

        User::create([
            'name' => 'Normal User 2',
            'email' => 'user2@example.com',
            'password' => Hash::make('userpassword2'),
            'role' => 'user',
            'api_key' => Str::random(60),
        ]);

        User::create([
            'name' => 'Normal User 3',
            'email' => 'user3@example.com',
            'password' => Hash::make('userpassword3'),
            'role' => 'user',
            'api_key' => Str::random(60),
        ]);
    }
}
