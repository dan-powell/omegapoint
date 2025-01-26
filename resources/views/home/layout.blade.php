@extends('shared.wrapper')

@push('head')
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/home.css', 'resources/js/home.js'])
@endpush