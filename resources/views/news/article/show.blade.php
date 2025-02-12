@extends('news.layout')

@section('sidebar')
    <div class="Layout-sticky">
        <a class="ArticleShow-return" wire:navigate onclick="history.go(-1)" href="{{ route('news.index') }}">
            ◁ Index
        </a>
        <h3 class="divider" title="Published"><span>Published</span></h3>
        <time>
            <span>{{ $article->date->format('hm')}}</span>
            <span>{{ $article->date->format('z|Y')}}</span>
        </time>

        <h3 class="divider" title="Tagged"><span>Tagged</span></h3>
        @foreach($article->districts as $district)
            <a class="button" href="{{ $district->url }}">
                {{ $district->name }}
            </a>
        @endforeach
        @foreach($article->subjects as $subject)
            <a class="button" href="{{ $subject->url }}">
                {{ $subject->name }}
            </a>
        @endforeach
    </div>
@endsection

@section('center')

    <article class="ArticleShow-main">
        <header class="ArticleShow-head">
            <div class="ArticleShow-heading">
                <h1 class="ArticleShow-title">{{ $article->title }}</h1>
            </div>
            @if(isset($article->lead) && count($article->lead))
                <div class="ArticleShow-lead">
                    <div class="ArticleShow-thumb">
                        <img class="ArticleShow-thumb-img" src="{{ Image::disk('news')->url($article->lead->first()) }}"/>
                    </div>
                </div>
            @endif
            @if(isset($article->lead) && count($article->lead) > 1)
                <div class="ArticleShow-mini">
                    @foreach($article->lead->slice(1) as $lead)
                        <div class="ArticleShow-thumb">
                            <img class="ArticleShow-thumb-img" src="{{ Image::disk('news')->url($lead) }}"/>
                        </div>
                    @endforeach
                </div>
            @endif
        </header>
        <div class="ArticleShow-intro">
            @if($article->introduction)
                <div class="ArticleShow-introduction">
                    <div class="Layout-sticky">
                        {{ $article->introduction }}
                    </div>
                </div>
            @endif
        </div>
        @if($article->sections)
            <section class="ArticleShow-sections">
                @foreach($article->sections as $section)

                    @switch($section['type'])
                        @case('section')
                            <div class="ArticleSectionDefault">
                                <div class="ArticleSectionDefault-inner">
                                    @if($section['data']['content'])
                                        <div class="ArticleSectionDefault-content">
                                            {!! str($section['data']['content'])->markdown()->sanitizeHtml() !!}
                                        </div>
                                    @endif
                                    @if($section['data']['media'])
                                        <div class="ArticleSectionDefault-media">
                                            @foreach($section['data']['media'] as $media)
                                                <img class="ArticleSectionDefault-media-img" src="{{ Image::disk('news')->url($media) }}"/>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @break
                    @endswitch

                @endforeach
            </section>
        @endif

@endsection


@section('aside')
    <div class="Layout-sticky">
        @if($article->tldr)
            <div class="ArticleShow-tldr">
                <h3 class="divider" title="TLDR"><span>TLDR</span></h3>
                <div class="ArticleShow-tldr-inner">
                    {{ $article->tldr }}
                </div>
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
    </div>
@endsection
