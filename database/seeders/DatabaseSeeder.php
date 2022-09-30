<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "password" => Hash::make('password')
        ]);
        \App\Models\User::factory()->count(5)->create();
        \App\Models\Category::factory()->count(20)->create();
        \App\Models\Article::factory()->count(50)->create();
    }
}
