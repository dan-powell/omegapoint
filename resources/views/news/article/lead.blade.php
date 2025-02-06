<article class="ArticleLead">
    <a class="ArticleLead-link" wire:navigate href="{{ $article->url }}"></a>
    <div class="ArticleLead-media">
        @if($article->lead && count($article->lead))
            <div class="ArticleLead-media-thumb">
                <img class="ArticleLead-media-thumb-img" src="{{ Image::disk('news')->width(720)->url($article->lead[0]) }}" width="720" height="720"/>
            </div>
        @elseif($article->thumb)
            <div class="ArticleLead-media-thumb">
                <img class="ArticleLead-media-thumb-img" src="{{ Image::disk('news')->width(720)->url($article->thumb) }}" width="720" height="720"/>
            </div>
        @endif
        @if($article->lead && count($article->lead) > 1)
            <div class="ArticleLead-media-mini">
                @foreach(array_slice($article->lead, 1) as $lead)
                    <div class="ArticleLead-thumb">
                        <img class="ArticleLead-thumb-img" src="{{ Image::disk('news')->width(480)->url($lead) }}" width="480" height="480"/>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <div class="ArticleLead-main">
        <h3 class="ArticleLead-title">{{ $article->title }}</h3>
        @if($article->introduction)
            <p class="ArticleLead-introduction">{{ $article->introduction }}</p>
        @endif
        <a class="ArticleLead-readmore" wire:navigate href="{{ $article->url }}">
            Would you like to know more? <span class="ArticleLead-readmore-arrow">▷</span>
        </a>
    </div>
</article>
