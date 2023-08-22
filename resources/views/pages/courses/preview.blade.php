<x-app-layout>
    <div class="ml-20"></div>
    
    
    
    <div class=" w-[70%] mx-auto bg-white pt-5">
        <div x-data="{ openShare: false }">
            <div class="flex justify-end ">
                <x-dropdown align="right">
                    <x-slot name="trigger">
                        <button class="   px-2 py-1  shadow-sm text-xs text-right">
                            <span class="">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                </svg></span>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link class="cursor-pointer">
                            <button @click="openShare = true"
                                class=" bg-yellow-500 text-white shadow-sm hover:shadow:md px-3 mr-2">
                                Share
                            </button>
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
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
                                {{ route('courses.share', ['course_slug' => $course->slug]) }}</p>
                            <button onclick="toCopy(document.getElementById('{{ $course->id }}'))"
                                class="rounded-lg bg-yellow-500 px-3 py-2 mt-5 text-white text-xs shadow-sm hover:shadow-md ">Copy
                                Clipboard</button>
                            <xmp id="{{ $course->slug }}"
                                class="w-full rounded-lg border text-sm border-gray-700 mt-5 overflow-auto text-left" style="visbility:hidden">
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

        <div class="m-20   px-1 text-gray-700">
            <section class="  py-5 capitalize">
                <h1 class="font-bold text-2xl my-5 capitalize"> Title: {{ $course->title }}</h1>
                <h4 class="font-semibold my-5 text-xl"> Introduce:</h4>
                <p class="  text-sm  text-justify my-3">
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
                    <h3 class="font-semibold capitalize py-5 text-xl">{{ $loop->iteration }}. {{ $lesson->title }}
                    </h3>

                    {!! $lesson->content !!}
                </section>
            @endforeach

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
        }
    </script>
</x-app-layout>
