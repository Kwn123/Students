<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code'=>fake()->text($maxNbChars = 20),
            'name'=>fake()->text($maxNbChars = 10),
            'quantity'=>fake()->randomNumber(5,false),
            'price'=>fake()->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
            'description'=>fake()->text($maxNbChars = 100)
        ];
    }
}
