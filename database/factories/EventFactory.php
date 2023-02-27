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
    public function definition()
    {
        return [
            "type" => $this->faker->randomElement(["team", "person"]),
            "event_name" => $this->faker->name(),
            "event_start" => now()->addDays($this->faker->randomDigit()),
            "event_end" => now()->addDays($this->faker->randomDigit())
        ];
    }
}
