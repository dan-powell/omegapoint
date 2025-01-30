@extends('shared.wrapper')

@push('head')
    <title>Basic Blade Layout Template</title>
    @livewireStyles
    @livewireScripts
    @vite(['resources/css/news.css', 'resources/js/news.js'])
@endpush

@section('body')
    @include('news.components.header')
    @yield('main')
    <div class="Layout">
        <div class="Layout_sidebar">
            @yield('sidebar')
        </div>
        <div class="Layout_center">
            @yield('center')

        </div>
        <div class="Layout_aside">
            @yield('aside')
        </div>
    </div>
@endsection
