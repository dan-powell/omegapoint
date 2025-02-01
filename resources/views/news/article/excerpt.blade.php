<article class="ArticleExcerpt">
    <a class="ArticleExcerpt-link" wire:navigate href="{{ $article->url }}"></a>
    <div class="ArticleExcerpt-thumb media">
        <img src="{{ Vite::asset('resources/img/news/test/thumb2.jpg') }}"/>
    </div>
    <h3 class="ArticleExcerpt-title">{{ $article->title }}</h3>
    @if($article->summary)
        <p class="ArticleExcerpt-summary">{{ $article->summary }}</p>
    @endif
    <a class="ArticleExcerpt-readmore" wire:navigate href="{{ $article->url }}">
        <span class="sronly">Read more about {{ $article->title }} </span> ▷
    </a>
</article>