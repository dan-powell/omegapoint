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

        <h1>{{ $article->title }}</h1>
        {{-- @if($article->thumbnail)
            <img src="{{ Image::width(20)->url($article->thumbnail) }}"/>
        @endif --}}
        <div class="ArticleShow-thumb media -cut">
            <img src="{{ Vite::asset('resources/img/news/test/thumb2.jpg') }}"/>
        </div>

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

        @if($article->sections)
            <div class="ArticleShow-sections">
                @foreach($article->sections as $section)
                    @if($section['type'] == 'section')
                        <div class="SectionDefault">
                            @if($section['data']['content'])
                                <div class="SectionDefault-content">
                                    {!! str($section['data']['content'])->markdown()->sanitizeHtml() !!}
                                </div>
                            @endif
                            @if($section['data']['media'])
                                @foreach($section['data']['media'] as $media)
                                    <img src="{{ config('app.url_media') . '/news/' . $media }}"/>
                                @endforeach
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
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
