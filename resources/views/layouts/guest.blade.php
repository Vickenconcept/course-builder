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
    <link rel="stylesheet" href="{{ asset('build/assets/app-541c3f26.css ') }}">

    <style>
        #flipbook a {
            color: #007bff;
            /* Change this color to your desired default link color */
            text-decoration: underline;
        }

        #flipbook {
            -webkit-transition: margin-left 0.2s ease-in-out;
            -moz-transition: margin-left 0.2s ease-in-out;
            -o-transition: margin-left 0.2s ease-in-out;
            -ms-transition: margin-left 0.2s ease-in-out;
            transition: margin-left 0.2s ease-in-out;
        }

        .sj-book .even {
            background: -webkit-gradient(linear, left top, right top, color-stop(0.95, #fff), color-stop(1, #dadada));
            background-image: -webkit-linear-gradient(left, #fff 95%, #dadada 100%);
            background-image: -moz-linear-gradient(left, #fff 95%, #dadada 100%);
            background-image: -ms-linear-gradient(left, #fff 95%, #dadada 100%);
            background-image: -o-linear-gradient(left, #fff 95%, #dadada 100%);
            background-image: linear-gradient(left, #fff 95%, #dadada 100%);
        }

        .sj-book .odd {
            background: -webkit-gradient(linear, right top, left top, color-stop(0.95, #fff), color-stop(1, #cacaca));
            background-image: -webkit-linear-gradient(right, #fff 95%, #cacaca 100%);
            background-image: -moz-linear-gradient(right, #fff 95%, #cacaca 100%);
            background-image: -ms-linear-gradient(right, #fff 95%, #cacaca 100%);
            background-image: -o-linear-gradient(right, #fff 95%, #cacaca 100%);
            background-image: linear-gradient(right, #fff 95%, #cacaca 100%);
        }
    </style>

</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center  sm:pt-0 bg-gray-100">

        <div class="w-full ">
            {{ $slot }}
        </div>
    </div>
    <script>
        $("#flipbook").turn({
            width: 1000,
            height: 600,
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
