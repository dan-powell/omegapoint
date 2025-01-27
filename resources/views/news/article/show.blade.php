@extends('news.layout')

@section('content')
    <div class="container">
        <h1>{{ $article->title }}</h1>

        @if($article->thumbnail)
            <img src="{{ Image::width(20)->url($article->thumbnail) }}"/>
        @endif
    </div>
@endsection
