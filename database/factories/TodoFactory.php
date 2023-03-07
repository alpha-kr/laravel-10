<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(2)
        ];
    }

    /**
     * Indicate that the user is suspended.
     */
    public function completed(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'completed' => true,
            ];
        });
    }
}
