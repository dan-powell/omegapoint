<div class="ArticleList">
    <h3 class="divider" title="Articles"><span>Articles</span></h3>
    <form wire:submit>
        <label><input type="radio" name="order" wire:model.live="order" value="date"> Date</label>
        <label><input type="radio" name="order" wire:model.live="order" value="title"> Title</label>
        <label><input type="radio" name="order" wire:model.live="order" value="random"> Random</label>

        <label><input type="radio" name="direction" wire:model.live="direction" value="desc"> Desc</label>
        <label><input type="radio" name="direction" wire:model.live="direction" value="asc"> Asc</label>
    </form>
    <div class="ArticleList-list" x-data="flip">
        @forelse($articles as $article)
            <div class="ArticleList-item" wire:key="{{ $article->id }}">
                @include('news/article/excerpt', ['article' => $article])
            </div>
        @empty
            <div class="no-results">No results found.</div>
        @endforelse
    </div>
</div>
