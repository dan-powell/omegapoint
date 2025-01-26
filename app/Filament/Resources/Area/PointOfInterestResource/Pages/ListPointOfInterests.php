<?php

namespace App\Filament\Resources\Area\PointOfInterestResource\Pages;

use App\Filament\Resources\Area\PointOfInterestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPointOfInterests extends ListRecords
{
    protected static string $resource = PointOfInterestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
