<?php 

namespace App\Composers;

use Illuminate\View\View;
use App\Models\News\Article;

class NewsHeaderComposer
{

    /**
     * Bind data to the view.
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('ticker', Article::orderBy('date')->limit(6)->get(['id', 'title'])->shuffle());
    }
}
