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
@endsection
