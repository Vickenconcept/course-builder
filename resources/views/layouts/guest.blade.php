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



    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> --}}
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}




    <link rel="stylesheet" href="{{ asset('build/assets/app-a461d729.css ') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-541c3f26.css ') }}">

    <style>
        .title {
            font-size: 30px;
            padding-bottom: 20px;
            /* color: white; */
        }

        p {
            padding-bottom: 5px;
            line-height: 25px;
            font-size: 15px
        }

        .float {
            position: fixed;
            bottom: 10px;
            left: 50%;

        }

        .body {
            transition: background-color 0.3s ease;
        }

        .dark {
            background-color: black;
            color: white;
        }
    </style>

</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center  sm:pt-0 bg-gray-100">

        <div class="w-full ">
            {{ $slot }}
        </div>
    </div>

    {{-- <div>
        <button class="btn" id="toggleIframe"
            style="
        position: fixed;
        bottom: 20px;
        right: 20px;
        color: white;
        background-color: blue;
        padding: 10px 14px;
        box-shadow: 5px 2px 5px #ccc;
        border-radius: 50px;">
            <i class='bx bxs-bot'></i></button>


        <iframe id="myIframe" src="http://127.0.0.1:8000/guests/63431f07-7abc-4cb5-907c-98a24de066d6"
            style=" position: fixed;
        bottom: 70px;
        right: 20px;
        box-shadow: 3px 3px 6px lightgray ;
        border: 3px solid darkblue;
        border-radius: 10px;
        display: none;
        background-color: #fff;
        box-shadow: 3px 6px 5px gray;"
            width="300" height="500"></iframe>
    </div> --}}



    {{-- <script>
        const body = document.querySelector('body');
        body.classList.add('top-window');
        const btns = document.querySelectorAll('.btn');
        btns.forEach(btn => {
            btn.style.display = 'block';
        });

        function initializeEmbed() {
            const iframe = document.getElementById('myIframe');
            const toggleIcon = document.getElementById('toggleIframe');

            toggleIcon.addEventListener('click', () => {
                iframe.style.display = (iframe.style.display === 'none' || iframe.style.display === '') ?
                    'block' :
                    'none';
            });

            if (window === window.top) {
                document.body.classList.add('top-window');
            }
        }

        initializeEmbed();
    </script> --}}


    <script src="{{ asset('build/assets/app-dd6eec69.js') }}"></script>


</body>

</html>
