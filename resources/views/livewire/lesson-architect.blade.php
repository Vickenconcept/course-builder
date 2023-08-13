<div class=" pt-10 md:px-10" x-data="{ loading: ''}">
    <x-notification />
    <div class=" grid grid-cols-1 md:grid-cols-3 ">

        <section class=" col-span-2 mr-0 md:mr-10  px-5 pt-2 pb-5 bg-white rounded-xl">
            <div class="mb-6">
                <label class="py-1 px-5  text-xs  border-b-2 border-blue-800 m-0 text-white bg-blue-800/50">Create</label>
                <label class="py-1 px-5  text-xs  border-b-2 border-blue-800 m-0 text-blue-900 ">Structured</label>


            </div>
            <div class="flex flex-row mb-10 bg-blue-50 rounded-xl p-3">
                <div class="  w-12 h-12">
                    <i class='bx bx-brain text-white text-2xl bg-blue-800 rounded p-2'></i>
                    <!-- <i class='bx bxs-color font-bold text-red-500 text-3xl '></i> -->
                </div>
                <div class="pl-1 text-blue-900">
                    <h1 class="font-semibold text-sm capitalize ">Create</h1>
                    <p class=" text-left text-xs">"Empower your content creation with AI, delivering personalized and engaging experiences effortlessly."</p>
                </div>
            </div>

            <form wire:submit.prevent="store" id="myForm" x-data>
                <!-- @csrf -->
                <div class="grid grid-cols-1 gap-8  ">
                    <div class="w-full col-span-1">
                        <i class='bx bx-bulb text-blue-500 text-xl '></i> <label for="topic" class="   bg-white  text-blue-800/50 px-3 rounded  transition duration-300 py-2 text-xs">Topic/Title</label>
                        <div class="ml-5">
                            <input class="peer w-full outline-none border-gray-300 shadow mt-3  rounded-lg focus:none text-sm text-blue-800 pr-2 placeholder-gray-300" type="text" name="topic" wire:model="topic" id="topic" placeholder="Create a Youtube channel" autocomplete="off" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div class="w-full col-span-1 ">
                            <i class='bx bx-bulb text-blue-500  text-xl'></i>
                            <label for="presentation" class="    bg-white  text-blue-800/50 px-3 rounded  transition duration-300 py-2 text-xs">presentation Presentation of Books</label>
                            <div class="ml-5">
                                <select id="presentation" name="presentation" wire:model="presentation" class="   bg-white border mt-3 border-gray-300 shadow text-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-blue-700 dark:border-blue-600 dark:placeholder-blue-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected class="text-blue-50 "  disabled>Course</option>
                                    <option value="Summaries and key takeaways" class="text-blue-900  ">Summaries and key takeaways</option>
                                    <option value="In-depth analysis and case studies" class="text-blue-900  ">In-depth analysis and case studies</option>
                                    <option value="Step-by-step tutorials and exercises" class="text-blue-900  ">Step-by-step tutorials and exercises</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full col-span-1 ">
                            <i class='bx bx-bulb text-blue-500  text-xl'></i>
                            <label for="level" class="   bg-white  text-blue-800/50 px-3 rounded  transition duration-300 py-2 text-xs">Beginner, Intermidiate,Advance</label>
                            <div class="ml-5">
                                <select id="level" name="level" wire:model="level" class="   bg-white border mt-3 border-gray-300 shadow text-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-blue-700 dark:border-blue-600 dark:placeholder-blue-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected class="text-blue-50 "  disabled>(Optional)</option>
                                    <option value="beginner " class="text-blue-900">Beginner</option>
                                    <option value="intermidiate " class="text-blue-900">Intermidiate</option>
                                    <option value="advanced " class="text-blue-900">Advanced</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full col-span-1 ">
                            <i class='bx bx-bulb text-blue-500  text-xl'></i>
                            <label for="outline" class="   bg-white  text-blue-800/50 px-3 rounded  transition duration-300 py-2 text-xs">Outline, Description,Summary</label>
                            <div class="ml-5">
                                <select id="outline" name="outline" wire:model="outline" class="   bg-white border mt-3 border-gray-300 shadow text-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-blue-700 dark:border-blue-600 dark:placeholder-blue-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <!-- <option selected class="text-blue-50 " disabled>(Optional)</option> -->
                                    <option selected value="outline" class="text-blue-900">Outline</option>
                                    <option value="description" class="text-blue-900">Description</option>
                                    <option value="summary" class="text-blue-900">Summary</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full col-span-1 ">
                            <i class='bx bx-bulb text-blue-500  text-xl'></i>
                            <label for="modules" class="   bg-white  text-blue-800/50 px-3 rounded  transition duration-300 py-2 text-xs">How Many Modules Of Chapters</label>
                            <div class="ml-5">
                                <select id="modules" name="modules" wire:model="modules" class="   bg-white border mt-3 border-gray-300 shadow text-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-blue-700 dark:border-blue-600 dark:placeholder-blue-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected class="text-blue-50 "  disabled>(Optional)</option>
                                    <option value="3-5 modules" class="text-blue-900">3-5 modules</option>
                                    <option value="6-10 modules" class="text-blue-900">6-10 modules</option>
                                    <option value="10+ modules" class="text-blue-900">10+ modules</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full col-span-1 ">
                            <i class='bx bx-bulb text-blue-500  text-xl'></i>
                            <label for="formatting" class="   bg-white  text-blue-800/50 px-3 rounded  transition duration-300 py-2 text-xs">Any Formatting</label>
                            <div class="ml-5">
                                <select id="formatting" name="formatting" wire:model="formatting" class="   bg-white border mt-3 border-gray-300 shadow text-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-blue-700 dark:border-blue-600 dark:placeholder-blue-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected class="text-blue-50 "  disabled>(Optional)</option>
                                    <option value=" format the course  " class="text-blue-900">Yes</option>
                                    <option value="don't formart the course" class="text-blue-900">No</option>
                                    <option value="you can choose to formart of not " class="text-blue-900">No preference</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full col-span-1 ">
                            <i class='bx bx-bulb text-blue-500  text-xl'></i>
                            <label for="time" class="   bg-white  text-blue-800/50 px-3 rounded  transition duration-300 py-2 text-xs">Prefered Total Course Time (hours)?</label>

                            <div class="ml-5">
                                <select id="time" name="time" wire:model="time" class="   bg-white border mt-3 border-gray-300 shadow text-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-blue-700 dark:border-blue-600 dark:placeholder-blue-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected class="text-blue-50 "  disabled>(Optional)</option>
                                    <option value="Short (1-5 hours)" class="text-blue-900">Short (1-5 hours)</option>
                                    <option value="Medium (6-10 hours)" class="text-blue-900">Medium (6-10 hours)</option>
                                    <option value="Long (11+ hours)" class="text-blue-900">Long (11+ hours)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class=" grid grid-cols-1 sm:grid-cols-2 gap-5 col-span-1  w-full ml-0 lg:ml-5 pr-0 lg:pr-5">
                        <x-main-button type="submit" @click="loading = 'Loading...'" wire:offline.attr="disabled" wire:disabled="emptyInputs" class="uppercase justify-center">Generate</x-main-button>
                        <button type="button" @click="document.getElementById('myForm').reset()" class="uppercase justify-center border border-blue-500 text-xs rounded hover:shadow-lg font-medium bg-transparent text-blue-800 px-2 py-3">Clear Input</button>
                    </div>
                </div>
            </form>
        </section>

        <section class="shadow-lg py-3 bg-white col-span-1 rounded px-10 text-sm text-blue-900 h-[100vh] overflow-y-auto my-10 md:my-0">
            <div class="flex flex-row ">
                <!-- <input type="text" value="hello"> -->
                @if(isset($content))
                <form action="{{ route('lesson-architect.store') }}" method="post">
                    @csrf
                    <input type="text" name="content" value="{{ $content}}" hidden>
                    <x-main-button type="submit" class="text-xs mr-3 py-0.5">Save To Libary</x-main-button>
                </form>
                <button onclick="toCopy(document.getElementById('content'))"><i class='bx bx-copy text-xl text-blue-800/50 hover:text-blue-800 cursor-pointer'></i></button>
                <button>
                    <a href="{{ route('export.text') }}">
                        <i class='bx bxs-file-export text-xl text-blue-800/50 hover:text-blue-800 cursor-pointer'></i>
                    </a>
                </button>
                @endif
            </div>
            <div class="pt-10 text-sm leading-[1.5rem] w-full" id="content">
                @if(isset($content))
                {!! $content !!}
                @else
                <!-- <span :class=" loading ? 'hidden': ''">No content available.</span>
                    <span x-text="loading"></span> -->
                <div wire:loading.remove class="w-full text-center">No content</div>
                <div wire:loading class="text-center w-full">
                    <div class="mt-[50%]">
                        <i class='bx bx-loader-alt animate-spin text-4xl '></i>
                        <p class="mt-2 ">Generating Content...</p>
                    </div>
                </div>
                <span wire:offline>You are offline</span>
                @endif
            </div>
        </section>
    </div>

    <script>
             // for coping text
             function toCopy(copyData) {
                var range = document.createRange();
                range.selectNode(copyData);
                window.getSelection().removeAllRanges();
                window.getSelection().addRange(range);
                document.execCommand("copy");
            }
        </script>
</div>