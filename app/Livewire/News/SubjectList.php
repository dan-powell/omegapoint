<?php

namespace App\Livewire\News;

use App\Models\News\Subject;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class SubjectList extends Component
{
    public Collection $subjects;
    public string $subject;

    public function updated($name, $value): void
    {
        $this->dispatch($name . 'Changed', $value)->to('news.article-list');
    }

    public function resetFiltering(): void
    {
        $this->resetProperties();
        $this->dispatch('resetFiltering')->to('news.article-list');
    }

    public function render()
    {
        $this->subjects = Subject::all();
        return view('livewire.news.subject-list');
    }
}
