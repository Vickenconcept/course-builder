<x-app-layout>
    <div class="grid grid-cols-1 md:grid-cols-3  gap-8 p-2 md:px-10 text-gray-700" x-data="{ isOpen: false, isOpen2: false }">
        <div class="w-full" x-data="{ research: '' }">
            <h1 class=" capitalize text-md font-semibold mt-5"><i class="bx bx-book ml-1"></i> My saved Courses</h1>
            <section class="">
                @if (isset($researches))
                    @forelse($researches as $research)
                        <div class="bg-white shadow-md border-b relative rounded p-3 my-4  transition duration-300 ease-in-out cursor-pointer"
                            @click=" isOpen2= true; research = @js($research)">
                            <div class="flex justify-between">
                                <span
                                    class="text-gray-300 text-xs">{{ $research->created_at->toFormattedDayDateString() }}</span>
                                <div class="text-xs ">
                                    <form :id="research.id"
                                        action="{{ route('course-validation.destroy', ['course_validation' => $research->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-bold text-xs">Delete</button>
                                    </form>
                                </div>
                            </div>

                            <div class="">
                                <h2 class="mb-3 font-bold text-sm text-gray-500"> {{ $research->title }}</h2>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="truncate text-gray-500 text-sm">{{ $research->description }}</p>
                                        <p class=" text-gray-500 text-sm">{{ $research->author }}</p>
                                    </div>

                                </div>
                            </div>

                        </div>

                        {{-- modal --}}
                        <div x-show="isOpen2"
                            class="fixed z-[60] inset-0 overflow-y-auto bg-gray-500/50 transform  transition-all  duration-700 -full"
                            style="display: none;">
                            <div class="flex items-center justify-center min-h-screen px-10">
                                <div class="bg-white w-[90%] rounded overflow-hidden pb-6 transition-all relative duration-700"
                                   >
                                    <div>
                                        <button type="button" class=" px-4 pt-3" @click="isOpen2 = false">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>

                                        </button>
                                    </div>
                                    <div class="p-5 overflow-y-auto">
                                        <div class="h-96">
                                            </h2>
                                            <a :href="research.infolink" target="_blank">
                                                <h3 class="my-3 underline text-2xl font-bold" x-text="research.title">
                                                </h3>
                                            </a>

                                            <p x-text="research.description"
                                                class="text-gray-400 text-sm truncate w-[80%]"></p>
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 py-10">
                                                <div>
                                                    <h4 class="font-semibold mb-3">Details</h4>
                                                    <p class=" text-gray-700 my-2"> Instructor: <span class="ml-5 "
                                                            x-text="research.author"></span></p>
                                                    <p class=" text-gray-700 my-2"> Subcategory: <span class="ml-5 "
                                                            x-text="research.category"></span></p>
                                                    {{-- <p class=" text-gray-700 my-2"> Platform: <span class="ml-5 " x-text ="research.author"></span></p> --}}
                                                    <p class=" text-gray-700 my-2"> Niche: <span class="ml-5 "
                                                            x-text="research.category"></span>
                                                    </p>
                                                    <p class=" text-gray-700 my-2"> Topic: <span class="ml-5 "
                                                            x-text="research.title"></span>
                                                    </p>
                                                    <p class=" text-gray-700 my-2"> Subtitle: <span class="ml-5 "
                                                            x-text="research.subtitle"></span></p>
                                                    <p class=" text-gray-700 my-2"> Price: <span class="ml-5 "
                                                            x-text="research.price"></span>
                                                    </p>
                                                    <p class=" text-gray-700 my-2"> Rating: <span class="ml-5 "
                                                            x-text="research.rating"></span>
                                                    </p>
                                                    <p class=" text-gray-700 my-2"> ISBN: <span class="ml-5 "
                                                            x-text="research.isbn"></span></p>
                                                    <p class=" text-gray-700 my-2"> Pages: <span class="ml-5 "
                                                            x-text="research.page_count"></span></p>
                                                </div>
                                                <div>
                                                    <h4 class="font-semibold mb-3">Description</h4>
                                                    <p class=" text-gray-700 my-2"x-text="research.description"></p>
                                                </div>
                                                <div>
                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white shadow-md border-b rounded p-3 my-2">
                            <p class="text-gray-300">welcome</p>
                            <div class="text-gray-300 py-3">
                                <h1 class="font-semibold text-md capitalize mb-5">No content Available</h1>
                            </div>
                        </div>
                    @endforelse
                @endif
            </section>
        </div>

        {{-- books --}}
        <div class="w-full" x-data="{ bookData: '' }">
            <h1 class=" capitalize text-md font-semibold mt-5"><i class="bx bx-book ml-1"></i> My Books</h1>
            <section class="">
                @if (isset($books))
                    @forelse($books as $book)
                        <div class="bg-white shadow-md border-b relative rounded p-3 my-4  transition duration-300 ease-in-out cursor-pointer"
                            @click=" isOpen= true;  bookData = @js($book)">
                            <div class="flex justify-between">
                                <span
                                    class="text-gray-300 text-xs mb-3">{{ $book->created_at->toFormattedDayDateString() }}</span>
                                    <div class="text-xs ">
                                        <form id=""
                                            action="{{ route('books.destroy', ['book' => $book->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-bold text-xs">Delete</button>
                                        </form>
                                    </div>
                            </div>

                            <div class="">
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="overflow-hidden h-32 ">
                                        <img src="{{ $book->image }}" alt="{{ $book->title }}"
                                            class="w-[80%]  object-contain">
                                    </div>
                                    <div class="col-span-2">
                                        <h2 class=" font-bold text-sm text-gray-500"> {{ $book->title }}</h2>
                                        <p class="truncate text-gray-500 text-sm">{{ $book->description }}</p>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <x-main-modal>

                            <div h-full>

                                {{-- <button
                                    class="bg-yellow-400 py-2 my-3 px-4 rounded-lg hover:shadow-md text-white shadow text-xs"
                                    onClick="document.getElementById('myForm').submit()">Save to Library</button> --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 h-full">
                                    <div class="h-full shadow">
                                        <a :href="bookData.infolink" target="_blank"
                                            class=" first-letter:uppercase font-extrabold text-sm underline mt-2 inline "
                                            id="myTitle"><span x-text="bookData.title"></span></a><button
                                            onclick="toCopy(document.getElementById('myTitle')); "><i
                                                class='bx bx-copy ml-1 text-gray-300'></i></button>
                                        <div class="w-20 h-28 overflow-hidden shadow-sm">
                                            <img :src="bookData.image" alt="bookData.title"
                                                class="h-full  object-cover ">
                                        </div>
                                        <div class="grid grid-cols-2">
                                            <div class="grid grid-cols-2 col-span-1 gap-1 py-1">
                                                <div class=" text-xs capitalize">Rating</div>
                                                <div class=" text-xs" x-text="bookData.rating"></div>
                                                <div class=" text-xs capitalize">Publisher</div>
                                                <div class=" text-xs" x-text="bookData.author"></div>
                                                <div class=" text-xs capitalize">publissed Date</div>
                                                <div class=" text-xs" x-text="bookData.published_date"></div>
                                                <div class=" text-xs capitalize">Pages</div>
                                                <div class=" text-xs" x-text="bookData.pages"></div>
                                                <div class=" text-xs capitalize">Category</div>
                                                <div class=" text-xs" x-text="bookData.category"></div>
                                            </div>
                                        </div>
                                        <h2 class=" first-letter:uppercase font-extrabold text-sm  my-1 inline ">
                                            Description</h2>
                                        <button onclick="toCopy(document.getElementById('myDesc'))"><i
                                                class='bx bx-copy ml-1 text-gray-300'></i></button>
                                        <div class="h-40 overflow-auto">
                                            <p class=" first-letter:uppercase text-xs " id="myDesc"
                                                x-text="bookData.description"></p>
                                        </div>
                                    </div>
                                    <div class="overflow-hidden px-10 overflow-y-auto shadow">
                                        <div w-[80%] h-[100px]>
                                            <img :src="bookData.image" alt="bookData.title"
                                                class="w-[80%]  object-contain shadow-md transform duration-700  hover:opacity-90 ">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </x-main-modal>
                    @empty
                        <div class="bg-white shadow-md border-b rounded p-3 my-2">
                            <p class="text-gray-300">welcome</p>
                            <div class="text-gray-300 py-3">
                                <h1 class="font-semibold text-md capitalize mb-5">No content Available</h1>
                            </div>
                        </div>
                    @endforelse
                @endif
            </section>
        </div>

        {{-- courses --}}
        <div class="w-full">
            <h1 class=" capitalize text-md font-semibold mt-5"><i class="bx bx-book ml-1"></i> My Content Idea</h1>
            <section class="">
                @if (isset($courses))
                    @forelse($courses as $course)
                        <a href="{{ route('courses.edit', ['course' => $course->id]) }}" target="_blank">
                            <div
                                class="bg-white shadow-md border-b relative rounded p-3 my-4  transition duration-300 ease-in-out">
                                <div class="flex justify-between">
                                    <span
                                        class="text-gray-300 text-xs">{{ $course->created_at->toFormattedDayDateString() }}</span>
                                    <div class="text-xs">
                                        Edit
                                    </div>

                                </div>

                                <div class="">
                                    <h2 class="mb-3 font-bold text-sm text-gray-500"> {{ $course->title }}</h2>
                                    <div class="">
                                        <div class="overflow-hidden h-24 line-clamp-3">
                                            @foreach ($course->lessons as $lesson)
                                                <p class="truncate text-gray-500 text-sm">{{ $loop->iteration }}.
                                                    {{ $lesson->title }}</p>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </a>
                    @empty
                        <div class="bg-white shadow-md border-b rounded p-3 my-2">
                            <p class="text-gray-300">welcome</p>
                            <div class="text-gray-300 py-3">
                                <h1 class="font-semibold text-md capitalize mb-5">No content Available</h1>
                            </div>
                        </div>
                    @endforelse
                @endif
            </section>
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
            alert("copied!" );
        }
    </script>
</x-app-layout>
