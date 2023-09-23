<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <x-seo::meta />

    @seo([
        'title' => 'Course Dynamo',
        'description' => 'A comprehensive app for Ai course generator',
        'image' => asset('images/book-cover.jpg'),
        'type' => 'article', // You can set this to 'article', 'website', 'video', etc. depending on the type of content
        'url' => '', // Replace with the actual route for viewing the course
        'site_name' => config('app.name'),
        'favicon' => asset('images/book-cover.jpg'),
    ])
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:url" content="https://eureka.vixblock.com.ng"> <!-- URL of your page -->

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{ asset('js/turnjs4/lib/turn.min.js') }}"></script>
    <script src="{{ asset('js/turnjs4/samples/steve-jobs/css/steve-jobs.css') }}"></script>


    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/x6auh8olnumk10tisxqju525r0wxv1090lf5sgu8p86sdw0w/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    <link rel="stylesheet" href="{{ asset('build/assets/app-a461d729.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-e4c7b08b.css ') }}">

    @yield('styles')


    @livewireStyles
    @livewireScripts
    <style>
        #flipbook a {
            color: #007bff;
            /* Change this color to your desired default link color */
            text-decoration: underline;
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

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-50">
        <x-pre-loader />
        <x-header />
        <x-sidebar />

        <div class="content ml-12  ease-in-out duration-500 pt-20 pb-4 ">
            <main>
                {{ $slot }}
            </main>
        </div>





        <script>
            const sidebar = document.querySelector("aside");
            const maxSidebar = document.querySelector(".max")
            const miniSidebar = document.querySelector(".mini")
            const roundout = document.querySelector(".roundout")
            const maxToolbar = document.querySelector(".max-toolbar")
            const logo = document.querySelector('.logo')
            const content = document.querySelector('.content')
            const moon = document.querySelector(".moon")
            const sun = document.querySelector(".sun")

            function setDark(val) {
                if (val === "dark") {
                    document.documentElement.classList.add('dark')
                    moon.classList.add("hidden")
                    sun.classList.remove("hidden")
                } else {
                    document.documentElement.classList.remove('dark')
                    sun.classList.add("hidden")
                    moon.classList.remove("hidden")
                }
            }

            function openNav() {
                if (sidebar.classList.contains('-translate-x-48')) {
                    // max sidebar 
                    sidebar.classList.remove("-translate-x-48")
                    sidebar.classList.add("translate-x-none")
                    maxSidebar.classList.remove("hidden")
                    maxSidebar.classList.add("flex")
                    miniSidebar.classList.remove("flex")
                    miniSidebar.classList.add("hidden")
                    maxToolbar.classList.add("translate-x-0")
                    maxToolbar.classList.remove("translate-x-24", "scale-x-0")
                    logo.classList.remove("ml-12")
                    content.classList.remove("ml-12")
                    content.classList.add("ml-12", "md:ml-60")
                } else {
                    // mini sidebar
                    sidebar.classList.add("-translate-x-48")
                    sidebar.classList.remove("translate-x-none")
                    maxSidebar.classList.add("hidden")
                    maxSidebar.classList.remove("flex")
                    miniSidebar.classList.add("flex")
                    miniSidebar.classList.remove("hidden")
                    maxToolbar.classList.add("translate-x-24", "scale-x-0")
                    maxToolbar.classList.remove("translate-x-0")
                    logo.classList.add('ml-12')
                    content.classList.remove("ml-12", "md:ml-60")
                    content.classList.add("ml-12")

                }
            }
        </script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script src="{{ asset('js/share.js') }}"></script>
        <script src="{{ asset('build/assets//app-dd6eec69.js') }}" defer></script>

        {{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script> --}}

</body>

</html>
