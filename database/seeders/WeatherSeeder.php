<?php

namespace Database\Seeders;

use App\Models\Weather\Prediction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prediction::factory()
            ->count(20)
            ->sequence(fn (Sequence $sequence) => [
                'start' => Carbon::now()->addHours($sequence->index)->toIso8601String(),
                'end' => Carbon::now()->addHours($sequence->index + 1)->toIso8601String()
                ])
            ->create();
    }
}
