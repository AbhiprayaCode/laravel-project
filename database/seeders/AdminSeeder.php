<?php

namespace Database\Seeders;

use App\Models\menus;
use App\Models\products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $user_data = [[
        //     "name"=> "Admin",
        //     "email"=> "admin@gmail.com",
        //     "email_verified_at"=> "2024-04-27 21:57:48",
        //     "role"=> "admin",
        //     "password"=> bcrypt("12345678"),
        // ], [
        //     "name"=> "Alif Abhipraya",
        //     "email"=> "alifelangabhipraya@gmail.com",
        //     "email_verified_at"=> "2024-04-27 21:57:48",
        //     "role"=> "customer",
        //     "password"=> bcrypt("12345678"),
        // ]];

        // foreach ($user_data as $user) {
        //     User::create($user);
        // }

        $user_data = [[
            "name"=> "Rafif",
            "email"=> "rafief@gmail.com",
            "email_verified_at"=> "2024-04-27 21:57:48",
            "role"=>"customer",
            "password"=> bcrypt("12345678"),
        ]];
        // User::create($user_data);
        foreach ($user_data as $user) {
                User::create($user);
            }

        // $menu_data = [[
        //     "name" => "Cappucino",
        //     "base" => "Arabica",
        //     "price"=> "12000",
        // ], [
        //     "name" => "Americano",
        //     "base" => "Robusta",
        //     "price"=> "10000",
        // ]];
        // foreach ($menu_data as $menu) {
        //     products::create($menu);
        // }
    }
}
