<x-app-layout>
    <div class="bg-white px-10 pt-20">
        <div class=" w-ful md:w-[80%]">
            <a href="{{ route('content-planner.index') }}" class="text-xs font-bold text-gray-700 ">
                <i class='bx bx-chevron-left mr-2'></i> Show saved content
            </a>
        </div>


        <section class="mt-20 w-[70%] mx-auto">
            <div class="flex justify-between py-3">
                <div>
                    <a href="{{ route('courses.edit', ['course' => $course->id]) }}">
                        <button class=" py-2 px-5 border border-yellow-800/100 rounded-md text-xs">
                            <i class='bx bx-eyes mr-2 '></i> Module view 
                        </button>
                    </a>
                    <a href="{{ route('courses.show', ['course' => $course->slug]) }}" target="_blank">
                        <button class=" py-2 px-5 border border-yellow-800/100 rounded-md text-xs">
                            <i class='bx bx-eyes mr-2 '></i> Doc view
                        </button>
                    </a>
                </div>
                <div>
                    <input type="text">
                    <input type="text">
                </div>
            </div>
            <div class="flex  mb-3">
                <x-main-button class=" py-1 px-4" onClick="document.getElementById('myForm').submit()" class="">
                    <i class='bx bx-save px-2 text-md'></i>
                </x-main-button>
                <button class="py-1 px-4 rounded-md bg-transparent border mx-3 text-red-500 border-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </button>
                <div class="text-gray-700">
                    <button>
                        <i class='bx bx-copy pl-1 text-xl'></i>
                    </button>
                    <button>
                        <i class='bx bxs-file-export pl-1 text-xl'></i>
                    </button>
                    <button>
                        <i class='bx bxs-file-doc pl-1 text-xl'></i>
                    </button>
                </div>
            </div>

            <div> <input type="text text-2xl font-bold text-gray-700" class="w-full shadow-md focus:ring-0 border-gray-200 my-1 p-3"
                    value="{{ $course->title }}"></div>
            @foreach ($course->lessons as $lesson)
                <x-course-lesson :lesson="$lesson" :key="$lesson->id"></x-course-lesson>
            @endforeach

        </section>
    </div>
</x-app-layout>
