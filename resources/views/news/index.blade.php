@extends('news.layout')

@section('top')
    @include('news.components.top')
@endsection

@section('sidebar')
    <div class="Stats">
        <ul class="Stats-list">
            <li class="Stats-stat">230/4000</li>
            <li class="Stats-stat">!3234</li>
            <li class="Stats-stat">234/432</li>
            <li class="Stats-stat">230/4000</li>
            <li class="Stats-stat">!3234</li>
            <li class="Stats-stat">234/432</li>
        </ul>
    </div>
    <div class="Layout-sticky">
        <h3 class="divider" title="Subject"><span>Subject</span></h3>
        @livewire('news.subject-list')
        <h3 class="divider" title="District"><span>District</span></h3>
        @livewire('news.district-list')
        @if(count($archive))
            <h3 class="divider" title="Archive"><span>Archive</span></h3>
            <div class="NewsIndex-archive">
                <ul class="NewsIndex-archive-list">
                    @foreach($archive as $article)
                        <li class="NewsIndex-archive-item">
                            <a class="NewsIndex-archive-link" href="{{ $article->url }}">{{ $article->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection

@section('center')
    <div class="Layout-sticky">
        @include('news.article.lead', [
            'article' => $lead
        ])
    </div>
    <div class="Layout-sticky" id="article-list">
        <livewire:news.article-list lazy :except="[$lead->id]" />
    </div>
@endsection

@section('aside')
    <div class="Layout-sticky">
        <h3 class="divider" title="Media"><span>Media</span></h3>
        <div class="media">
            <video autoplay muted loop>
                <source src="{{ Vite::asset('resources/img/news/test/1234.mp4') }}" type="video/mp4">
            </video>
        </div>
        <h3 class="divider" title="Live"><span>Live</span></h3>
        <div class="media -scanlines">
            <img src="{{ Vite::asset('resources/img/news/test/thumb1.jpg') }}"/>
        </div>
    </div>
@endsection
