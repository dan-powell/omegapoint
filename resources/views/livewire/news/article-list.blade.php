<div class="ArticleList">
    {{-- <h3 class="divider" title="Articles"><span>Articles</span></h3> --}}
    <form wire:submit class="ArticleList-controls">
        <div class="ArticleList-search">
            <label class="ArticleList-search-label" for="search">
                <svg width="24px" height="24px" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="var(--color-primary)">
                    <path d="M20.5 20.5L22 22" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M16 18.5C16 19.8807 17.1193 21 18.5 21C19.1916 21 19.8175 20.7192 20.2701 20.2654C20.7211 19.8132 21 19.1892 21 18.5C21 17.1193 19.8807 16 18.5 16C17.1193 16 16 17.1193 16 18.5Z"  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M4 6V12C4 12 4 15 11 15C18 15 18 12 18 12V6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M11 3C18 3 18 6 18 6C18 6 18 9 11 9C4 9 4 6 4 6C4 6 4 3 11 3Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M11 21C4 21 4 18 4 18V12" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </label>
            <input id="search" class="ArticleList-search-input" type="text" wire:model.live.debounce="search"/>
        </div>
        <div class="ArticleList-filter">
            <input id="order_latest" type="radio" name="order" wire:model.live="order" value="latest"><label for="order_latest">Latest</label>
            <input id="order_oldest" type="radio" name="order" wire:model.live="order" value="oldest"><label for="order_oldest">Oldest</label>
            <input id="order_title" type="radio" name="order" wire:model.live="order" value="title"><label for="order_title">Title</label>
            <input id="order_random" type="radio" name="order" wire:model.live="order" value="random"><label for="order_random">Random</label>
        </div>
    </form>
    <div class="ArticleList-list" x-data="flip">
        @forelse($articles as $article)
            <div class="ArticleList-item a-fadein" wire:key="{{ $article->id }}">
                @include('news/article/excerpt', ['article' => $article])
            </div>
        @empty
            <div class="no-results">No results found.</div>
        @endforelse
    </div>
</div>
