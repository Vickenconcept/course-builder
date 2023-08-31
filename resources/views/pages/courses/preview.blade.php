<x-app-layout>
    <div x-data="{ openShare: false }">
        <div class="text-right px-5  ">
            <button @click="openShare = true" class=" text-gray-700 hover:text-gray-500 px-3 mr-2">
                <i class='bx bxs-share-alt text-xl'></i>
            </button>
        </div>
        <div id="flipbook" class="">
            <div
                class=" hard front-cover  bg-gray-300 rounded-tr-lg rounded-br-lg  text-gray-700 text-center  border border-gray-700 shadow-md object-cover overflow-hidden">
                <img src="https://images.unsplash.com/photo-1553530979-7ee52a2670c4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxzZWFyY2h8MXx8bmF0dXJhbHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=600&q=60"
                    alt="image" class="w-full h-full">
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
            @foreach ($course->lessons as $lesson)
                <section class=" py-2 bg-white px-5 transition duration-700">
                    <h3 class="font-semibold capitalize py-2 text-sm">{{ $loop->iteration }}.
                        {{ $lesson->title }}
                    </h3>
                    <p class="text-xs">{!! $lesson->content !!}</p>
                </section>
            @endforeach
            <section class="hard bg-white flex  items-center  justify-center  text-white rounded-tr-lg rounded-br-lg">

            </section>
            <section
                class="hard bg-gray-500 flex j items-center  justify-center  text-white rounded-tr-lg rounded-br-lg">
                Powered By @Supreme Web</section>
            {{-- <div class="hard bg-gray-500 rounded-tr-lg rounded-br-lg"></div> --}}
            <div class=" hard back-cover bg-gray-300  text-gray-700 text-center rounded-tr-lg rounded-bl-lg">
                Back Cover Content
            </div>
        </div>

        <div class="text-center" id="controls">
            <button id="previousButton"
                class="bg-yellow-500 text-white shadow-sm hover:shadow-md rounded-full py-1 px-2 "><i
                    class='bx bx-chevron-left text-2xl'></i></button>
            <button id="nextButton"
                class="bg-yellow-500 text-white shadow-sm hover:shadow-md rounded-full py-1 px-2 ronded"><i
                    class='bx bx-chevron-right text-2xl'></i></button>

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
                                {{ route('courses.share', ['course_slug' => $course->slug]) }}</p>
                            <button onclick="toCopy(document.getElementById('{{ $course->id }}'))"
                                class="rounded-lg bg-yellow-500 px-3 py-2 mt-5 text-white text-xs shadow-sm hover:shadow-md ">Copy
                                Clipboard</button>
                            <xmp id="{{ $course->slug }}"
                                class="w-full rounded-lg border text-sm border-gray-700 mt-5 overflow-auto text-left"
                                style="visbility:hidden">
                                <iframe src="{{ route('courses.share', ['course_slug' => $course->slug]) }}"
                                    width="600" height="400">
                                </iframe>
                            </xmp>
                            <button onclick="toCopy(document.getElementById('{{ $course->slug }}'))"
                                class="rounded-lg bg-yellow-500 px-3 py-2 mt-5 text-white text-xs shadow-sm hover:shadow-md ">Copy
                                Copy embeaded code</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



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
            // console.log($("#flipbook"));

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
</x-app-layout>
