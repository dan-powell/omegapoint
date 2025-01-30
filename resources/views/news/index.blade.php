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
    <hr/>
@endsection

@section('center')
    <img src="{{ Vite::asset('resources/img/news/test/thumb2.jpg') }}"/>
    <p>You're correct that the directive in Laravel Blade templates is designed for including other template files, not directly for including HTML content like an SVG file.</p>
@endsection

@section('aside')
    <hr/>
@endsection
