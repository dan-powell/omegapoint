<?php

namespace Database\Seeders;

use App\Models\Area\District;
use App\Models\Area\PointOfInterest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = District::factory()
            ->count(10)
            ->create();

        PointOfInterest::factory()
            ->count(10)
            ->create();


        foreach($districts as $district) {
            $district->pointsOfInterest()->attach(
                PointOfInterest::inRandomOrder()->limit(2)->get()
            );
        }
        
        
    }
}
