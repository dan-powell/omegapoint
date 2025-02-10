<article class="ArticleLead">
    {{-- <a class="ArticleLead-link" wire:navigate href="{{ $article->url }}"></a> --}}
    <div class="ArticleLead-media">
        @if($article->lead && count($article->lead))
            <div class="ArticleLead-media-thumb">
                <a wire:navigate href="{{ $article->url }}">
                    <img class="ArticleLead-media-thumb-img" src="{{ Image::disk('news')->url($article->lead[0]) }}"/>
                </a>
            </div>
        @elseif($article->thumb)
            <div class="ArticleLead-media-thumb">
                <a wire:navigate href="{{ $article->url }}">
                    <img class="ArticleLead-media-thumb-img" src="{{ Image::disk('news')->url($article->thumb) }}"/>
                </a>
            </div>
        @endif
        @if($article->lead && count($article->lead) > 1)
            <div class="ArticleLead-media-mini">
                @foreach(array_slice($article->lead, 1) as $key => $lead)
                    @break($key > 1)
                    <div class="ArticleLead-media-mini-thumb">
                        <a wire:navigate href="{{ $article->url }}">
                            <img class="ArticleLead-media-mini-thumb-img" src="{{ Image::disk('news')->url($lead) }}"/>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <div class="ArticleLead-main">
        <h3 class="ArticleLead-title">
            <a class="ArticleLead-title-link" wire:navigate href="{{ $article->url }}">{{ $article->title }}</a>
        </h3>
        @if($article->tldr)
            <p class="ArticleLead-introduction">
                {{ $article->tldr }}
            </p>
        @endif
        <a class="ArticleLead-readmore" wire:navigate href="{{ $article->url }}">
            Would you like to know more? <span class="ArticleLead-readmore-arrow">▷</span>
        </a>
    </div>
</article>
