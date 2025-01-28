<?php

namespace App\Filament\Resources\Weather;

use App\Filament\Resources\Weather\PredictionResource\Pages;
use App\Models\Weather\Prediction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PredictionResource extends Resource
{
    protected static ?string $model = Prediction::class;

    protected static ?string $navigationGroup = 'Weather';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('start')
                    ->required(),
                Forms\Components\DateTimePicker::make('end')
                    ->required(),
                Forms\Components\TextInput::make('type')
                    ->required(),
                Forms\Components\TextInput::make('temperature_min')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('temperature_max')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('windspeed_min')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('windspeed_max')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('radiation_min')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('radiation_max')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('pressure_min')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('pressure_max')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('humidity_min')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('humidity_max')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('start')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('temperature_min')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('temperature_max')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('windspeed_min')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('windspeed_max')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('radiation_min')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('radiation_max')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pressure_min')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pressure_max')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('humidity_min')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('humidity_max')
                    ->numeric()
                    ->sortable(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPredictions::route('/'),
            'create' => Pages\CreatePrediction::route('/create'),
            'edit' => Pages\EditPrediction::route('/{record}/edit'),
        ];
    }
}
