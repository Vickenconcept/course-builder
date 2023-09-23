<x-app-layout>
    <div class="bg-white px-10 pt-10" x-data="{ childIsOpen: false, openShare: false }">
        <div class=" w-full md:w-[80%]">
            <a href="{{ route('content-planner.index') }}" class="text-xs font-bold block text-gray-700 mb-3 ">
                <i class='bx bx-chevron-left mr-2'></i> Back to Content planner
            </a>
        </div>  
        <section class="mt-20 w-full md:w-[70%] mx-auto">
            <div class="flex justify-between py-3">
                <div>
                    <a href="{{ route('courses.show', ['course' => $course->slug]) }}" target="_blank">
                        <button
                            class=" hover:bg-[#9fdfbf] transition duration-300 py-2 px-5 border border-[#339966] rounded-md text-xs">
                            Preview
                        </button>
                    </a>
                </div>
                <div>
                    <form action="{{ route('courses.courseImage', ['image' => $course->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        {{-- <input type="file" name="localImage" id=""> --}}
                        <div class="mb-3">
                            <input
                              class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                              id="formFileSm"
                              type="file"  name="localImage"/>
                          </div>
                        <input type="text "
                            class="  focus:ring-0 border-gray-200 my-1 p-2 placholder-gray-300 placeholder:italic  border border-[#339966] rounded-md"

                            value="{{ $course->course_image }}"
                             name="courseImage" placeholder="image url" autocomplete="off">
                            <x-main-button type="submit" class="py-3">update</x-main-button>
                    </form>
                </div>


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
                    {{-- <button>
                        <i class='bx bxs-file-export pl-1 text-xl hover:text-gray-500 transition duration-300'></i>
                    </button>
                    <button>
                        <i class='bx bxs-file-doc pl-1 text-xl hover:text-gray-500 transition duration-300'></i>
                    </button> --}}
                    <a href="{{ route('course-setting.show', ['course_setting' => $course->id]) }}"><i
                            class='bx bx-cog text-xl hover:text-gray-500 transition duration-300'></i></a>
                    <button @click="openShare = true">
                        <i class='bx bxs-share-alt text-xl hover:text-gray-500 transition duration-300'></i>
                    </button>
                </div>
            </div>

            <div id="formContent">
                <div>
                    <form action="{{ route('courses.update', ['course' => $course->id]) }}" method="POST"
                        class="w-full">
                        @csrf
                        @method('PUT')
                        <input type="text"
                            class="w-full shadow-md focus:ring-0 border-gray-200 my-1 p-3 placholder-gray-700 placeholder:font-bold placeholder:uppercase"
                            value="{{ $course->title }}" name="updateTitle">
                    </form>
                </div>

                <div class="flex justify-end my-5">
                    <button @click="childIsOpen = true"
                        class=" hover:bg-[#9fdfbf] transition duration-300 py-2 px-5 border border-[#339966] rounded-md text-xs">
                        Expand all
                    </button>
                    <button @click="childIsOpen = false"
                        class="hover:bg-[#9fdfbf] transition duration-300 py-2 px-5 ml-2 border border-[#339966] rounded-md text-xs">
                        Collaps all
                    </button>
                </div>
                @foreach ($course->lessons as $lesson)
                    <x-course-lesson :lesson="$lesson" :key="$lesson->id" x-data="{ open: childIsOpen }"></x-course-lesson>
                @endforeach
            </div>

        </section>




        {{--  --}}

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
                            {{ route('courses.share', ['courseId' => $course->id,'course_slug' => $course->slug]) }}</p>
                        <button onclick="toCopy(document.getElementById('{{ $course->id }}'))"
                            class="rounded-lg bg-yellow-500 px-3 py-2 mt-5 text-white text-xs shadow-sm hover:shadow-md ">Copy
                            Clipboard</button>
                        <xmp id="{{ $course->slug }}"
                            class="w-full rounded-lg border text-sm border-gray-700 mt-5 overflow-auto text-left"
                            style="visbility:hidden">
                            <iframe src="{{ route('courses.share', ['courseId' => $course->id,'course_slug' => $course->slug]) }}" width="600"
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
