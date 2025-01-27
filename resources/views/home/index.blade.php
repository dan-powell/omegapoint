@extends('home/layout')

@push('head')
    <script src="{{ asset('assets/js/particles.js') }}"></script>
@endpush

@section('body')
    <div id="body">
        <div id="particles-js"></div>
        <div class="container">
            <a class="link" href="/" title="Home">
                <div class="logowrapper">
                    <svg width="330" height="300" viewBox="0 0 330 300" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" class="logo logo1">
                        <style>
                            @keyframes spin {
                                100% { transform: rotateY(180deg) perspective(500vw); }
                            }
                            .spinner {
                                animation: spin 2s linear infinite;
                                animation-delay: .02s;
                                transform-origin: center;
                            }
                        </style>
                        <path d="M165,291.989L1.344,8.318L165,8.318L165,30.318L54.155,30.318C51.118,30.318 48.312,31.938 46.793,34.568C45.274,37.198 45.273,40.438 46.791,43.068L157.636,235.2C159.154,237.832 161.962,239.453 165,239.453L165,291.989Z" style="fill:rgb(190,254,3);" class="spinner"/>
                        <path d="M165,8.318L328.656,8.318L165,291.989L165,239.453C168.038,239.453 170.846,237.832 172.364,235.2L283.209,43.068C284.727,40.438 284.726,37.198 283.207,34.568C281.688,31.938 278.882,30.318 275.845,30.318L165,30.318L165,8.318Z" style="fill:rgb(190,254,3);" class="spinner"/>        
                    </svg>        
                    <svg width="330" height="300" viewBox="0 0 330 300" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" class="logo logo2">
                        <style>
                            @keyframes spin {
                                100% { transform: rotateY(180deg) perspective(500vw); }
                            }
                            .spinner2 {
                                animation: spin 2s linear infinite;
                                animation-delay: .03s;
                                transform-origin: center;
                            }
                        </style>
                        <path d="M165,291.989L1.344,8.318L165,8.318L165,30.318L54.155,30.318C51.118,30.318 48.312,31.938 46.793,34.568C45.274,37.198 45.273,40.438 46.791,43.068L157.636,235.2C159.154,237.832 161.962,239.453 165,239.453L165,291.989Z" style="fill:rgb(190,254,3);" class="spinner2"/>
                        <path d="M165,56.068C190.822,56.068 211.786,77.032 211.786,102.854C211.786,128.675 190.822,149.639 165,149.639C139.178,149.639 118.214,128.675 118.214,102.854C118.214,77.032 139.178,56.068 165,56.068ZM165,75.928C150.139,75.928 138.075,87.993 138.075,102.854C138.075,117.714 150.139,129.779 165,129.779C179.861,129.779 191.925,117.714 191.925,102.854C191.925,87.993 179.861,75.928 165,75.928Z" style="fill:rgb(233,44,168);" class="oh"/>      
                        <path d="M165,8.318L328.656,8.318L165,291.989L165,239.453C168.038,239.453 170.846,237.832 172.364,235.2L283.209,43.068C284.727,40.438 284.726,37.198 283.207,34.568C281.688,31.938 278.882,30.318 275.845,30.318L165,30.318L165,8.318Z" style="fill:rgb(190,254,3);" class="spinner2"/>  
                    </svg>
                    <svg width="330" height="300" viewBox="0 0 330 300" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" class="logo logo3">
                        <style>
                            @keyframes spin {
                                100% { transform: rotateY(180deg) perspective(500vw); }
                            }
                            .spinner3 {
                                animation: spin 2s linear infinite;
                                animation-delay: .01s;
                                transform-origin: center;
                            }
                        </style>
                        <path d="M165,291.989L1.344,8.318L165,8.318L165,30.318L54.155,30.318C51.118,30.318 48.312,31.938 46.793,34.568C45.274,37.198 45.273,40.438 46.791,43.068L157.636,235.2C159.154,237.832 161.962,239.453 165,239.453L165,291.989Z" style="fill:rgb(190,254,3);" class="spinner3"/>
                        <path d="M165,56.068C190.822,56.068 211.786,77.032 211.786,102.854C211.786,128.675 190.822,149.639 165,149.639C139.178,149.639 118.214,128.675 118.214,102.854C118.214,77.032 139.178,56.068 165,56.068ZM165,75.928C150.139,75.928 138.075,87.993 138.075,102.854C138.075,117.714 150.139,129.779 165,129.779C179.861,129.779 191.925,117.714 191.925,102.854C191.925,87.993 179.861,75.928 165,75.928Z" style="fill:rgb(233,44,168);" class="oh"/>      
                        <path d="M165,8.318L328.656,8.318L165,291.989L165,239.453C168.038,239.453 170.846,237.832 172.364,235.2L283.209,43.068C284.727,40.438 284.726,37.198 283.207,34.568C281.688,31.938 278.882,30.318 275.845,30.318L165,30.318L165,8.318Z" style="fill:rgb(190,254,3);" class="spinner3"/>        
                    </svg> 
                </div>
            </a>
        </div>
        <script>
            particlesJS.load('particles-js', '{{ asset('assets/js/particles.json') }}');   
        </script>
    </div>
@endsection
