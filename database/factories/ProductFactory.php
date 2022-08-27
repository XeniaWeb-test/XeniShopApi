<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realTextBetween(10,30),
            'price' => $this->faker->numberBetween(20,65200),
            'description' => $this->faker->realText(250),
            'category_id' => Category::factory(),
            'image' => 'https://picsum.photos/id/' . random_int(1000,1100) .'/300/250',
            'comment' => $this->faker->text(200),
        ];
    }
}
