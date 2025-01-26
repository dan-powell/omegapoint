<?php

namespace App\Filament\Resources\Area;

use App\Filament\Resources\Area\PointOfInterestResource\Pages;
use App\Filament\Resources\Area\PointOfInterestResource\RelationManagers;
use App\Filament\Resources\Area\PointOfInterestResource\RelationManagers\DistrictsRelationManager;
use App\Models\Area\PointOfInterest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PointOfInterestResource extends Resource
{
    protected static ?string $model = PointOfInterest::class;

    protected static ?string $navigationGroup = 'Areas';

    protected static ?string $pluralModelLabel = 'Points of Interest';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            DistrictsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPointOfInterests::route('/'),
            'create' => Pages\CreatePointOfInterest::route('/create'),
            'edit' => Pages\EditPointOfInterest::route('/{record}/edit'),
        ];
    }
}
