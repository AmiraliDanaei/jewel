<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category; 

class CategorySeeder extends Seeder
{
    
    public function run(): void
    {
        $categories = [
            ['name' => 'Shirts'],
            ['name' => 'Jeans'],
            ['name' => 'Shoes'],
            ['name' => 'Jackets'],
            ['name' => 'Bags'],
            ['name' => 'Accessories'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
