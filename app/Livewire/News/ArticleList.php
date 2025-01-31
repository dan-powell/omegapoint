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
    public ?array $subjects = null;

    public function render()
    {
        $query = Article::limit(10)
            ->orderBy('date', $this->direction);
            if($this->subjects) {
                $query->whereHas('subjects', function (Builder $query) {
                    $query->whereIn('id', $this->subjects);
                });
            }

        $this->articles = $query->get();
        return view('livewire.news.article-list');
    }

    #[On('chosenSubjectsChanged')]
    public function subjectChanged($value): void
    {
        $this->subjects = $value;
    }

    #[On('resetFiltering')]
    public function resetFiltering(): void
    {
        $this->resetProperties();
        $this->resetPage();
    }
}
