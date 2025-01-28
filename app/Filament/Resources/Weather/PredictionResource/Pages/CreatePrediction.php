<?php

namespace App\Filament\Resources\Weather\PredictionResource\Pages;

use App\Filament\Resources\Weather\PredictionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePrediction extends CreateRecord
{
    protected static string $resource = PredictionResource::class;
}
