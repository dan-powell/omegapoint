<?php

namespace App\Providers;

use App\Composers\News\WeatherComposer;
use App\Composers\NewsHeaderComposer;
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
            ['news.components.header'],
            NewsHeaderComposer::class
        );

        View::composer(
            ['news.components.weather'],
            WeatherComposer::class
        );
    }
}
