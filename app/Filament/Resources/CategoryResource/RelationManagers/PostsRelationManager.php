<?php

namespace App\Filament\Resources\CategoryResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class PostsRelationManager extends RelationManager
{
    protected static string $relationship = 'posts';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                BelongsToSelect::make('category_id')
                    ->relationship('category', 'name')->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                SpatieMediaLibraryFileUpload::make('thumbnail')->collection('posts'),
                Forms\Components\Toggle::make('is_published')
                    ->required(),
                RichEditor::make('content'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->limit(50)->sortable()->searchable(),
                Tables\Columns\TextColumn::make('content')->limit(50)->sortable()->searchable(),
                Tables\Columns\IconColumn::make('is_published')->sortable()
                    ->boolean(),
            ])
            ->filters([
                Filter::make('published')
                    ->query(fn (Builder $query): Builder => $query->where('is_published', true)),
                Filter::make('Unpublished')
                    ->query(fn (Builder $query): Builder => $query->where('is_published', false)),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
