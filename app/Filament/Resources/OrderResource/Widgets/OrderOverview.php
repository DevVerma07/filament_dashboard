<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Post;
use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\Widget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class OrderOverview extends BaseWidget
{
    // protected static string $view = 'filament.resources.order-resource.widgets.order-overview';

    protected function getCards(): array
    {
        return [
            Card::make('All Orders', Order::all()->count()),
            Card::make('All Products', Product::all()->count()),
        ];
    }
}
