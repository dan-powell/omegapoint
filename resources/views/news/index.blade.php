@extends('news.layout')

@section('main')
    @include('news.components.top')
    @yield('body')
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
    <h3 class="divider" title="Subject"><span>Subject</span></h3>
    @livewire('news.subject-list')
    <h3 class="divider" title="District"><span>District</span></h3>
    @livewire('news.district-list')
@endsection

@section('center')
    @include('news.article.lead', [
        'article' => $lead
    ])
    @livewire('news.article-list', ['except' => [$lead->id]])
@endsection

@section('aside')
    <h3 class="divider" title="Media"><span>Media</span></h3>
    <div class="media -scanlines">
        <img src="{{ Vite::asset('resources/img/news/test/advert2.jpg') }}"/>
    </div>
    <h3 class="divider" title="Live"><span>Live</span></h3>
    <div class="media -scanlines">
        <img src="{{ Vite::asset('resources/img/news/test/thumb1.jpg') }}"/>
    </div>
@endsection
