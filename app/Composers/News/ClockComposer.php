<?php 

namespace App\Composers\News;

use Carbon\Carbon;
use Illuminate\View\View;

class ClockComposer
{

    /**
     * Bind data to the view.
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->with([
            'time' => Carbon::now()->addYears(3000),
            'stars' => [
                [
                    'rise' => Carbon::now(),
                    'set' => Carbon::now()
                ]
            ], 
            'moons' => [
                [
                    'phase' => 'waxing'
                ], 
                [
                    'phase' => 'half'
                ]
            ]
        ]);
    }
}
