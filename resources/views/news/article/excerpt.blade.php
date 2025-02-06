<article class="ArticleExcerpt">
    <a class="ArticleExcerpt-link" wire:navigate href="{{ $article->url }}"></a>
    <div class="ArticleExcerpt-main">
        <div class="ArticleExcerpt-head">
            <h3 class="ArticleExcerpt-title">
                <a wire:navigate href="{{ $article->url }}">
                    {{ $article->short ?? $article->title }}
                </a>
            </h3>
            @if($article->summary)
                <p class="ArticleExcerpt-summary">{{ $article->summary }}</p>
            @endif
        </div>
        <div class="ArticleExcerpt-foot">
            @if($article->subjects)
                <div class="ArticleExcerpt-subjects">
                    @foreach($article->subjects->take(2) as $subject)
                        <span class="ArticleExcerpt-subject">{{ $subject->name }}</span>
                    @endforeach
                </div>
            @endif
            <a class="ArticleExcerpt-readmore" wire:navigate href="{{ $article->url }}">
                <span class="sronly">Read more about {{ $article->title }} </span> ▷
            </a>
        </div>
    </div>
    @if($article->thumbnail)
        <div class="ArticleExcerpt-thumb media">
            <img class="ArticleExcerpt-thumb-img" src="{{ Image::disk('news')->width(480)->url($article->thumbnail) }}" width="480" height="480"/>
        </div>
    @endif
</article>
