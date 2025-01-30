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
            ->sequence(function (Sequence $sequence) {
                $start = Carbon::now()->addHours($sequence->index);
                return [
                    'start' => $start->toIso8601String(),
                    'end' => $start->addMinutes(59)->toIso8601String()
                ];
            })
            ->create();
    }
}
