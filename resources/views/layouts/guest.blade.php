<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <x-seo::meta />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Scripts -->
    {{-- <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) --> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/turnjs4/lib/turn.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('build/assets/app-a461d729.css ') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-98741b03.css ') }}">


</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center  sm:pt-0 bg-gray-100">
        <!-- <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
            </div> -->

        <!-- <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"> -->
        <div class="w-full ">
            {{ $slot }}
        </div>
    </div>
    <script>
        $("#flipbook").turn({
            width: 1200,
            height: 500,
            autoCenter: true,
            display: 'double', // 'double' is a string, make sure to enclose it in quotes
            acceleration: true,
            elevation: 50, // Corrected property name
            gradients: true, // Enable gradients for more realistic page colors
            duration: 1000, // Duration of the flip animation in milliseconds
            turnCorners: 'bl,br',
        });


        jQuery(document).ready(function($) {

            $(window).bind('keydown', function(e) {
                if (e.keyCode == 37) {
                    $("#flipbook").turn('previous');
                } else if (e.keyCode == 39) {
                    $("#flipbook").turn('next');
                }
            });

            $(document).ready(function() {
                $("#nextButton").click(function() {
                    $("#flipbook").turn("next");
                });
            });
            $(document).ready(function() {
                $("#previousButton").click(function() {
                    $("#flipbook").turn("previous");
                });
            });
        });

        const controls = document.getElementById('controls');
        const flipbook = document.getElementById('flipbook');

        gsap.set(controls, {
            y: '100%',
            opacity: 0
        });

        flipbook.addEventListener('mouseenter', () => {
            gsap.to(controls, {
                y: '0%',
                opacity: 1,
                duration: 0.3
            });
        });

        // flipbook.addEventListener('mouseleave', () => {
        //     gsap.to(controls, {
        //         y: '100%',
        //         opacity: 0,
        //         duration: 0.3
        //     });
        // });
    </script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="{{ asset('build/assets/app-dd6eec69.js') }}"></script>
    {{-- <script src="{{ asset('js/turnjs4/lib/hash.js') }}"></script> --}}


</body>

</html>
