<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/shared.css', 'resources/js/shared.js'])
    @stack('head')
</head>
<body>
    <button class="Wrapper_button">Navigation</button>
    <div class="Wrapper_overlay">
        <a href="{{ route('home.index') }}">Home</a>
    </div>
    @yield('body')
</body>
</html>