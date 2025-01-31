<?php

namespace App\Livewire\News;

use App\Models\News\Subject;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\Attributes\Url;

class SubjectList extends Component
{
    public Collection $subjects;

    #[Url(as: 'sub', history: true)]
    public array $chosenSubjects = [];

    public function updated(): void
    {
        $this->dispatch('chosenSubjectsChanged', $this->chosenSubjects)->to('news.article-list');
    }

    public function resetFiltering(): void
    {
        $this->resetProperties();
        $this->dispatch('resetFiltering')->to('news.article-list');
    }

    public function render()
    {
        $this->subjects = Subject::with(['articles'])->get();
        return view('livewire.news.subject-list');
    }
}
