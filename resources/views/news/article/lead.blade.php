<article class="ArticleLead">
    <a class="ArticleLead-link" wire:navigate href="{{ $article->url }}"></a>
    <div class="ArticleLead-media">
        <div class="ArticleLead-thumb media -cut">
            <img src="{{ Vite::asset('resources/img/news/test/thumb2.jpg') }}"/>
        </div>
        <div class="ArticleLead-media-mini">
            <div class="ArticleLead-thumb media">
                <img src="{{ Vite::asset('resources/img/news/test/thumb2.jpg') }}"/>
            </div>
            <div class="ArticleLead-thumb media">
                <img src="{{ Vite::asset('resources/img/news/test/thumb2.jpg') }}"/>
            </div>
        </div>
    </div>
    <div class="ArticleLead-main">
        <h3 class="ArticleLead-title">{{ $article->title }}</h3>
        @if($article->summary)
            <p class="ArticleLead-summary">{{ $article->summary }}</p>
        @endif
        <a class="ArticleLead-readmore" wire:navigate href="{{ $article->url }}">
            Would you like to know more? ▷
        </a>
    </div>
</article>