<?php

namespace Database\Seeders;

use App\Models\Weather\Prediction;
use Illuminate\Database\Seeder;

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Prediction::factory()
            ->count(10)
            ->create();
    }
}
