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
    </div>
@endsection

@section('center')
    <div class="Layout-sticky">
        @include('news.article.lead', [
            'article' => $lead
        ])
    </div>
    <div class="Layout-sticky">
        @livewire('news.article-list', ['except' => [$lead->id]])
    </div>
@endsection

@section('aside')
    <div class="Layout-sticky">
        <h3 class="divider" title="Media"><span>Media</span></h3>
        <div class="media -scanlines">
            <img src="{{ Vite::asset('resources/img/news/test/advert2.jpg') }}"/>
        </div>
        <h3 class="divider" title="Live"><span>Live</span></h3>
        <div class="media -scanlines">
            <img src="{{ Vite::asset('resources/img/news/test/thumb1.jpg') }}"/>
        </div>
    </div>
@endsection
