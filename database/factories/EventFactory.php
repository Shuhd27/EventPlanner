<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3, true), // Generates a title with 3 words
            'description' => $this->faker->paragraph(), // Generates a random paragraph for description
            'date' => $this->faker->dateTimeBetween('now', '+1 year'), // Generates a date between now and one year from now
            'location' => $this->faker->city(), // Generates a random city name for location
        ];
    }
}
