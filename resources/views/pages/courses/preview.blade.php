<x-app-layout>
    <div x-data="{ openShare: false }">
        <div class="text-right px-5  ">
            <button @click="openShare = true" class=" text-gray-700 hover:text-gray-500 px-3 mr-2">
                <i class='bx bxs-share-alt text-xl'></i>
            </button>
        </div>
        <div class="w-full flex justify-center items-center">
            <div id="flipbook" class=" sj-book  pt-4 ">
                <div
                    class="hard front-cover bg-gray-300 rounded-tr-lg rounded-br-lg text-gray-700 text-center border border-gray-700   shadow-lg">
                    {{-- <div class="bg-cover bg-no-repeat w-full bg-center h-full" style="background-image: url('{{ asset( 'storage/' . $course->course_image ?? $course->course_image ) }}');"></div> --}}
                    <div class="bg-cover bg-no-repeat w-full bg-center h-full"
                        style="background-image: url('{{ asset($course->course_image) }}')"></div>
                </div>

                <div class="hard  bg-gray-500 rounded-tl-lg rounded-bl-lg even"></div>

                <section class="  pt-4 capitalize bg-white px-5   even ">
                    <h1 class="font-bold text-xl my-5 capitalize"> Title: {{ $course->title }}</h1>
                    <h4 class="font-semibold my-5 text-md"> Introduce:</h4>
                    <p class="  text-xs  text-justify my-3">
                        {{ $course->description }}
                    </p>

                </section>
                <section class="  pt-4 capitalize bg-white px-5   even ">
                    <h3 class="font-semibold my-5">Outline:</h3>
                    <ol class="text-xs">
                        @foreach ($course->lessons as $lesson)
                            <li class="pt-4"> {{ $loop->iteration }}. {{ $lesson->title }}</li>
                        @endforeach
                    </ol>
                </section>
                @foreach ($course->lessons as $lesson)
                    <section class=" pt-4 bg-white px-5  even ">
                        <h3 class="font-semibold capitalize pt-4 text-sm">{{ $loop->iteration }}.
                            {{ $lesson->title }}
                        </h3>
                        <p class="text-xs">{!! $lesson->content !!}</p>
                    </section>
                @endforeach
                <section
                    class="hard bg-white flex  items-center  justify-center  text-white rounded-tr-lg rounded-br-lg">

                </section>
                <section
                    class="hard bg-gray-500 flex j items-center  justify-center  text-white rounded-tr-lg rounded-br-lg even ">
                </section>
                {{-- <div class="hard bg-gray-500 rounded-tr-lg rounded-br-lg"></div> --}}
                <div class=" hard back-cover bg-gray-300  text-gray-700 text-center rounded-tr-lg rounded-bl-lg ">
                    {{-- Back Cover Content --}}
                </div>
            </div>
        </div>

        <div class="text-center" id="controls">
            <button id="previousButton" class="bg-[#339966] text-white shadow-sm hover: rounded-full py-1 px-2 "><i
                    class='bx bx-chevron-left text-2xl'></i></button>
            <button id="nextButton" class="bg-[#339966] text-white shadow-sm hover: rounded-full py-1 px-2 ronded"><i
                    class='bx bx-chevron-right text-2xl'></i></button>

        </div>
        <div x-show="openShare"
            class="fixed z-[60] inset-0 overflow-y-auto bg-gray-500/50 transform  transition-all  duration-700 "
            style="display: none">
            <div class="flex items-center justify-center min-h-screen px-10">
                <div class="bg-white w-[90%] md:w-[50%] rounded-lg overflow-hidden pb-6 transition-all relative duration-700"
                    @click.away="openShare = false">
                    <div class="p-5">
                        <h1 class="text-gray-700">Share Link</h1>
                        <p class="mb-10">Get link to share</p>
                        <p id="{{ $course->id }}" class="w-full rounded-lg p-3 border text-sm border-gray-700 ">
                            {{ route('courses.share', ['courseId' => $course->id, 'course_slug' => $course->slug]) }}
                        </p>
                        <button onclick="toCopy(document.getElementById('{{ $course->id }}'))"
                            class="rounded-lg bg-[#339966] px-3 py-2 mt-5 text-white text-xs shadow-sm hover: ">Copy
                            Clipboard</button>
                        <xmp id="{{ $course->slug }}"
                            class="w-full rounded-lg border text-sm border-gray-700 mt-5 overflow-auto text-left"
                            style="visbility:hidden">
                            <iframe
                                src="{{ route('courses.share', ['courseId' => $course->id, 'course_slug' => $course->slug]) }}"
                                width="600" height="400">
                            </iframe>
                        </xmp>
                        <button onclick="toCopy(document.getElementById('{{ $course->slug }}'))"
                            class="rounded-lg bg-[#339966] px-3 py-2 mt-5 text-white text-xs shadow-sm hover: ">Copy
                            Copy embeaded code</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <style>
        #flipbook {
            -webkit-transition: margin-left 0.2s ease-in-out;
            -moz-transition: margin-left 0.2s ease-in-out;
            -o-transition: margin-left 0.2s ease-in-out;
            -ms-transition: margin-left 0.2s ease-in-out;
            transition: margin-left 0.2s ease-in-out;
        }
    </style>



    <script>
        // for coping text
        function toCopy(copyDiv) {
            var range = document.createRange();
            range.selectNode(copyDiv);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand("copy");
            alert("copied!");
        }

        $("#flipbook").turn({
            width: 1000,
            height: 600,
            autoCenter: true,
            display: 'double', // 'double' is a string, make sure to enclose it in quotes
            acceleration: true,
            elevation: 50, // Corrected property name
            gradients: true, // Enable gradients for more realistic page colors
            duration: 1000, // Duration of the flip animation in milliseconds
            turnCorners: 'tl,tr', // Allow turning from top left and top right corners only
            when: {
                hover: false // Disable page turning when hovering over the pages
            }
        });

        // function checkPage(page) {
        //     if ($("#flipbook").turn("hasPage", page)) {
        //         alert("Page " + page + " is already in the flipbook");
        //     }
        // }

        // // Check if page 1 is in the flipbook

        // checkPage(20);



        // jQuery(document).ready(function($) {

        //     $(window).bind('keydown', function(e) {
        //         if (e.keyCode == 37) {
        //             $("#flipbook").turn('previous');
        //         } else if (e.keyCode == 39) {
        //             $("#flipbook").turn('next');
        //         }
        //     });

        //     $(document).ready(function() {
        //         $("#nextButton").click(function() {
        //             $("#flipbook").turn("next");
        //         });
        //     });
        //     $(document).ready(function() {
        //         $("#previousButton").click(function() {
        //             $("#flipbook").turn("previous");
        //         });
        //     });
        // });


        // const controls = document.getElementById('controls');
        // const flipbook = document.getElementById('flipbook');

        // gsap.set(controls, {
        //     y: '100%',
        //     opacity: 0
        // });

        // flipbook.addEventListener('mouseenter', () => {
        //     gsap.to(controls, {
        //         y: '0%',
        //         opacity: 1,
        //         duration: 0.3
        //     });
        // });
    </script>
</x-app-layout>
