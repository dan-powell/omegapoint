<?php

namespace App\Providers;

use App\Composers\News\ArticleComposer;
use App\Composers\News\ClockComposer;
use App\Composers\News\WeatherComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class NewsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
       //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(
            ['news.components.marquee'],
            ArticleComposer::class
        );

        View::composer(
            ['news.components.clock'],
            ClockComposer::class
        );

        View::composer(
            ['news.components.weather'],
            WeatherComposer::class
        );
    }
}
