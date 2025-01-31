<?php

namespace App\Livewire\News;

use App\Models\News\Article;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ArticleList extends Component
{

    public string $direction = 'asc';
    public Collection $articles;

    public function render()
    {
        $this->articles= Article::limit(10)->orderBy('date', $this->direction)->get();
        return view('livewire.news.article-list');
    }
}
