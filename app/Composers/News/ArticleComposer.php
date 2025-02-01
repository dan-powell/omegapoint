<?php 

namespace App\Composers\News;

use Illuminate\View\View;
use App\Models\News\Article;

class ArticleComposer
{

    /**
     * Bind data to the view.
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('ticker', Article::orderBy('date')->limit(2)->get(['id', 'title'])->shuffle());
    }
}
