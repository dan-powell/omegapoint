@extends('shared.wrapper')

@push('head')
    <title>Basic Blade Layout Template</title>
    @livewireStyles
    @livewireScripts
    @vite(['resources/css/news.css', 'resources/js/news.js'])
@endpush

@section('body')
    <div class="Layout">
        <div class="Layout_header">
            @include('news.components.header')
        </div>
        <div class="Layout_main">
            @yield('main')
        </div>
        <div class="Layout_main">
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
    </div>
@endsection
