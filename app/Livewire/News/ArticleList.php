<?php

namespace App\Livewire\News;

use App\Models\News\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;

class ArticleList extends Component
{

    #[Url(as: 'sub')]
    public array $subjects = [];

    #[Url(as: 'dis')]
    public array $districts = [];

    #[Url(as: 'order')]
    public string $order = 'latest';

    public ?string $search = null;

    public Collection $articles;
    public ?array $except = null;

    public function placeholder()
    {
        return <<<'HTML'
        <div style="display: flex; align-items: center; justify-content: center; width: 100%; min-height: 200px;">
            <!-- Loading spinner... -->
            <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="fill: #fff;">
                <style>.spinner_zWVm{animation:spinner_5QiW 1.2s linear infinite,spinner_PnZo 1.2s linear infinite}.spinner_gfyD{animation:spinner_5QiW 1.2s linear infinite,spinner_4j7o 1.2s linear infinite;animation-delay:.1s}.spinner_T5JJ{animation:spinner_5QiW 1.2s linear infinite,spinner_fLK4 1.2s linear infinite;animation-delay:.1s}.spinner_E3Wz{animation:spinner_5QiW 1.2s linear infinite,spinner_tDji 1.2s linear infinite;animation-delay:.2s}.spinner_g2vs{animation:spinner_5QiW 1.2s linear infinite,spinner_CMiT 1.2s linear infinite;animation-delay:.2s}.spinner_ctYB{animation:spinner_5QiW 1.2s linear infinite,spinner_cHKR 1.2s linear infinite;animation-delay:.2s}.spinner_BDNj{animation:spinner_5QiW 1.2s linear infinite,spinner_Re6e 1.2s linear infinite;animation-delay:.3s}.spinner_rCw3{animation:spinner_5QiW 1.2s linear infinite,spinner_EJmJ 1.2s linear infinite;animation-delay:.3s}.spinner_Rszm{animation:spinner_5QiW 1.2s linear infinite,spinner_YJOP 1.2s linear infinite;animation-delay:.4s}@keyframes spinner_5QiW{0%,50%{width:7.33px;height:7.33px}25%{width:1.33px;height:1.33px}}@keyframes spinner_PnZo{0%,50%{x:1px;y:1px}25%{x:4px;y:4px}}@keyframes spinner_4j7o{0%,50%{x:8.33px;y:1px}25%{x:11.33px;y:4px}}@keyframes spinner_fLK4{0%,50%{x:1px;y:8.33px}25%{x:4px;y:11.33px}}@keyframes spinner_tDji{0%,50%{x:15.66px;y:1px}25%{x:18.66px;y:4px}}@keyframes spinner_CMiT{0%,50%{x:8.33px;y:8.33px}25%{x:11.33px;y:11.33px}}@keyframes spinner_cHKR{0%,50%{x:1px;y:15.66px}25%{x:4px;y:18.66px}}@keyframes spinner_Re6e{0%,50%{x:15.66px;y:8.33px}25%{x:18.66px;y:11.33px}}@keyframes spinner_EJmJ{0%,50%{x:8.33px;y:15.66px}25%{x:11.33px;y:18.66px}}@keyframes spinner_YJOP{0%,50%{x:15.66px;y:15.66px}25%{x:18.66px;y:18.66px}}</style>
                <rect class="spinner_zWVm" x="1" y="1" width="7.33" height="7.33"/><rect class="spinner_gfyD" x="8.33" y="1" width="7.33" height="7.33"/><rect class="spinner_T5JJ" x="1" y="8.33" width="7.33" height="7.33"/><rect class="spinner_E3Wz" x="15.66" y="1" width="7.33" height="7.33"/><rect class="spinner_g2vs" x="8.33" y="8.33" width="7.33" height="7.33"/><rect class="spinner_ctYB" x="1" y="15.66" width="7.33" height="7.33"/><rect class="spinner_BDNj" x="15.66" y="8.33" width="7.33" height="7.33"/><rect class="spinner_rCw3" x="8.33" y="15.66" width="7.33" height="7.33"/><rect class="spinner_Rszm" x="15.66" y="15.66" width="7.33" height="7.33"/>
            </svg>
        </div>
        HTML;
    }

    public function render()
    {
        $query = Article::limit(10)
            ->with(['subjects']);

        // Search
        if($this->search) {
            $query->whereLike('short', '%' . $this->search . '%')->orWhereLike('title', '%' . $this->search . '%');
        }

        // Ordering
        switch($this->order) {
            case 'latest':
                $query->orderBy('date', 'desc');
                break;
            case 'oldest':
                $query->orderBy('date', 'asc');
                break;
            case 'title':
                $query->orderBy('short', 'asc')->orderBy('title', 'asc');
                break;
            case 'random':
                $query->inRandomOrder();
                break;
        }

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
        if($this->except && $this->search == null && !$this->subjects && !$this->districts) {
            $query->whereNotIn('id', $this->except);
        }

        $this->articles = $query->get();
        return view('livewire.news.article-list');
    }

    #[On('chosenSubjectsChanged')]
    public function subjectChanged($value): void
    {
        $this->dispatch("articleListChanged");
        $this->subjects = $value;
        $this->search = null;
    }

    #[On('chosenDistrictsChanged')]
    public function districtChanged($value): void
    {
        $this->dispatch("articleListChanged");
        $this->districts = $value;
        $this->search = null;
    }

    #[On('resetFiltering')]
    public function resetFiltering(): void
    {
        $this->dispatch("articleListChanged");
        $this->resetProperties();
        $this->resetPage();
    }
}
