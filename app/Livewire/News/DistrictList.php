<?php

namespace App\Livewire\News;

use App\Models\Area\District;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\Attributes\Url;

class DistrictList extends Component
{
    public Collection $districts;

    #[Url(as: 'dis', history: true)]
    public array $chosenDistricts = [];

    public function updated(): void
    {
        $this->dispatch('chosenDistrictsChanged', $this->chosenDistricts)->to('news.article-list');
    }

    public function resetFiltering(): void
    {
        $this->resetProperties();
        $this->dispatch('resetFiltering')->to('news.article-list');
    }

    public function render()
    {
        $this->districts = District::all();
        return view('livewire.news.district-list');
    }
}
