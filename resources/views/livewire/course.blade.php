<div class=" py-10 md:px-10 text-gray-700 bg-gray-200" x-data="{ loading: '', loaded: false }">
    <x-notification />
    <div class=" grid grid-cols-1 md:grid-cols-3 ">
        <section class=" col-span-2 mr-0 md:mr-10  px-5 pt-2 pb-5 bg-white rounded-xl">
            <div class="mb-6">
                <label class="py-1 px-5  text-xs  border-b-2 border-[#39ac73] bg-white m-0 text-white ">Create</label>
                <label class="py-1 px-5  text-xs  border-b-2 border-[#39ac73] m-0  ">Structured</label>
            </div>
            <div class="flex flex-row mb-10 bg-gray-100 rounded-xl p-3">
                <div class="  w-12 h-12">
                    <i class='bx bx-brain text-white text-2xl bg-[#39ac73] rounded p-2'></i>
                </div>
                <div class="pl-1 ">
                    <h1 class="font-semibold text-sm capitalize ">Create</h1>
                    <p class=" text-left text-xs font-semibold">"Empower your content creation with AI, delivering
                        personalized and
                        engaging experiences effortlessly."</p>
                </div>
            </div>
            <form wire:submit.prevent="store" id="myForm" x-data>
                <div class="grid grid-cols-1 gap-8  ">
                    <div class="w-full col-span-1">
                        <i class='bx bx-bulb text-gray-700 text-xl '></i> <label for="topic"
                            class="   bg-white   px-3 rounded  transition duration-300 py-2 text-xs">Topic/Title</label>
                        <div class="ml-5">
                            <input
                                class="peer bg-gray-100 w-full outline-none border-gray-300 shadow mt-3  rounded-lg focus:none text-sm text-gray-800 pr-2 placeholder-gray-400"
                                type="text" name="topic" wire:model.defer="topic" id="topic"
                                placeholder="Create a Youtube channel" autocomplete="off" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div class="w-full col-span-1 ">
                            <i class='bx bx-bulb text-gray-700  text-xl'></i>
                            <label for="presentation"
                                class="    bg-white   px-3 rounded  transition duration-300 py-2 text-xs">
                                Presentation of Books</label>
                            <div class="ml-5">
                                <select id="presentation" name="presentation" wire:model.defer="presentation"
                                    class="   bg-gray-100 border mt-3 border-gray-300 shadow text-gray-600 text-sm rounded-lg  block w-full p-2.5     ">
                                    <option selected class="text-gray-50 " disabled>Course</option>
                                    <option value="Summaries and key takeaways" class="  ">Summaries and key
                                        takeaways</option>
                                    <option value="In-depth analysis and case studies" class="  ">In-depth analysis
                                        and case studies</option>
                                    <option value="Step-by-step tutorials and exercises" class="  ">Step-by-step
                                        tutorials and exercises</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full col-span-1 ">
                            <i class='bx bx-bulb text-gray-700  text-xl'></i>
                            <label for="level"
                                class="   bg-white   px-3 rounded  transition duration-300 py-2 text-xs">Beginner,
                                Intermidiate,Advance</label>
                            <div class="ml-5">
                                <select id="level" name="level" wire:model.defer="level"
                                    class="   bg-gray-100 border mt-3 border-gray-300 shadow text-gray-600 text-sm rounded-lg  block w-full p-2.5     ">
                                    <option selected class="text-gray-50 " disabled>(Optional)</option>
                                    <option value="beginner " class="">Beginner</option>
                                    <option value="intermidiate " class="">Intermidiate</option>
                                    <option value="advanced " class="">Advanced</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full col-span-1 ">
                            <i class='bx bx-bulb text-gray-700  text-xl'></i>
                            <label for="outline"
                                class="   bg-white   px-3 rounded  transition duration-300 py-2 text-xs">Outline,
                                Description,Summary</label>
                            <div class="ml-5">
                                <select id="outline" name="outline" wire:model.defer="outline"
                                    class="   bg-gray-100 border mt-3 border-gray-300 shadow text-gray-600 text-sm rounded-lg  block w-full p-2.5     ">
                                    <option selected value="outline" class="">Outline</option>
                                    <option value="description" class="">Description</option>
                                    <option value="summary" class="">Summary</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full col-span-1 ">
                            <i class='bx bx-bulb text-gray-700  text-xl'></i>
                            <label for="modules"
                                class="   bg-white   px-3 rounded  transition duration-300 py-2 text-xs">How Many
                                Modules Of Chapters</label>
                            <div class="ml-5">
                                <select id="modules" name="modules" wire:model.defer="modules"
                                    class="   bg-gray-100 border mt-3 border-gray-300 shadow text-gray-600 text-sm rounded-lg  block w-full p-2.5     ">
                                    <option selected class="text-gray-50 " disabled>(Optional)</option>
                                    <option value="3-5 modules" class="">3-5 modules</option>
                                    <option value="6-10 modules" class="">6-10 modules</option>
                                    <option value="10+ modules" class="">10+ modules</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full col-span-1 ">
                            <i class='bx bx-bulb text-gray-700  text-xl'></i>
                            <label for="formatting"
                                class="   bg-white   px-3 rounded  transition duration-300 py-2 text-xs">Any
                                Formatting</label>
                            <div class="ml-5">
                                <select id="formatting" name="formatting" wire:model.defer="formatting"
                                    class="   bg-gray-100 border mt-3 border-gray-300 shadow text-gray-600 text-sm rounded-lg  block w-full p-2.5     ">
                                    <option selected class="text-gray-50 " disabled>(Optional)</option>
                                    <option value=" format the course  " class="">Yes</option>
                                    <option value="don't formart the course" class="">No</option>
                                    <option value="you can choose to formart of not " class="">No preference
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full col-span-1 ">
                            <i class='bx bx-bulb text-gray-700  text-xl'></i>
                            <label for="time"
                                class="   bg-white   px-3 rounded  transition duration-300 py-2 text-xs">Prefered Total
                                Course Time (hours)?</label>

                            <div class="ml-5">
                                <select id="time" name="time" wire:model.defer="time"
                                    class="   bg-gray-100 border mt-3 border-gray-300 shadow text-gray-600 text-sm rounded-lg  block w-full p-2.5     ">
                                    <option selected class="text-gray-50 " disabled>(Optional)</option>
                                    <option value="Short (1-5 hours)" class="">Short (1-5 hours)</option>
                                    <option value="Medium (6-10 hours)" class="">Medium (6-10 hours)</option>
                                    <option value="Long (11+ hours)" class="">Long (11+ hours)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class=" grid grid-cols-1 sm:grid-cols-2 gap-5 col-span-1  w-full ml-0 lg:ml-5 pr-0 lg:pr-5">
                        <x-main-button type="submit" x-click="loading = 'Loading...'" wire:disabled="emptyInput"
                            class="uppercase justify-center" wire:target="store">
                            <span wire:loading.remove>Generate</span>
                            <span wire:loading>Loading...</span>
                            {{-- Generate --}}
                        </x-main-button>
                        <button type="button" onclick="document.getElementById('myForm').reset()"
                            class="uppercase justify-center border border-[#39ac73] text-xs rounded hover:shadow-lg font-medium bg-transparent text-gray-700 px-2 py-3">Clear
                            Input</button>
                    </div>
                </div>
            </form>
        </section>

        <section
            class="shadow-lg py-3 bg-white rounded-md col-span-1  px-10 text-sm  h-[100vh] overflow-y-auto my-10 md:my-0">
            <div class="flex flex-row ">
            </div>

            <div class="pt-10 text-sm leading-[1.5rem] w-full" id="content">
                <div wire:target="store">
                    <div wire:loading.remove class="w-full">
                        @if (isset($content))
                            <div class="container">
                                <h3 class="font-semibold">Course outline</h3>

                                @foreach ($content as $index => $subtopic)
                                    <div class="mb-3">
                                        <label for="subtopic{{ $index }}" class="form-label">Subtopic
                                            {{ $index + 1 }}</label>
                                        <div class="input-group">
                                            <input disable class=" shadow-sm rounded-lg w-full p-2"
                                                name="modified_outline[]" type="text" class="form-control"
                                                id="subtopic{{ $index }}" name="modified_outline"
                                                value="{{ $subtopic }}" disabled>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('courses.edit', ['course' => $courseId]) }}">
                                        <x-main-button type="submit" wire:disabled="emptyInputs"
                                            class="uppercase justify-center mt-3 text-center">
                                            Generate
                                        </x-main-button>
                                    </a>
                                    <form id="delete-form" class="inline mt-3"
                                        action="{{ route('courses.destroy', ['course' => $courseId]) }}"
                                        method="POST">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit"
                                            class="py-1 px-4 rounded-md bg-white shadow-inner hover:shadow-md border  text-red-500 border-red-500 hover:bg-red-300 transition duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class=" h-64 flex justify-center items-center space-x-2 text-gray-400">
                                <p class="font-extrabold text-2xl ">No content</p>
                                <p class="">
                                    <i class='bx bxs-folder-open font-extrabold text-6xl '></i>
                                </p>
                            </div>

                        @endif
                    </div>
                    <div wire:loading class="h-64 flex justify-center items-center">
                        <div class=" flex justify-center items-center space-x-2 text-gray-400">
                            <p class="font-extrabold text-xl ">Generating Content.</p>
                            <img src="{{ asset('images/moving_ball.gif') }}" alt="" class="h-20 w-2h-20">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        function toCopy(copyData) {
            var range = document.createRange();
            range.selectNode(copyData);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand("copy");
            alert("copied!");
        }
    </script>
</div>
