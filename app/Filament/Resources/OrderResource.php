<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Order;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\FormsComponent;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use App\Filament\Resources\OrderResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\ProductResource\RelationManagers\OrderRelationManager;
use App\Filament\Resources\OrderResource\RelationManagers\ProductsRelationManager;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $recordTitleAttribute = 'customer_name';

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(heading: 'Customer Info')->schema([
                    Forms\Components\TextInput::make('customer_name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('customer_email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                ])->columns(2),
                Forms\Components\Section::make(heading: 'Products')->schema([
                    Repeater::make('Products')
                        ->schema([
                            BelongsToSelect::make('products_id')
                                ->relationship('products', 'name')->required(),
                            TextInput::make('quantity')->required(),
                        ])
                        ->columns(2),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer_name'),
                Tables\Columns\TextColumn::make('customer_email'),
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
            ProductsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'name' => $record->customer_name,
            'email' => $record->customer_email,
        ];
    }
}
