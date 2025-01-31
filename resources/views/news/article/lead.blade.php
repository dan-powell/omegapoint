<article class="ArticleLead">
    <a class="ArticleLead-link" href="{{ $article->url }}"></a>
    <div class="ArticleLead-thumb media -scanlines -cut">
        <img src="{{ Vite::asset('resources/img/news/test/thumb2.jpg') }}"/>
    </div>
    <h3 class="ArticleLead-title">{{ $article->title }}</h3>
    @if($article->summary)
        <p class="ArticleLead-summary">{{ $article->summary }}</p>
    @endif
    <a class="ArticleLead-readmore" href="{{ $article->url }}">
        <span class="sronly">Read more about {{ $article->title }} </span> ▷
    </a>
</article>