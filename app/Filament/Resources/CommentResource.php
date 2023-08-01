<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Comment;
use Filament\Resources\Form;
use App\Models\SupportTicket;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use App\Filament\Resources\CommentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CommentResource\RelationManagers;
use App\Filament\Resources\CommentResource\RelationManagers\SupportTicketRelationManager;
use App\Filament\Resources\CommentResource\RelationManagers\SupportTicketsRelationManager;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;
    protected static ?string $recordTitleAttribute = 'body';

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('body')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\TextInput::make('image')
                    ->maxLength(255),
                BelongsToSelect::make('user_id')
                    ->relationship('user', 'name')->required(),
                    BelongsToSelect::make('support_ticket_id')
                    ->relationship('support_ticket', 'question')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('body'),
                Tables\Columns\TextColumn::make('image'),
                Tables\Columns\TextColumn::make('user_id'),
                Tables\Columns\TextColumn::make('support_ticket_id'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()->since(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()->since(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            SupportTicketRelationManager::class

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComments::route('/'),
        ];
    }
}
