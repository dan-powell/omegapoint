<article class="ArticleExcerpt">
    <a class="ArticleExcerpt-link" href="{{ $article->url }}"></a>
    <div class="ArticleExcerpt-thumb media -scanlines -cut">
        <img src="{{ Vite::asset('resources/img/news/test/thumb2.jpg') }}"/>
    </div>
    <h3 class="ArticleExcerpt-title">{{ $article->title }}</h3>
    @if($article->summary)
        <p class="ArticleExcerpt-summary">{{ $article->summary }}</p>
    @endif
    <a class="ArticleExcerpt-readmore" href="{{ $article->url }}">
        <span class="sronly">Read more about {{ $article->title }} </span> ▷
    </a>
</article>