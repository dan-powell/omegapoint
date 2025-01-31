<?php

namespace App\Livewire\News;

use App\Models\News\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\Attributes\On;

class ArticleList extends Component
{

    public string $direction = 'desc';
    public Collection $articles;
    public ?array $except = null;
    public ?array $subjects = null;
    public ?array $districts = null;

    public function render()
    {

        $query = Article::limit(10)
            ->orderBy('date', $this->direction);

        // Filter by subject
        if($this->subjects) {
            $query->whereHas('subjects', function (Builder $query) {
                $query->whereIn('id', $this->subjects);
            });
        }

        // Filter by district
        if($this->districts) {
            $query->whereHas('districts', function (Builder $query) {
                $query->whereIn('id', $this->districts);
            });
        }

        // Except
        if($this->except) {
            $query->whereNotIn('id', $this->except);
        }

        $this->articles = $query->get();
        return view('livewire.news.article-list');
    }

    #[On('chosenSubjectsChanged')]
    public function subjectChanged($value): void
    {
        $this->subjects = $value;
    }

    #[On('chosenDistrictsChanged')]
    public function districtChanged($value): void
    {
        $this->districts = $value;
    }

    #[On('resetFiltering')]
    public function resetFiltering(): void
    {
        $this->resetProperties();
        $this->resetPage();
    }
}
