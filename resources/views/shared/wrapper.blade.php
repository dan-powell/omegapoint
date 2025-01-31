<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/shared.css', 'resources/js/shared.js'])
    @stack('head')
</head>
<body class="Wrapper">
    <button class="Wrapper-button js-overlay">
        <span class="sronly">Navigation</span>
    </button>
    <div class="Wrapper-overlay">
        <ul class="Wrapper-overlay-nav">
            <li class="Wrapper-overlay-nav-item">
                <a class="Wrapper-overlay-nav-link" href="{{ route('home.index') }}">Home</a>
            </li>
            <li class="Wrapper-overlay-nav-item">
                <a class="Wrapper-overlay-nav-link" href="{{ route('news.index')}}">News</a>
            </li>
        </ul>
    </div>
    @yield('body')
</body>
</html>