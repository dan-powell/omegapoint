<div class="Marquee">
    <div class="Marquee-track">
        <ul class="Marquee-list js-marquee" id="js-marquee">
            @foreach($ticker as $article)
                <li class="Marquee-item"><a class="Marquee-link" wire:navigate href="{{ route('news.article.show', ['id' => $article->id]) }}">{{ $article->title }}</a></li>
            @endforeach
        </ul>
    </div>
</div>