<article class="ArticleExcerpt">
    <a class="ArticleExcerpt-link" wire:navigate href="{{ $article->url }}"></a>
    @if($article->thumbnail)
        <div class="ArticleExcerpt-thumb media">
            <img src="{{ Image::disk('news')->url($article->thumbnail) }}"/>
        </div>
    @endif
    <h3 class="ArticleExcerpt-title">{{ $article->short ?? $article->title }}</h3>
    @if($article->summary)
        <p class="ArticleExcerpt-summary">{{ $article->summary }}</p>
    @endif
    <a class="ArticleExcerpt-readmore" wire:navigate href="{{ $article->url }}">
        <span class="sronly">Read more about {{ $article->title }} </span> ▷
    </a>
</article>