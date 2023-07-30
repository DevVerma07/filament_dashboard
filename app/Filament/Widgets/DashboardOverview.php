<?php

namespace App\Filament\Widgets;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\SupportTicket;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class BlogPostsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $notPublishedCount = Post::where('is_published', 0)->count();
        $PublishedCount = Post::where('is_published', 1)->count();
        return [
            Card::make('All Posts', Post::all()->count()),
            Card::make('All Categories', Category::all()->count()),
            Card::make('All Custormers', Customer::all()->count()),
            Card::make('All Tags', Tag::all()->count()),
            Card::make('All Comments', Comment::all()->count()),
            Card::make('All Orders', Order::all()->count()),
            Card::make('All Products', Product::all()->count()),
            Card::make('All Support Tickets', SupportTicket::all()->count()),
            Card::make('Published Posts', $PublishedCount)
                ->description('32k increase')
                ->descriptionIcon('heroicon-s-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Card::make('Not Published Posts', $notPublishedCount)
                ->description('1% decrease')
                ->descriptionIcon('heroicon-s-trending-down')
                ->chart([1, 2, 4, 5, 1])
                ->color('danger'),
        ];
    }
}
