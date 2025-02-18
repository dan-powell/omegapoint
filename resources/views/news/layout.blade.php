@extends('shared.wrapper')

@push('head')
    <title>Omega Point News</title>
    @livewireStyles
    @livewireScripts
    @vite(['resources/css/news.css', 'resources/js/news.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quantico:ital,wght@0,400;0,700;1,400;1,700&family=Righteous&display=swap" rel="stylesheet">
@endpush

@section('body')
    <div class="Layout">
        <div class="Layout-header">
            @include('news.components.header')
        </div>
        <div class="Layout-body">
            <div class="Layout-top">
                @yield('top')
            </div>
            <div class="Layout-main">
                <div class="Layout-sidebar">
                    <div class="Layout-sidebar-inner">
                        @yield('sidebar')
                    </div>
                </div>
                <div class="Layout-center">
                    @yield('center')
                </div>
                <div class="Layout-aside">
                    <div class="Layout-aside-inner">
                        @yield('aside')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
