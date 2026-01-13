<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProcurementFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'supplier' => fake()->word(),
            'description' => fake()->text(),
            'total_amount' => fake()->randomFloat(2, 0, 99999999.99),
            'status' => fake()->word(),
        ];
    }
}
