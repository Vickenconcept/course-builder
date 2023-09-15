<x-guest-layout>
    <div x-data="{ openShare: false }">
        {{--  --}}
        @seo([
            'title' => $course->title,
            'description' => $course->description,
            'image' => asset($course->course_image),
            'type' => 'article',
            'url' => route('courses.share', ['courseId' => $course->id, 'course_slug' => $course->slug]),
        ])

        <div class="w-full flex justify-center items-center pt-10">
            <div id="flipbook" class="sj-book">
                {{-- <div
                class=" hard front-cover  bg-gray-300 rounded-tr-lg rounded-br-lg  text-gray-700 text-center  border border-gray-700   object-cover">
                <img src="{{ asset($course->course_image) }}" alt="image" class="w-full object-cover">
            </div> --}}
                <div
                    class="hard front-cover bg-gray-300 rounded-tr-lg rounded-br-lg text-gray-700 text-center border border-gray-700 ">
                    <div class="bg-cover bg-no-repeat w-full bg-center h-full"
                        style="background-image: url('{{ asset($course->course_image) }}');"></div>
                </div>
                <div class="hard  bg-gray-500 rounded-tl-lg rounded-bl-lg "></div>

                <section class="  pt-4 capitalize bg-white px-5   even">
                    <h1 class="font-bold text-xl my-5 capitalize"> Title: {{ $course->title }}</h1>
                    <h4 class="font-semibold my-5 text-md"> Introduce:</h4>
                    <p class="  text-xs  text-justify my-3">
                        {{ $course->description }}
                    </p>

                </section>
                <section class="  pt-4 capitalize bg-white px-5   even">
                    <h3 class="font-semibold my-5">Outline:</h3>
                    <ol class="text-xs">
                        @foreach ($course->lessons as $lesson)
                            <li class="py-2"> {{ $loop->iteration }}. {{ $lesson->title }}</li>
                        @endforeach
                    </ol>
                </section>
                @if ($isSubscribed)
                    @foreach ($course->lessons as $lesson)
                        <section class=" pt-4 bg-white px-5  even">
                            <h3 class="font-semibold capitalize pt-4 text-sm">{{ $loop->iteration }}.
                                {{ $lesson->title }}
                            </h3>
                            <p class="text-xs">{!! $lesson->content !!}</p>
                        </section>
                    @endforeach
                @elseif ($course->courseSettings->checkout_option === 'share' && $hasIpAddressAccess)
                    {{-- this is the share page --}}
                    @foreach ($course->lessons as $lesson)
                        <section class=" pt-4 bg-white px-5  even">
                            <h3 class="font-semibold capitalize pt-4 text-sm">{{ $loop->iteration }}.
                                {{ $lesson->title }}
                            </h3>
                            <p class="text-xs">{!! $lesson->content !!}</p>
                        </section>
                    @endforeach
                @else
                    @foreach ($course->lessons as $lesson)
                        @if ($loop->iteration <= $freeCourse)
                            <section class=" pt-4 bg-white px-5  even">
                                <h3 class="font-semibold capitalize pt-4 text-sm">{{ $loop->iteration }}.
                                    {{ $lesson->title }}
                                </h3>
                                <p class="text-xs">{!! $lesson->content !!}</p>
                            </section>
                        @endif
                    @endforeach
                    {{-- Show the regular content for non-subscribed users --}}
                    @if (count($course->lessons) > $freeCourse)
                        <!-- Add a section or button to show all lessons -->
                        <section class=" pt-4 flex justify-center items-center bg-white px-5 even">
                            <div class=" text-center">
                                <h1 class="text-xl font-bold my-5"> "Unlock a World of Knowledge – Click Here to Explore
                                    More!"</h1>
                                {{-- <p class="animate-bounce pt-4"><i class='bx bx-chevrons-down'></i></p> --}}
                                <a href="{{ route('subscribe.show', ['subscribe' => $course->id]) }}">
                                    <x-main-button id="showAllLessonsButton" class=" inline-flex animate-pulse">
                                        Click to read more <i class='bx bx-chevrons-right  animate-ping'></i>
                                    </x-main-button>

                                </a>
                            </div>
                        </section>
                    @endif
                @endif
                <section
                    class="hard bg-white flex  items-center  justify-center  text-white rounded-tr-lg rounded-br-lg even">
                </section>
                <section
                    class="hard bg-gray-500 flex j items-center  justify-center  text-white rounded-tr-lg rounded-br-lg even">
                </section>
                {{-- <div class="hard bg-gray-500 rounded-tr-lg rounded-br-lg"></div> --}}
                <div class=" hard back-cover bg-gray-300  text-gray-700 text-center rounded-tr-lg rounded-bl-lg ">
                    {{-- Back Cover Content --}}
                </div>
            </div>
        </div>
        <div class="  text-center" id="controls">
            <button id="previousButton"
                class="bg-yellow-500 text-white shadow-sm hover: rounded-full py-1 px-2 "><i
                    class='bx bx-chevron-left text-2xl'></i></button>
            <button id="nextButton"
                class="bg-yellow-500 text-white shadow-sm hover: rounded-full py-1 px-2 ronded"><i
                    class='bx bx-chevron-right text-2xl'></i></button>
        </div>

        {{-- <button
            class="px-5 pt-4 rounded-full text-white shadow-sm hover: bg-blue-500 hover:bg-blue-600 transition duration-300 "
            @click="openShare = true">
            Share
        </button> --}}


        {{-- <div x-show="openShare"
            class="fixed z-[60] inset-0 overflow-y-auto bg-gray-500/50 transform  transition-all  duration-700 "
            style="display: none">
            <div class="flex items-center justify-center min-h-screen px-10">
                <div class="bg-white w-[90%] md:w-[50%] rounded-lg overflow-hidden pb-6 transition-all relative duration-700"
                    @click.away="openShare = false">
                    <div class="p-5">
                        <h1 class="text-gray-700 ">Share link to have access</h1>
                        @php
                            // $socialLinks = Share::page(route('courses.share', ['courseId' => $course->id,'course_slug' => $course->slug]))
                            //     ->facebook()
                            //     ->getRawLinks();
                            $socialLinks = Share::page(route('courses.share', ['courseId' => $course->id,'course_slug' => $course->slug]), 'Share title')
                                ->facebook()
                                ->twitter()
                                ->linkedin('Extra linkedin summary can be passed here')
                                ->whatsapp()
                                ->getRawLinks();
                        @endphp
                        <div class="flex justify-around my-5">
                                @foreach ($socialLinks as $platform => $link)
                                @if ($platform == 'facebook')
                                    <a href="{{ $link }}" class="social-button" id="" title="" rel="" target="_blank">
                                        <img src="{{ asset('images/facebook_media.png') }}" alt="" class="w-8 h-8">
                                    </a>
                                @elseif ($platform == 'twitter')
                                    <a href="{{ $link }}" class="social-button" id="" title="" rel="" target="_blank">
                                        <img src="{{ asset('images/twitter_blue.png') }}" alt="" class="w-8 h-8">
                                    </a>
                                @elseif ($platform == 'linkedin')
                                    <a href="{{ $link }}" class="social-button" id="" title="" rel="" target="_blank">
                                        <img src="{{ asset('images/linkedin.png') }}" alt="" class="w-8 h-8">
                                    </a>
                                @elseif ($platform == 'whatsapp')
                                    <a href="{{ $link }}" class="social-button" id="" title="" rel="" target="_blank">
                                        <img src="{{ asset('images/whatsapp.png') }}" alt="" class="w-8 h-8">
                                    </a>
                                @endif
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>


</x-guest-layout>
