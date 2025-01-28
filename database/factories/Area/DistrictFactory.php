<?php

namespace Database\Factories\Area;

use App\Enum\Area\Tier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Area\District>
 */
class DistrictFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(1), 
            'tier' => Tier::cases()[array_rand(Tier::cases(), 1)]->value
        ];
    }
}
