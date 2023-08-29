<x-guest-layout>
    <div class="w-[70%] mx-auto bg-white pt-5" x-data="{ isOpen: false }">
        <div class="m-20   px-1 text-gray-700">

            <section class="  py-5 capitalize">
                <h1 class="font-bold text-2xl my-5 capitalize"> Title: {{ $course->title }}</h1>
                <h4 class="font-semibold my-5 text-xl"> Introduce:</h4>
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


            {{-- @foreach ($course->lessons as $lesson)
                <section class="  my-5 py-10 ">
                    <h3 class="font-semibold capitalize py-5 text-xl">{{ $loop->iteration }}. {{ $lesson->title }}</h3>

                    {!! $lesson->content !!}
                </section>
            @endforeach --}}





            @if ($isSubscribed)
                @foreach ($course->lessons as $lesson)
                    <section class="my-5 py-10">
                        <h3 class="font-semibold capitalize py-5 text-xl">{{ $loop->iteration }}.
                            {{ $lesson->title }}
                        </h3>
                        {!! $lesson->content !!}
                    </section>
                @endforeach
            @else
                @foreach ($course->lessons as $lesson)
                    @if ($loop->iteration <= $freeCourse)
                        <section class="my-5 py-10">
                            <h3 class="font-semibold capitalize py-5 text-xl">{{ $loop->iteration }}.
                                {{ $lesson->title }}
                            </h3>
                            {!! $lesson->content !!}
                        </section>
                    @endif
                @endforeach
                {{-- Show the regular content for non-subscribed users --}}
                @if (count($course->lessons) > $freeCourse)
                    <!-- Add a section or button to show all lessons -->
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


                {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

        <main class="grid min-h-screen w-full place-content-center bg-gray-900">
            <div x-data="lessonSlider"
                class="relative mx-auto max-w-2xl overflow-hidden rounded-md bg-gray-100 sm:p-4 p-5">
                <div class="absolute right-5 top-5 z-10 rounded-full bg-gray-600 px-2 text-center text-sm">
                    <span x-text="currentIndex"></span>/<span x-text="lessons.length"></span>
                </div>
                <div class="  mb-10 flex justify-between">

                    <button @click="previous()"
                        class="z-10 ">
                        <i class="fas fa-chevron-left text-2xl font-bold text-gray-500"></i> 
                    </button>

                    <button @click="forward()"
                        class=" z-10 ">
                        <i class="fas fa-chevron-right text-2xl font-bold text-gray-500"></i> 
                    </button>
                </div>

                <div class="relative mt-10 h-80" style="width: 30rem">
                    <template x-for="(lesson, index) in lessons">
                        <div x-show="currentIndex == index + 1" x-transition:enter="transition transform duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="transition transform duration-300"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                            class="absolute top-0">
                            <span x-text="lesson.title" class="text-2xl font-bold"></span>
                            <span x-html="lesson.content"></span>
                        </div>
                    </template>
                </div>
                
               
            </div>
        </main> --}}

                {{-- <script>
            document.addEventListener("alpine:init", () => {
                Alpine.data("lessonSlider", () => ({
                    currentIndex: 1,
                    lessons: @json($course->lessons),
                    freeCourse: @json($freeCourse),
                    previous() {
                        if (this.currentIndex > 1) {
                            this.currentIndex = this.currentIndex - 1;
                        }
                    },
                    forward() {
                        if (this.currentIndex < this.lessons.length) {
                            this.currentIndex = this.currentIndex + 1;
                        }
                    },
                    showLesson(index) {
                        return this.isSubscribed() || index < this.freeCourse;
                    },
                    isSubscribed() {
                       
                    },
                }));
            });
        </script> --}}
            </div>

            <!-- component -->


        </div>
    </div>

</x-guest-layout>
