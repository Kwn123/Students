<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'name' => fake()->name(),
                'last_name'=> fake()->lastName(),
                'dni'=>fake()->randomNumber(8,false),
                'birthday'=>fake()->date(),
                'group'=>fake()->randomElement(['A','B'])
        ];
    }
}
