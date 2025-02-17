<x-app-layout>
    <div class="bg-gray-50 px-4 py-10" x-data="{ childIsOpen: false, openShare: false, openCreate: false }">
        <div class=" w-full md:w-[80%]">
            <a href="{{ route('content-planner.index') }}"
                class="text-xs font-bold block text-gray-700 mb-3 hover:underline">
                <i class='bx bx-chevron-left mr-2'></i> Back to Content planner
            </a>
        </div>
        <section class="mt-20 w-full md:w-[70%] mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 py-3">
                <div class="col-span-2">
                    <a href="{{ route('courses.share', ['courseId' => $course->id, 'course_slug' => $course->slug]) }}"
                        target="_blank">
                        <button
                            class=" hover:bg-[#9fdfbf] bg-white shadow-inner hover:shadow-md transition duration-300 py-2 px-5 border border-[#339966] rounded-md text-xs">
                            Preview
                        </button>
                    </a>
                </div>
                <div class="col-span-1 py-3">
                    <form action="{{ route('courses.courseImage', ['image' => $course->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div x-data="{ upload_type: 'upload' }">
                            <div class="flex justify-center mb-5">
                                <button type="button" class="whitespace-nowrap flex flex-wrap"
                                    x-show="upload_type == 'upload'" style="display: none">
                                    <span
                                        class="uppercase text-white border border-[#39ac73]  bg-[#39ac73] px-5 py-2 rounded-full text-sm block md:-mr-10 z-10"
                                        @click="upload_type = 'upload'">Upload</span>
                                    <span
                                        class="uppercase border border-gray-800 pl-5 md:pl-16 pr-5 py-2  rounded-full text-sm   bg-white flex items-center space-x-2"
                                        @click="upload_type = 'url'">
                                        <span>Image Url</span>
                                    </span>
                                </button>
                                <button type="button" class="whitespace-nowrap flex flex-wrap"
                                    x-show="upload_type == 'url'" style="display: none">
                                    <span
                                        class="uppercase  border  border-gray-800  bg-white  pr-5 md:pr-16 pl-5 py-2 rounded-full text-sm block "
                                        @click="upload_type = 'upload'">Upload</span>
                                    <span
                                        class="uppercase text-white border  border-[#39ac73] bg-[#39ac73] pl-16 px-5 py-2  rounded-full text-sm   md:-ml-10 z-10  flex items-center space-x-2"
                                        @click="upload_type = 'url'">
                                        <span>Image Url</span>
                                    </span>
                                </button>
                            </div>


                            <div class="mb-3" x-show="upload_type == 'upload'" style="display: none">
                                {{-- <input
                                    class="relative m-0 block w-full min-w-0 p-4 flex-auto cursor-pointer rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none  "
                                    id="formFileSm" type="file" name="localImage" /> --}}


                                <label class="block text-sm font-medium text-gray-900 " for="file_input">Upload Book
                                    Cover</label>
                                <div class="flex ">
                                    <input
                                        class="block w-full text-lg text-gray-900 border border-gray-300 rounded-s-lg cursor-pointer bg-gray-50 focus:outline-none "
                                        id="formFileSm" type="file" name="localImage">
                                    <button type="submit"
                                        class="text-white rounded-e-lg bg-slate-700 hover:bg-slate-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium  text-sm px-4 py-2 ">Save</button>
                                </div>
                                <small class="truncate w-52 block">image: {{ $course->course_image }}</small>

                            </div>
                            <div class="relative " x-show="upload_type == 'url'" style="display: none">
                                <label class="block text-sm font-medium text-gray-900 " for="file_input">Upload Book
                                    Cover</label>
                               <div class="flex ">
                                <input type="search" id="default-search"
                                class="block w-full p-2 ps-5 text-sm bg-white text-gray-900 border border-gray-300 rounded-s-lg  focus:ring-blue-500 focus:border-blue-500  "
                                value="{{ $course->course_image }}" name="courseImage" placeholder="image url"
                                autocomplete="off" />
                            <button type="submit"
                                class="text-white rounded-e-lg bg-slate-700 hover:bg-slate-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium  text-sm px-4 py-2 ">Save</button>
                               </div>
                               <small class="truncate w-52 block">image: {{ $course->course_image }}</small>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
            <div class="flex  mb-3">
                <x-main-button class=" py-1 px-4" class="">
                    <i class='bx bx-loader-alt px-2 text-md animate-spin'></i>
                </x-main-button>
                <form id="delete-form-{{ $course->id }}"
                    action="{{ route('courses.destroy', ['course' => $course->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="py-1 px-4 rounded-md bg-white shadow-inner hover:shadow-md border mx-3 text-red-500 border-red-500 hover:bg-red-300 transition duration-300">
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

                    <a href="{{ route('course-setting.show', ['course_setting' => $course->id]) }}"><i
                            class='bx bx-cog text-xl hover:text-gray-500 transition duration-300'></i></a>
                    <button @click="openShare = true">
                        <i class='bx bxs-share-alt text-xl hover:text-gray-500 transition duration-300'></i>
                    </button>
                </div>
            </div>

            <div id="formContent">
                <div class=" mt-5">
                    <h1 class="font-bold text-xl text-gray-700">Course Topic</h1>
                    <form action="{{ route('courses.update', ['course' => $course->id]) }}" method="POST"
                        class="w-full">
                        @csrf
                        @method('PUT')
                        <div class="relative ">
                            <input type="search" id="default-search"
                                class="block w-full p-4 ps-5 text-sm bg-white text-gray-900 border border-gray-300 rounded-lg  focus:ring-blue-500 focus:border-blue-500  "
                                placeholder="Course title" value="{{ $course->title }}" name="updateTitle" />
                            <button type="submit"
                                class="text-white absolute end-2.5 bottom-2.5 bg-slate-700 hover:bg-slate-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 ">Save</button>
                        </div>
                    </form>
                </div>
                <div class=" mt-5">
                    <h1 class="font-semibold text-xl text-gray-700">Course Overview</h1>
                    <form action="{{ route('courses.updateDescription', ['course' => $course->id]) }}" method="POST"
                        class="w-full">
                        @csrf
                        @method('PUT')
                        {{-- <textarea type="text" rows="5"
                            class="w-full shadow-md focus:ring-0 resize-none border-gray-200 my-1 p-3 placholder-gray-700 placeholder:font-bold placeholder:uppercase rounded-md"
                            name="updateDescription">
                            {{ $course->description }}
                        </textarea> --}}

                        <div class="relative ">
                            <input type="search" id="default-search"
                                class="block w-full p-4 ps-5 text-sm bg-white text-gray-900 border border-gray-300 rounded-lg  focus:ring-blue-500 focus:border-blue-500  "
                                placeholder="Course description" value="{{ $course->description }}"
                                name="updateDescription" />
                            <button type="submit"
                                class="text-white absolute end-2.5 bottom-2.5 bg-slate-700 hover:bg-slate-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 ">Save</button>
                        </div>
                    </form>
                </div>

                <div class="flex justify-end my-5">
                    <button @click="childIsOpen = true"
                        class=" hover:bg-[#9fdfbf] bg-white shadow-inner hover:shadow-md transition duration-300 py-2 px-5 border border-[#339966] rounded-md text-xs">
                        Expand all
                    </button>
                    <button @click="childIsOpen = false"
                        class="hover:bg-[#9fdfbf] bg-white shadow-inner hover:shadow-md transition duration-300 py-2 px-5 ml-2 border border-[#339966] rounded-md text-xs">
                        Collaps all
                    </button>
                </div>
                @foreach ($course->lessons as $lesson)
                    <x-course-lesson :lesson="$lesson" :key="$lesson->id" x-data="{ open: childIsOpen }"></x-course-lesson>
                @endforeach
            </div>

            <div class="py-3">


                <button type="submit" @click="openCreate = true"
                    class="py-1 px-4 rounded-md bg-white shadow-inner hover:shadow-md border text-[#339966] border-[#339966] hover:bg-[#9fdfbf] transition duration-300">
                    + Add Module
                </button>

            </div>

        </section>


        {{-- mmodal --}}

        <div x-show="openCreate"
            class="fixed z-[60] inset-0 overflow-y-auto bg-gray-500/50 transform  transition-all  duration-700 "
            style="display: none">
            <div class="flex items-center justify-center min-h-screen px-10">
                <div class="bg-white w-[90%] md:w-[50%] rounded-lg overflow-hidden pb-6 transition-all relative duration-700"
                    @click.away="openCreate = false">
                    <div class="p-5">
                        <h1 class="text-gray-700">Add Module</h1>
                        <form id="" action="{{ route('courses.store') }}" method="POST">
                            @csrf

                            <div>
                                <input type="hidden" name="course_id" value=" {{ $course->id }}">
                                <input type="text "
                                    class="  focus:ring-0  my-1 p-2 placholder-gray-300 placeholder:italic  border border-[#339966] rounded-md w-full"
                                    value="" name="title" placeholder="Enter title" autocomplete="off">
                            </div>
                            <button type="submit"
                                class="rounded-lg bg-[#339966] px-3 py-2 mt-5 text-white text-xs shadow-sm hover:shadow-md ">
                                Create</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>



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
                            {{ route('courses.share', ['courseId' => $course->id, 'course_slug' => $course->slug]) }}
                        </p>
                        <button onclick="toCopy(document.getElementById('{{ $course->id }}'))"
                            class="rounded-lg bg-[#339966] px-3 py-2 mt-5 text-white text-xs shadow-sm hover:shadow-md ">Copy
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
                            class="rounded-lg bg-[#339966] px-3 py-2 mt-5 text-white text-xs shadow-sm hover:shadow-md ">Copy
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
