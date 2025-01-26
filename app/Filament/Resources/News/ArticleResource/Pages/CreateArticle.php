<?php

namespace App\Filament\Resources\News\ArticleResource\Pages;

use App\Filament\Resources\News\ArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;
}
