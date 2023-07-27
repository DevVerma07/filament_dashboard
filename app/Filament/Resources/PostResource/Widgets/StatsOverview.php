<?php

namespace App\Filament\Resources\PostResource\Widgets;

use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    // protected static ?string $pollingInterval = '10s';
    protected function getCards(): array
    {
        $notPublishedCount = Post::where('is_published', 0)->count();
        $PublishedCount = Post::where('is_published', 1)->count();
        return [
            Card::make('All Posts', Post::all()->count()),
            Card::make('Published', $PublishedCount),
            Card::make('Not Published', $notPublishedCount),
        ];
    }
}
