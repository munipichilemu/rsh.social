<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Atencion>
 */
class AtencionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rut' => fake()->text(50),
            'names' => fake()->text(50),
            'lastname_1' => fake()->text(50),
            'lastname_2' => fake()->text(50),
            'phone' => fake()->randomNumber(),
            'nationality' => fake()->text(50),

        ];
    }
}
