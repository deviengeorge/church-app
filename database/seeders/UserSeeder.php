<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            "name" => "Devien George",
            "email" => "devien@gmail.com",
            "password" => \Hash::make("devo"),
            "role" => UserRole::PRIEST,
        ]);

        \App\Models\User::create([
            "name" => "Ebram",
            "email" => "ebram@gmail.com",
            "password" => \Hash::make("ebram"),
            "role" => UserRole::PRIEST,
        ]);

        \App\Models\User::create([
            "name" => "Ibrahim",
            "email" => "ibrahim@gmail.com",
            "password" => \Hash::make("ibrahim"),
            "role" => UserRole::PRIEST,
        ]);

        \App\Models\User::create([
            "name" => "test1",
            "email" => "test1@gmail.com",
            "password" => \Hash::make("test"),
            "role" => UserRole::USER,
        ]);

        \App\Models\User::create([
            "name" => "test2",
            "email" => "test2@gmail.com",
            "password" => \Hash::make("test"),
            "role" => UserRole::USER,
        ]);
    }
}
