<div class="Ticker">
    <div class="Ticker-track">
        <ul class="Ticker-list">
            @foreach($ticker as $article)
                <li class="Ticker-item"><a class="Ticker-link" href="{{ route('news.article.show', ['id' => $article->id]) }}">{{ $article->title }}</a></li>
            @endforeach
        </ul>
    </div>
</div>