<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Violation>
 */
class ViolationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'teacher_id' => User::where('role', 'teacher')->inRandomOrder()->first()->id ?? 1,
            'datetime' => $this->faker->dateTimeThisYear,
            'description' => $this->faker->sentence,
            'photo' => $this->faker->imageUrl(640, 480, 'violation', true, 'violation'),
        ];
    }
}
