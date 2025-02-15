<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\School>
 */
class SchoolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company . ' School',
            'email' => $this->faker->unique()->safeEmail,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'photo' => $this->faker->imageUrl(640, 480, 'school', true, 'school'),
        ];
    }
}
