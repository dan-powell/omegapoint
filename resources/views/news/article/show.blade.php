@extends('news.layout')

@section('sidebar')
    <div class="Layout-sticky">
        <a wire:navigate href="{{ route('news.index') }}">
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

    <article class="ArticleShow">
        <header class="ArticleShow-head">

            <h1>{{ $article->title }}</h1>
            @if(isset($article->lead) && count($article->lead))
                @foreach($article->lead as $lead)
                    <div class="ArticleShow-thumb media -cut">
                        <img src="{{ Image::disk('news')->url($lead) }}"/>
                    </div>
                @endforeach
            @endif
            @if($article->summary)
                <div class="ArticleShow-summary">
                    {{ $article->summary }}
                </div>
            @endif
            @if($article->introduction)
                <div class="ArticleShow-introduction">
                    {{ $article->introduction }}
                </div>
            @endif

        </header>

        @if($article->sections)
            <section class="ArticleShow-sections">
                @foreach($article->sections as $section)
                    @if($section['type'] == 'section')
                        <div class="ArticleSectionDefault">
                            @if($section['data']['content'])
                                <div class="ArticleSectionDefault-content">
                                    {!! str($section['data']['content'])->markdown()->sanitizeHtml() !!}
                                </div>
                            @endif
                            @if($section['data']['media'])
                                <div class="ArticleSectionDefault-media">
                                    @foreach($section['data']['media'] as $media)
                                        <img class="ArticleSectionDefault-media" src="{{ Image::disk('news')->url($media) }}"/>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach
            </section>
        @endif

@endsection


@section('aside')
    <div class="Layout-sticky">
        <h3 class="divider" title="TLDR"><span>TLDR</span></h3>
        @if($article->tldr)
            <div class="ArticleShow-tldr">
                {{ $article->tldr }}
            </div>
        @endif
    </div>
@endsection
