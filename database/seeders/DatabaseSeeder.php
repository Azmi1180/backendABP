<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            CategorySeeder::class,
            ArticleSeeder::class,
            // You can create a UserSeeder too if you want predefined users
        ]);
    }
}