<x-guest-layout>
    {{-- <div class="w-[70%] mx-auto bg-white pt-5" x-data="{ isOpen: false }">
        <div class="m-20   px-1 text-gray-700">

            <section class="  py-5 capitalize">
                <h1 class="font-bold text-2xl my-5 capitalize"> Title: {{ $course->title }}</h1>
                <h4 class="font-semibold my-5 text-md"> Introduce:</h4>
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





            @if ($isSubscribed)
                @foreach ($course->lessons as $lesson)
                    <section class="my-5 py-10">
                        <h3 class="font-semibold capitalize py-5 text-md">{{ $loop->iteration }}.
                            {{ $lesson->title }}
                        </h3>
                        {!! $lesson->content !!}
                    </section>
                @endforeach
            @else
                @foreach ($course->lessons as $lesson)
                    @if ($loop->iteration <= $freeCourse)
                        <section class="my-5 py-10">
                            <h3 class="font-semibold capitalize py-5 text-md">{{ $loop->iteration }}.
                                {{ $lesson->title }}
                            </h3>
                            {!! $lesson->content !!}
                        </section>
                    @endif
                @endforeach
 
                @if (count($course->lessons) > $freeCourse)

                    <section class=" py-10 flex justify-center">
                        <a href="{{ route('subscribe.show', ['subscribe' => $course->id]) }}">
                            <x-main-button id="showAllLessonsButton" class="">
                                Show All Lessons
                            </x-main-button>
                        </a>


                    </section>
                @endif
            @endif
            <div>

            </div>

            


        </div>
    </div> --}}
    <div>
        <div class=" py-10 flex justify-center">
            {{--  --}}
            <div id="flipbook" class="">
                <div
                    class=" hard front-cover  bg-gray-300 rounded-tr-lg rounded-br-lg  text-gray-700 text-center  border border-gray-700 shadow-md object-cover overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1553530979-7ee52a2670c4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxzZWFyY2h8MXx8bmF0dXJhbHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=600&q=60" alt="image" class="w-full h-full">
                </div>
                <div class="hard  bg-gray-500 rounded-tl-lg rounded-bl-lg shadow-md"></div>

                <section class="  py-2 capitalize bg-white px-5 transition duration-700 shadow-md">
                    <h1 class="font-bold text-xl my-5 capitalize"> Title: {{ $course->title }}</h1>
                    <h4 class="font-semibold my-5 text-md"> Introduce:</h4>
                    <p class="  text-xs  text-justify my-3">
                        {{ $course->description }}
                    </p>

                </section>
                <section class="  py-2 capitalize bg-white px-5 transition duration-700 shadow-md">
                    <h3 class="font-semibold my-5">Outline:</h3>
                    <ol class="text-xs">
                        @foreach ($course->lessons as $lesson)
                            <li class="py-2"> {{ $loop->iteration }}. {{ $lesson->title }}</li>
                        @endforeach
                    </ol>
                </section>
                @if ($isSubscribed)
                    @foreach ($course->lessons as $lesson)
                        <section class=" py-2 bg-white px-5 transition duration-700">
                            <h3 class="font-semibold capitalize py-2 text-sm">{{ $loop->iteration }}.
                                {{ $lesson->title }}
                            </h3>
                            <p class="text-xs">{!! $lesson->content !!}</p>
                        </section>
                    @endforeach
                @else
                    @foreach ($course->lessons as $lesson)
                        @if ($loop->iteration <= $freeCourse)
                            <section class=" py-2 bg-white px-5 transition duration-700">
                                <h3 class="font-semibold capitalize py-2 text-sm">{{ $loop->iteration }}.
                                    {{ $lesson->title }}
                                </h3>
                                <p class="text-xs">{!! $lesson->content !!}</p>
                            </section>
                        @endif
                    @endforeach
                    {{-- Show the regular content for non-subscribed users --}}
                    @if (count($course->lessons) > $freeCourse)
                        <!-- Add a section or button to show all lessons -->
                        <section class=" py-2 flex justify-center items-center bg-white px-5">
                           <div class=" text-center">
                            <h1 class="text-xl font-bold my-5">Love the Course</h1>
                            {{-- <p class="animate-bounce py-2"><i class='bx bx-chevrons-down'></i></p> --}}
                            <a href="{{ route('subscribe.show', ['subscribe' => $course->id]) }}">
                                <x-main-button id="showAllLessonsButton" class=" inline-flex">
                                    Click to read more <i class='bx bx-chevrons-right animate-pulse'></i>
                                </x-main-button>
                                <x-main-button id="showAllLessonsButton" class=" inline-flex">
                                    Click to read more <i class='bx bx-chevrons-right animate-ping'></i>
                                </x-main-button>
                            </a>
                           </div>


                        </section>
                    @endif
                @endif
                <section
                    class="hard bg-gray-500 flex j items-center  justify-center  text-white rounded-tr-lg rounded-br-lg">
                    Powered By @vicxblock</section>
                <section
                    class="hard bg-gray-500 flex j items-center  justify-center  text-white rounded-tr-lg rounded-br-lg">
                    Powered By @vicxblock</section>
                {{-- <div class="hard bg-gray-500 rounded-tr-lg rounded-br-lg"></div> --}}
                <div class=" hard back-cover bg-gray-300  text-gray-700 text-center rounded-tr-lg rounded-bl-lg">
                    Back Cover Content
                </div>
            </div>
        </div>
        <div class="text-center">
            <button id="previousButton" class="bg-yellow-500 text-gray-700 shadow-sm hover:shadow-md rounded-full py-1 px-2 "><i class='bx bx-chevron-left text-4xl'></i></button>
            <button id="nextButton" class="bg-yellow-500 text-gray-700 shadow-sm hover:shadow-md rounded-full py-1 px-2 ronded"><i class='bx bx-chevron-right text-4xl'></i></button>
        </div>
    </div>
</x-guest-layout>
