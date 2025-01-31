@extends('news.layout')

@section('main')
    @include('news.components.top')
    @yield('body')
@endsection

@section('sidebar')
    <div class="Stats">
        <ul class="Stats_list">
            <li class="Stats_stat">230/4000</li>
            <li class="Stats_stat">!3234</li>
            <li class="Stats_stat">234/432</li>
            <li class="Stats_stat">230/4000</li>
            <li class="Stats_stat">!3234</li>
            <li class="Stats_stat">234/432</li>
        </ul>
    </div>
    <h3 class="divider" title="Subject"><span>Subject</span></h3>
@endsection

@section('center')
    @livewire('news.article-list')
@endsection

@section('aside')
    <h3 class="divider" title="Media"><span>Media</span></h3>
    <div class="media -scanlines">
        <img src="{{ Vite::asset('resources/img/news/test/advert2.jpg') }}"/>
    </div>
@endsection
