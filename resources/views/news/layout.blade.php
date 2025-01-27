@extends('shared.wrapper')

@push('head')
    <title>Basic Blade Layout Template</title>
    @vite(['resources/css/news.css', 'resources/js/news.js'])
@endpush

@section('body')
    @include('news.components.header')
    @yield('content')
@endsection