<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Post;
use App\Models\Tag;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
class BlogPostsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('All Posts', Post::all()->count()),
            Card::make('All Categories',Category::all()->count()),
            Card::make('All Custormers', Customer::all()->count()),
            Card::make('All Tags', Tag::all()->count()),
        ];
    }
}
