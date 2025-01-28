<?php

namespace App\Filament\Resources\Weather\PredictionResource\Pages;

use App\Filament\Resources\Weather\PredictionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPrediction extends EditRecord
{
    protected static string $resource = PredictionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
