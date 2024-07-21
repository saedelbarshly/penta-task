<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hierarchical\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $electronics = Category::create(['name' => 'Electronics']);
        $computers = Category::create(['name' => 'Computers', 'parent_id' => $electronics->id]);
        $laptops = Category::create(['name' => 'Laptops', 'parent_id' => $computers->id]);
        $desktops = Category::create(['name' => 'Desktops', 'parent_id' => $computers->id]);
        $smartphones = Category::create(['name' => 'Smartphones', 'parent_id' => $electronics->id]);
        $apple = Category::create(['name' => 'Apple', 'parent_id' => $smartphones->id]);
        $samsung = Category::create(['name' => 'Samsung', 'parent_id' => $smartphones->id]);
    }
}
