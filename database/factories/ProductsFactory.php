<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->word,
            "color" => $this->faker->colorName,
            "price" => $this->faker->randomFloat(3,1,230),
            "category" => $this->faker->word
        ];
    }
}
