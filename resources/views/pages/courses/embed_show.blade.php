<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Embeded</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="{{ asset('build/assets/app-a461d729.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-706f5e96.css') }}">
</head>
<body>
    <div class=" mx-auto bg-white pt-5">
        <div class="m-20   px-1 text-gray-700">

            <section class="  py-5 capitalize">
                <h1 class="font-bold text-2xl my-5 capitalize"> Title: {{ $course->title }}</h1>
                <h4 class="font-semibold my-5 text-xl"> Introduce:</h4>
                <p class="  text-md  text-justify my-3">
                    {{ $course->description }}
                </p>
                <h3 class="font-semibold my-5">Outline:</h3>
                <ol>
                    @foreach ($course->lessons as $lesson)
                        <li class="py-2"> {{ $loop->iteration }}. {{ $lesson->title }}</li>
                    @endforeach
                </ol>
            </section>


            @foreach ($course->lessons as $lesson)
                <section class="  my-5 py-10 ">
                    <h3 class="font-semibold capitalize py-5 text-xl">{{ $loop->iteration }}. {{ $lesson->title }}</h3>

                    {!! $lesson->content !!}
                </section>
            @endforeach

        </div>
    </div>
    <script src="{{ asset('build/assets/app-4c5a09cd.js') }}"></script>
</body>
</html>