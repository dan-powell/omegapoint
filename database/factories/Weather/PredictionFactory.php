<?php

namespace Database\Factories\Weather;

use App\Enum\Weather\Type;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Weather\Prediction>
 */
class PredictionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-1 year', '+2 years');

        $temperature_min = fake()->numberBetween(-50, 50);
        $windspeed_min = fake()->numberBetween(0, 80);
        $radiation_min = fake()->numberBetween(0, 3000);
        $pressure_min = fake()->numberBetween(0, 30);
        $humidity_min = fake()->numberBetween(0, 100);
        $precipitation_min = fake()->numberBetween(0, 95);

        return [
            'start' => $start,
            'end' => Carbon::parse($start)->addHour()->toIso8601String(),
            'type' => Type::cases()[array_rand(Type::cases(), 1)]->value,
            'temperature_min' => $temperature_min,
            'temperature_max' => $temperature_min + rand(0, 30),
            'windspeed_min' => $windspeed_min,
            'windspeed_max' => $windspeed_min  + rand(0, 30),
            'radiation_min' => $radiation_min,
            'radiation_max' => $radiation_min  + rand(0, 30),
            'pressure_min' => $pressure_min,
            'pressure_max' => $pressure_min  + rand(0, 30),
            'humidity_min' => $humidity_min,
            'humidity_max' => $humidity_min  + rand(0, 30),
            'precipitation_min' => $precipitation_min,
            'precipitation_max' => $precipitation_min  + rand(0, 30),
        ];
    }

    public function start(?DateTime $start = null): Factory
    {
        //
        if(!$start) {
            $start = now();
        }
        //
        return $this->state(function (array $attributes) use ($start) {
            return [
                'start' => $start,
                'end' => Carbon::parse($start)->addHour()->toIso8601String(),
            ];
        });
    }
}
