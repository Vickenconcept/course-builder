<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    {{-- <link rel="stylesheet" href="{{ asset('build/assets/app-a461d729.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-541c3f26.css ') }}"> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
   
        <header class=" w-full z-30 flex bg-white  p-2 items-center justify-center h-16 pl-10 pr-5 shadow">
            <!-- SPACER -->
            <div class="grow h-full flex items-center justify-center"></div>
            <div class="flex-none h-full text-center flex items-center justify-center">
        
                <div class="flex space-x-3 items-center px-3 ">
                    <div class="hidden sm:flex">
                        <x-dropdown>
                            <x-slot name="trigger">
                                <i class='bx bx-user px-3 py-3 text-xl cursor-pointer'></i>
                            </x-slot>
        
                            <x-slot name="content">
                                <div class="p-3 text-blue-700"></div>
                                @if (Auth::user())
                                <form method="POST" action="{{ route('auth.logout') }}">
                                    @csrf
                                    <x-dropdown-link href="javascript:void(0)" onclick="this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                                @else
                                <x-dropdown-link :href="route('register')">
                                    {{ __('Register') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('login')">
                                    {{ __('Login') }}
                                </x-dropdown-link>
                                @endif
                            </x-slot>
                        </x-dropdown>
                    </div>
        
                </div>
            </div>
        </header>

    <div class=" p-2 md:px-10">
        <div class=" w-full  flex justify-center items-center text-blue-900">
            <h1 class="font-bold text-2xl">My Courses</h1>
        </div>
    </div>

  <section class="grid grid-cols-1 md:grid-cols-3">
    <div class="w-full">
        <section class="">
            @if (isset($courses))
                @forelse($courses as $course)
                    <a href="{{ route('courses.share', ['courseId' => $course->id,'course_slug' => $course->slug]) }}" target="_blank">
                        <div
                            class="bg-white shadow-md border-b relative rounded p-3 my-4  transition duration-300 ease-in-out">
                            <div class="flex justify-between">
                                <span
                                    class="text-gray-300 text-xs">{{ $course->created_at->toFormattedDayDateString() }}</span>
                                <div class="text-xs underline">
                                    View course
                                </div>

                            </div>

                            <div class="">
                                <h2 class="mb-3 font-bold text-sm text-gray-500"> {{ $course->title }}</h2>
                                <div class="">
                                    <div class="overflow-hidden h-24 line-clamp-3">
                                        @foreach ($course->lessons as $lesson)
                                            <p class="truncate text-gray-500 text-sm">{{ $loop->iteration }}.
                                                {{ $lesson->title }}</p>
                                        @endforeach
                                    </div>

                                </div>
                            </div>

                        </div>
                    </a>
                @empty
                    <div class="bg-white shadow-md border-b rounded p-3 my-2">
                        <p class="text-gray-300">welcome</p>
                        <div class="text-gray-300 py-3">
                            <h1 class="font-semibold text-md capitalize mb-5">No content Available</h1>
                        </div>
                    </div>
                @endforelse
            @endif
        </section>
    </div>
  </section>
    

    <script src="{{ asset('build/assets//app-dd6eec69.js') }}"></script>
</body>
</html>
