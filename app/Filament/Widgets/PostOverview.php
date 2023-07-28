<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Post;
use App\Models\Tag;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class PostOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $notPublishedCount = Post::where('is_published', 0)->count();
        $PublishedCount = Post::where('is_published', 1)->count();
        return [
            Card::make('Published Posts', $PublishedCount)
                ->description('32k increase')
                ->descriptionIcon('heroicon-s-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Card::make('Not Published Posts', $notPublishedCount)
                ->description('1% decrease')
                ->descriptionIcon('heroicon-s-trending-down')
                ->chart([1,2,4,5,1])
                ->color('danger'),
            // ...
        ];
    }
}
