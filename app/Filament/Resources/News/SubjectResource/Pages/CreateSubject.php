<?php

namespace App\Filament\Resources\News\SubjectResource\Pages;

use App\Filament\Resources\News\SubjectResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSubject extends CreateRecord
{
    protected static string $resource = SubjectResource::class;
}
