<?php

namespace App\Composers\News;

use Illuminate\View\View;
use App\Models\Weather\Prediction;

class WeatherComposer
{

    /**
     * Bind data to the view.
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('predictions', Prediction::orderBy('start')->limit(6)->get());
    }
}
