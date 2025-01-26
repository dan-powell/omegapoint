<?php

namespace App\Filament\Resources\Area\PointOfInterestResource\Pages;

use App\Filament\Resources\Area\PointOfInterestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPointOfInterest extends EditRecord
{
    protected static string $resource = PointOfInterestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
