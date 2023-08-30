<x-app-layout>
    <div class="bg-white px-10 pt-10" x-data="{ childIsOpen: false, openShare: false }">
        <div class=" w-full md:w-[80%]">
            <a href="{{ route('content-planner.index') }}" class="text-xs font-bold block text-gray-700 mb-3 ">
                <i class='bx bx-chevron-left mr-2'></i> Back to Content planner
            </a>
            {{-- <a href="{{ route('content-planner.index') }}"
                class=" hover:bg-yellow-100 transition duration-300 py-2  px-5 border border-yellow-800/100 rounded-md text-xs">
                Show saved content
            </a> --}}

            {{-- <a href="{{ route('course-setting.show', ['course_setting' => $course->id]) }}" target="_blank">Settings</a> --}}
        </div>


        

        <section class="mt-20 w-full md:w-[70%] mx-auto">
            <div class="flex justify-between py-3">
                <div>
                    <a href="{{ route('courses.edit', ['course' => $course->id]) }}">
                        <button
                            class=" hover:bg-yellow-100 transition duration-300 py-2 px-5 border border-yellow-800/100 rounded-md text-xs">
                            <i class='bx bx-eyes mr-2 '></i> Module view
                        </button>
                    </a>
                    <a href="{{ route('courses.show', ['course' => $course->slug]) }}" target="_blank">
                        <button
                            class=" hover:bg-yellow-100 transition duration-300 py-2 px-5 border border-yellow-800/100 rounded-md text-xs">
                            Preview
                        </button>
                    </a>
                </div>
                {{--  --}}
                <div id="flipbook">
                    <div class="hard"> Turn.js </div>
                    <div class="hard"></div>
                    <div> Page 1 </div>
                    <div> Page 2 </div>
                    <div> Page 3 </div>
                    <div> Page 4 </div>
                    <div class="hard"></div>
                    <div class="hard"></div>
                </div>
                <script type="text/javascript">
                    $("#flipbook").turn({
                        width: 400,
                        height: 300,
                        autoCenter: true
                    });
                </script>
                {{--  --}}
            </div>
            <div class="flex  mb-3">
                <x-main-button class=" py-1 px-4" class="">
                    <i class='bx bx-save px-2 text-md'></i>
                </x-main-button>
                <form id="delete-form-{{ $course->id }}"
                    action="{{ route('courses.destroy', ['course' => $course->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="py-1 px-4 rounded-md bg-transparent border mx-3 text-red-500 border-red-500 hover:bg-red-300 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </button>
                </form>
                <div class="text-gray-700">
                    <button onclick="toCopy(document.getElementById('formContent'))">
                        <i class='bx bx-copy pl-1 text-xl hover:text-gray-500 transition duration-300'></i>
                    </button>
                    <button>
                        <i class='bx bxs-file-export pl-1 text-xl hover:text-gray-500 transition duration-300'></i>
                    </button>
                    <button>
                        <i class='bx bxs-file-doc pl-1 text-xl hover:text-gray-500 transition duration-300'></i>
                    </button>
                    <a href="{{ route('course-setting.show', ['course_setting' => $course->id]) }}" target="_blank"><i
                            class='bx bx-cog text-xl hover:text-gray-500 transition duration-300'></i></a>
                    <button @click="openShare = true">
                        <i class='bx bxs-share text-xl hover:text-gray-500 transition duration-300'></i>
                    </button>
                </div>
            </div>

            <div id="formContent">
                <div>
                    <input type="text text-2xl font-bold text-gray-700 uppercase"
                        class="w-full shadow-md focus:ring-0 border-gray-200 my-1 p-3 placholder-gray-700 placeholder:font-bold placeholder:uppercase"
                        value="{{ $course->title }}">
                </div>

                <div class="flex justify-end my-5">
                    <button @click="childIsOpen = true"
                        class=" hover:bg-yellow-100 transition duration-300 py-2 px-5 border border-yellow-800/100 rounded-md text-xs">
                        Expand all
                    </button>
                    <button @click="childIsOpen = false"
                        class="hover:bg-yellow-100 transition duration-300 py-2 px-5 ml-2 border border-yellow-800/100 rounded-md text-xs">
                        Collaps all
                    </button>
                </div>
                @foreach ($course->lessons as $lesson)
                    <x-course-lesson :lesson="$lesson" :key="$lesson->id" x-data="{ open: childIsOpen }"></x-course-lesson>
                @endforeach
            </div>

        </section>

        <meta property="og:type" content="article">
        <meta property="og:title" content="{{ $course->title }}" />
        <meta property="og:description" content="{{ $course->description }}" />
        <meta property="og:image"
            content="https://images.unsplash.com/photo-1466611653911-95081537e5b7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8ZW52aXJvbm1lbnR8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=600&q=60" />
        <meta property="og:url" content="{{ url("/courses/{$course->id}") }}" />

        {{-- <a href="{{ Share::page('https://eureka.vixblock.com.ng')->linkedin()->getRawLinks() }}" class="social-button" id="" title="" rel="" target="_blank"> --}}
        {{-- <a href="{{ Share::currentPage()->whatsapp()->getRawLinks() }}" class="social-button" id=""
            title="" rel="" target="_blank">
            facebook
        </a> --}}
        <a href="{{ Share::page(route('courses.share', ['course_slug' => $course->slug]) )->whatsapp()->getRawLinks() }}" class="social-button" id=""
            title="" rel="" target="_blank">
            facebook
        </a>
        <br>

{{-- mmodal --}}

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
                            <iframe src="{{ route('courses.share', ['course_slug' => $course->slug]) }}" width="600"
                                height="400">
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
    <x-notification />

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
    </script>
</x-app-layout>
