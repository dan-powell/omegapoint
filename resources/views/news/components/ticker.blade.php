<div class="Ticker">
    <div class="Ticker_track">
        <ul class="Ticker_list">
            @foreach($articles as $article)
                <li class="Ticker_item"><a class="Ticker_link" href="{{ route('news.article.show', ['id' => $article->id]) }}">{{ $article->title }}</a></li>
            @endforeach
        </ul>
    </div>
</div>