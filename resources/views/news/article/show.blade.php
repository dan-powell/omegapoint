@extends('news.layout')

@section('sidebar')
    <a class="ArticleShow-return" wire:navigate href="{{ route('news.index') }}">
        ◁ Index
    </a>
    <section>
        <h3 class="divider" title="Published"><span>Published</span></h3>
        <time class="ArticleShow-published">
            <span>{{ $article->date->format('hm')}}</span>
            <span>{{ $article->date->format('z|Y')}}</span>
        </time>
    </section>
    @if($article->districts->count() || $article->subjects->count())
        <section>
            <h3 class="divider" title="Tagged"><span>Tagged</span></h3>
            <div class="ArticleShow-tagged">
                @foreach($article->districts as $district)
                    <a class="ArticleShow-tagged-button" wire:navigate href="{{ $district->url }}">
                        {{ $district->name }}
                    </a>
                @endforeach
                @foreach($article->subjects as $subject)
                    <a class="ArticleShow-tagged-button" wire:navigate href="{{ $subject->url }}">
                        {{ $subject->name }}
                    </a>
                @endforeach
            </div>
        </section>
    @endif
    @if($article->tldr)
        <div class="ArticleShow-tldr">
            <h3 class="divider" title="TLDR"><span>TLDR</span></h3>
            <div class="ArticleShow-tldr-inner content">
                {{ $article->tldr }}
            </div>
        </div>
    @endif
@endsection

@section('top')
    <h1 class="ArticleShow-title1">{{ $article->title }}</h1>
@endsection

@section('center')
    <article class="ArticleShow-main">
        <header class="ArticleShow-head">
            <div class="ArticleShow-heading a-leftin">
                <h2 class="ArticleShow-title">{{ $article->summary }}</h2>
            </div>
            @if(isset($article->lead) && count($article->lead))
                <div class="ArticleShow-lead a-rightin">
                    <div class="ArticleShow-thumb">
                        <img class="ArticleShow-thumb-img" src="{{ Image::disk('news')->crop(640, 480)->url($article->lead->first()) }}"/>
                    </div>
                </div>
            @endif
            @if(isset($article->lead) && count($article->lead) > 1)
                <div class="ArticleShow-mini a-bottomin g-fadestagger">
                    @foreach($article->lead->slice(1) as $lead)
                        <div class="ArticleShow-mini-thumb">
                            <img class="ArticleShow-mini-thumb-img" src="{{ Image::disk('news')->url($lead) }}"/>
                        </div>
                    @endforeach
                </div>
            @endif
        </header>
        @if($article->introduction)
            <div class="ArticleShow-intro">
                <svg class="ArticleShow-intro-icon" aria-hidden="true" focusable="false">
                    <use xlink:href="{{ asset('news/triangle_sprite.svg#right') }}"></use>
                </svg>
                <div class="ArticleShow-intro-inner content">
                    {{ $article->introduction }}
                </div>
            </div>
        @endif
        @if($article->sections)
            <section class="ArticleShow-sections">
                @foreach($article->sections as $section)
                    @switch($section['type'])
                        @case('section')
                            <div class="ArticleSectionDefault">
                                <div class="ArticleSectionDefault-inner">
                                    @if($section['data']['media'])
                                        <div class="ArticleSectionDefault-media">
                                            @foreach($section['data']['media'] as $media)
                                                <img class="ArticleSectionDefault-media-img" src="{{ Image::disk('news')->url($media) }}"/>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if($section['data']['content'])
                                        <div class="ArticleSectionDefault-content content">
                                            {!! str($section['data']['content'])->markdown()->sanitizeHtml() !!}
                                        </div>
                                    @endif
                                    <svg class="ArticleSectionDefault-icon" aria-hidden="true" focusable="false">
                                        <use xlink:href="{{ asset('news/triangle_sprite.svg#down') }}"></use>
                                    </svg>
                                </div>
                            </div>
                            @break
                    @endswitch
                @endforeach
            </section>
        @endif
@endsection

@section('aside')
    @if($next)
        <div class="ArticleShow-next">
            <h3 class="divider" title="Next"><span>Next</span></h3>
            @if($next->thumbnail)
                <a class="ArticleShow-next-thumb media" wire:navigate href="{{ $next->url }}">
                    <img class="ArticleShow-next-thumb-img" src="{{ Image::disk('news')->height(600)->url($next->thumbnail) }}"/>
                </a>
            @endif
            <a class="ArticleShow-next-link" wire:navigate href="{{ $next->url }}">
                {{ $next->short }} ▷
            </a>
        </div>
    @endif
    @if($previous)
        <div class="ArticleShow-next">
            <h3 class="divider" title="Previous"><span>Previous</span></h3>
            @if($previous->thumbnail)
                <a class="ArticleShow-next-thumb media" wire:navigate href="{{ $previous->url }}">
                    <img class="ArticleShow-next-thumb-img" src="{{ Image::disk('news')->height(600)->url($previous->thumbnail) }}"/>
                </a>
            @endif
            <a class="ArticleShow-next-link" wire:navigate href="{{ $previous->url }}">
                ◁ {{ $previous->short }}
            </a>
        </div>
    @endif
    @if($article->updates && !empty($article->updates))
        <div class="ArticleShow-tldr">
            <h3 class="divider" title="Updates"><span>Updates</span></h3>
            <div class="ArticleShow-tldr-inner">
                @foreach(collect($article->updates)->sortBy('date') as $update)
                    @switch($update['type'])
                        @case('update')
                            <div class="ArticleUpdateDefault">
                                @if($update['data']['date'])
                                    <div class="ArticleUpdateDefault-content">
                                        {!! Carbon\Carbon::parse($update['data']['date'])->format('H:s') !!}
                                    </div>
                                @endif
                                @if($update['data']['media'])
                                    <div class="ArticleUpdateDefault-media">
                                        <img class="ArticleUpdateDefault-media-img" src="{{ Image::disk('news')->url($update['data']['media']) }}"/>
                                    </div>
                                @endif
                                @if($update['data']['content'])
                                    <div class="ArticleUpdateDefault-content">
                                        {!! str($update['data']['content'])->markdown()->sanitizeHtml() !!}
                                    </div>
                                @endif
                            </div>
                            @break
                    @endswitch
                @endforeach
            </div>
        </div>
    @endif
@endsection
