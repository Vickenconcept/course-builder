@seo([
    'title' => $course->title,
    'description' => $course->description,
    'image' => asset($course->course_image),
    'type' => 'article',
    'url' => route('courses.share', ['courseId' => $course->id, 'course_slug' => $course->slug]),
])


<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<x-guest-layout>
    <div x-data="{ darkMode: false }" class="body">
        <div class="float z-50 bg-white rounded-full p-2">
            <button id="previousButton" class=" hover:shadow-sm rounded-full py-1 px-2 " @click="darkMode = true"><i
                    class='bx bxs-moon'></i></button>
            <button id="previousButton" class=" hover:shadow-sm rounded-full py-1 px-2 " @click="darkMode = false"><i
                    class='bx bxs-sun'></i></button>
        </div>



        <x-notification />

        <div style="background-image: url('{{ asset($course->course_image) }}');"
            class="bg-cover bg-no-repeat w-full bg-center min-h-screen pt-10">
            <div class="  mx-auto w-full md:w-[80%]  ">



                <div class="container py-10  ">
                    <div id="myCarousel" class="carousel slide   border-4  rounded-xl  overflow-auto  bg-white "
                    data-interval="false" style=" height:550px " :class="{ 'dark': darkMode }">

                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            @foreach ($course->lessons as $key => $lesson)
                                <li data-target="#myCarousel" data-slide-to="{{ $key }}"
                                    @if ($key === 0) class="active" @endif></li>
                            @endforeach
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner pt-20 px-10 h-full  ">
                            {{--  --}}

                            <div class="item  carousel-item active h-full">
                                <div class="font-bold my-5 capitalize title flex justify-center items-center h-full">
                                    <div class="space-y-2">
                                        <span> {{ $course->title }}</span>
                                        <div style="background-image: url('{{ asset($course->course_image) }}'); height: 300px; width:400px"
                                            class="bg-cover bg-no-repeat w-full bg-center pt-20 rounded-xl"></div>
                                    </div>
                                </div>
                            </div>
                            <section class=" item  carousel-item   pt-4 capitalize  px-5  even  overflow-auto">

                                <h4 class="font-semibold my-5 text-md title"> Introduction:</h4>
                                <p class="   text-justify my-3 text-3xl  overflow-auto" style="line-height: 40px;">
                                    {{ $course->description }}
                                </p>

                            </section>
                            <section class=" item  carousel-item  pt-4 capitalize  px-5  even">
                                <h3 class="font-semibold my-5 title ">Outline:</h3>
                                <ol class="">
                                    @foreach ($course->lessons as $lesson)
                                        <li class="py-2 text-3xl " style="line-height: 30px;"> {{ $loop->iteration }}.
                                            {{ $lesson->title }}</li>
                                    @endforeach
                                </ol>
                            </section>
                            @if ($isSubscribed)
                                @foreach ($course->lessons as $key => $lesson)
                                    <div class=" item  carousel-item h-full pt-10 overflow-auto ">
                                        <p class="  title">{{ $lesson->title }}</p>
                                        {!! $lesson->content !!}

                                    </div>
                                @endforeach
                            @elseif ($course->courseSettings->checkout_option === 'share' && $hasIpAddressAccess)
                                @foreach ($course->lessons as $key => $lesson)
                                    <div class=" item  carousel-item h-full pt-10 overflow-auto ">
                                        <p class="  title">{{ $lesson->title }}</p>
                                        {!! $lesson->content !!}

                                    </div>
                                @endforeach
                            @else
                                @foreach ($course->lessons as $key => $lesson)
                                    @if ($loop->iteration <= $freeCourse)
                                        <div class=" item  carousel-item h-full pt-10 overflow-auto ">
                                            <p class="  title">{{ $lesson->title }}</p>
                                            {!! $lesson->content !!}

                                        </div>
                                    @endif
                                @endforeach
                                @if (count($course->lessons) > $freeCourse)
                                    <section class="item  h-full">
                                        <div class="flex justify-center items-center h-full">
                                            <div class=" text-center">
                                                <h1 class="title font-bold my-5"> "Unlock a World of Knowledge – Click
                                                    Here to Explore
                                                    More!"</h1>
                                                <a href="{{ route('subscribe.show', ['subscribe' => $course->id]) }}">
                                                    <button id="showAllLessonsButton"
                                                        class=" inline-flex animate-pulse items-center  text-green-50 px-3 border text-center  rounded-md bg-gray-900 hover:shadow-lg transition duration-300 py-2 font-semibold   disabled:opacity-25  ease-in-out">
                                                        Click to read more <i
                                                            class='bx bx-chevrons-right  animate-ping'></i>
                                                    </button>

                                                </a>
                                            </div>
                                        </div>
                                    </section>
                                @endif
                            @endif
                            <a class="left carousel-control z-10" href="#myCarousel" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control z-10" href="#myCarousel" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Next</span>
                            </a>

                            {{--  --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</x-guest-layout>

{{-- </html> --}}
