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
        $images = [1000,100,1002,1003,101,1011,1015,1016,1020,1025,1024,1026,1032,1036,1040,1043,1044,1051,1056,1057,106,1062,127,13,167,168,179,182,189,191,206,213,215,216,218,225,231,233,244,25,251,256,259,268,275];
        $randIndex = rand(0, count($images)-1);
        return [
            'title' => $this->faker->realTextBetween(10,30),
            'price' => $this->faker->numberBetween(20,1200),
            'description' => $this->faker->realText(250),
            'category_id' => Category::factory(),
            'image' => 'https://picsum.photos/id/' . $images[$randIndex] .'/300/250',
            'comment' => $this->faker->text(200),
        ];
    }
}
