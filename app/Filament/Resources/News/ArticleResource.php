<?php

namespace App\Filament\Resources\News;

use App\Filament\Resources\News\ArticleResource\Pages;
use App\Filament\Resources\News\ArticleResource\RelationManagers;
use App\Filament\Resources\News\ArticleResource\RelationManagers\DistrictsRelationManager;
use App\Filament\Resources\News\ArticleResource\RelationManagers\SubjectsRelationManager;
use App\Models\News\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Builder as FormBuilder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationGroup = 'News';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->default(fn(): string => strtolower(Str::ulid()))
                    ->readonly()
                    ->disabled()
                    ->required(),
                Forms\Components\DateTimePicker::make('date')
                    ->default(now())
                    ->required(),
                Forms\Components\DateTimePicker::make('published_date'),
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\TextInput::make('short'),
                Forms\Components\TextInput::make('summary'),
                Forms\Components\FileUpload::make('thumbnail')
                    ->disk('news')
                    ->directory(fn(Get $get) => $get('id'). '/thumbnail')
                    ->image()
                    ->imageEditor()
                    ->nullable(),
                Forms\Components\FileUpload::make('lead')
                    ->multiple()
                    ->disk('news')
                    ->directory(fn(Get $get) => $get('id') . '/lead')
                    ->image()
                    ->imageEditor()
                    ->nullable(),
                Forms\Components\Textarea::make('introduction')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('tldr')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('meta_title'),
                Forms\Components\TextInput::make('meta_description'),

                FormBuilder::make('sections')
                    ->columnSpanFull()
                    ->blocks([
                        Block::make('section')
                            ->schema([
                                MarkdownEditor::make('content'),
                                FileUpload::make('media')
                                    ->disk('news')
                                    ->directory(fn(Get $get) => $get('id') . '/sections')
                                    ->multiple()
                                    ->image()
                                    ->imageEditor(),
                            ])
                            ->columns(2),
                    ]),

                FormBuilder::make('updates')
                    ->columnSpanFull()
                    ->blocks([
                        Block::make('update')
                            ->schema([
                                Forms\Components\DateTimePicker::make('date')
                                    ->default(now())
                                    ->required(),
                                MarkdownEditor::make('content'),
                                FileUpload::make('media')
                                    ->disk('news')
                                    ->directory(fn(Get $get) => $get('id') . '/updates')
                                    ->image()
                                    ->imageEditor(),
                            ])
                            ->columns(2),
                    ]),

               
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->description(fn (Article $record): string => $record->short)
                    ->searchable(),
                Tables\Columns\TextColumn::make('short')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\ImageColumn::make('lead'),
                Tables\Columns\TextColumn::make('date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_date')
                    ->dateTime()
                    ->sortable(),
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
            ])
            ->defaultSort('date', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            SubjectsRelationManager::class,
            DistrictsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                'published'
            ]);
    }
}
