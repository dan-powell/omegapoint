<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/shared.css', 'resources/js/shared.js'])
    @stack('head')
</head>
<body class="Wrapper">
    <button class="Wrapper_button js-overlay">
        <span class="u-sronly">Navigation</span>
    </button>
    <div class="Wrapper_overlay">
        <ul class="Wrapper_overlay_nav">
            <li class="Wrapper_overlay_nav_item">
                <a class="Wrapper_overlay_nav_link" href="{{ route('home.index') }}">Home</a>
            </li>
            <li class="Wrapper_overlay_nav_item">
                <a class="Wrapper_overlay_nav_link" href="{{ route('news.index')}}">News</a>
            </li>
        </ul>
    </div>
    @yield('body')
</body>
</html>