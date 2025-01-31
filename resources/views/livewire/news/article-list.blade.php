<div class="ArticleList">
    <form wire:submit>
        <select wire:model.live="direction">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select>
    </form>
    <div class="ArticleList_list">
        @foreach($articles as $article)
            @include('news/article/excerpt', ['article' => $article])
        @endforeach
    </div>
</div>
