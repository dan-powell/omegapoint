<?php

namespace App\Filament\Resources\News\ArticleResource\Pages;

use App\Filament\Resources\News\ArticleResource;
use App\Models\News\Article;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Pages\EditRecord;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            Action::make('publish')
                ->label('Publish')
                ->action(function (Article $record): void {
                    $record->published_date = now();
                    $record->save();
                    $this->refreshFormData([
                        'published_date'
                    ]);
                })
                ->disabled(fn(Article $record): bool => $record->published_date ? true : false)
                ->color('success')
                ->icon('heroicon-o-eye'),
            Action::make('hide')
                ->label('Hide')
                ->action(function (Article $record): void {
                    $record->published_date = null;
                    $record->save();
                    $this->refreshFormData([
                        'published_date'
                    ]);
                })
                ->disabled(fn(Article $record): bool => !$record->published_date ? true : false)
                ->color('warning')
                ->icon('heroicon-o-eye-slash')
        ];
    }
}
