<?php

namespace App\Livewire\News;

use App\Models\News\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\Attributes\On;

class ArticleList extends Component
{

    public string $direction = 'asc';
    public Collection $articles;
    public ?string $subject = null;

    public function render()
    {
        $query = Article::limit(10)
            ->orderBy('date', $this->direction);
            if($this->subject) {
                $query->whereHas('subjects', function (Builder $query) {
                    $query->where('id', $this->subject);
                });
            }

        $this->articles = $query->get();
        return view('livewire.news.article-list');
    }

    #[On('subjectChanged')]
    public function subjectChanged($value): void
    {
        $this->subject = $value;
    }

    #[On('resetFiltering')]
    public function resetFiltering(): void
    {
        $this->resetProperties();
        $this->resetPage();
    }
}
