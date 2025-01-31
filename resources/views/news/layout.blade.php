@extends('shared.wrapper')

@push('head')
    <title>Basic Blade Layout Template</title>
    @livewireStyles
    @livewireScripts
    @vite(['resources/css/news.css', 'resources/js/news.js'])
@endpush

@section('body')
    <div class="Layout">
        <div class="Layout-header">
            @include('news.components.header')
        </div>
        <div class="Layout-top">
            @yield('top')
        </div>
        <div class="Layout-main">
            <div class="Layout-sidebar">
                @yield('sidebar')
            </div>
            <div class="Layout-center">
                @yield('center')
            </div>
            <div class="Layout-aside">
                @yield('aside')
            </div>
        </div>
    </div>
@endsection
