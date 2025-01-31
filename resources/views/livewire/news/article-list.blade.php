<div class="ArticleList">
    <h3 class="divider" title="Articles"><span>Articles</span></h3>
    <form wire:submit>
        <select wire:model.live="direction">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select>
    </form>
    <div class="ArticleList-list">
        @forelse($articles as $article)
            @include('news/article/excerpt', ['article' => $article])
        @empty
            <div class="no-results">No results found.</div>
        @endforelse
    </div>
</div>
