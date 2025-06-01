<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'Technology', 'slug' => 'technology']);
        Category::create(['name' => 'Business', 'slug' => 'business']);
        Category::create(['name' => 'World News', 'slug' => 'world-news']);
        Category::create(['name' => 'Science', 'slug' => 'science']);
    }
}