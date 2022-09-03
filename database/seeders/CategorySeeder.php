<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()
            ->count(3)
            ->hasProducts(12)
            ->create();

        Category::factory()
            ->count(2)
            ->hasProducts(8)
            ->create();

        Category::factory()
            ->count(8)
            ->hasProducts(15)
            ->create();
    }
}
