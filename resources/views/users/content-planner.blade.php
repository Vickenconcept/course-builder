<x-app-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-2 md:px-10 text-gray-700" x-data="{ isOpen: false , formType: false}">
        <div class="w-full">
            <h1 class=" first-letter:uppercase font-semibold py-5"><i class="bx bx-book ml-1"></i> My saved courses</h1>
            <section class="" id="content">
                @if(isset($libraries))
                @forelse($libraries as $library)
                <div class="bg-white shadow-md border-b relative rounded p-3 my-4  transition duration-300 ease-in-out"  x-data="{ seeMore: true, isOpen: false, libraryId: {{ $library->id }} }">
                    <div class="flex justify-between">
                        <span class="text-gray-300 text-xs">{{ $library->created_at->toFormattedDayDateString() }}</span>
                        <div class="">
                            <x-dropdown align="right">
                                <x-slot name="trigger">
                                    <button class=""><i class='bx bx-dots-vertical-rounded'></i></button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link class="cursor-pointer" @click="isOpen = true; formType = false">
                                        {{ __('Delete') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href=" route('lesson-architect.show', ['lesson_architect' => $library->id]) ">
                                        {{ __('Edit') }}
                                    </x-dropdown-link>

                                </x-slot>
                            </x-dropdown>
                        </div>

                        <x-main-modal>
                            <h2 class="first-letter:uppercase font-semibold text-sm border-t py-2 text-center ">Are you sure you want to delete this course?</h2>
                            <div class="flex justify-center gap-2">
                                <form method="POST" :action="'{{ route('library.destroy', '') }}/' + libraryId" x-bind:id="'form-' + libraryId">
                                    @csrf
                                    @method('DELETE')
                                    <x-main-button type="submit" class="">DELETE</x-main-button>
                                </form>
                                <x-main-button class="bg-transparent " @click="isOpen = false">CANCEL</x-main-button>
                            </div>

                        </x-main-modal>
                    </div>

                    <div class=" px-2 h-full mt-3"  :class="seeMore ? 'line-clamp-4 pb-3' : ''">
                        {!! $library->content !!}
                    </div>
                    <button @click="seeMore = !seeMore" x-text="seeMore ? 'Show more..' : 'See less'" class="hover:underline px-5 py-1 bg-white absolute bottom-0 right-0 text-xs text-blue-700 "></button>

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
        <div class="w-full">
            <div class="flex flex-row justify-between py-5">
                <h1 class=" first-letter:uppercase font-semibold "><i class="bx bx-book ml-1"></i> My content ideas</h1>
            </div>
            @php
            $hashids = new \Hashids\Hashids();
            @endphp
            <section class="text-xs" id="content">
                @if(isset($contents))
                @forelse($contents as $content)
                <div class="bg-white shadow-md border-b relative rounded p-3 my-4 overflow-hidden transition duration-300 ease-in-out " x-data="{ seeMore: true, isOpen: false }">
                <!-- <div class="bg-white shadow-md border-b relative rounded p-3 my-4 overflow-hidden transition duration-300 ease-in-out" :class="seeMore ? 'h-32 pb-5' : ''" x-data="{ seeMore: true, isOpen: false }"> -->
                    <div class="flex justify-between">
                        <span class=" text-gray-300 text-xs">{{ $content->created_at->toFormattedDayDateString() }}</span>
                        <div class="flex flex-row" x-data="{ openShare: false}">
                            <button @click="openShare = true" class=" bg-yellow-500 text-white shadow-sm hover:shadow:md px-3 mr-2">
                                Share
                            </button>
                            <x-dropdown align="right">
                                <x-slot name="trigger">
                                    <button class=""><i class='bx bx-dots-vertical-rounded'></i></button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link class="cursor-pointer" @click="isOpen = true">
                                        {{ __('Delete') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href=" route('content-planner.show', ['content_planner' => $hashids->encode($content->id)]) " target="_blank">
                                        {{ __('Preview') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                            <div x-show="openShare" class="fixed z-[60] inset-0 overflow-y-auto bg-gray-500/50 transform  transition-all  duration-700 " style="display: none;">
                                <div class="flex items-center justify-center min-h-screen px-10">
                                    <div class="bg-white w-[90%] md:w-[50%] rounded-lg overflow-hidden pb-6 transition-all relative duration-700" @click.away="openShare = false">
                                        <div class="p-5">
                                            <h1 class="text-gray-700">Share Link</h1>
                                            <p class="mb-10">Get link to share</p>
                                            <p id="{{$content->id}}" class="w-full rounded-lg p-3 border text-sm border-gray-700 ">{{ route('content-planner.show', ['content_planner' => $hashids->encode($content->id)]) }}</p>
                                            <button onclick="toCopy(document.getElementById('{{$content->id}}'))" class="rounded-lg bg-yellow-500 px-3 py-2 mt-5 text-white text-xs shadow-sm hover:shadow-md ">Copy Clipboard</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for deletion confirmation -->
                        <x-main-modal>
                            <h2 class="first-letter:uppercase font-semibold text-sm border-t py-2 text-center ">Are you sure you want to delete this course?</h2>
                            <div class="flex justify-center gap-2">
                                <form method="POST" :action="'{{ route('content-planner.destroy', '') }}/' + {{ $content->id }}" id="form-{{ $content->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <x-main-button type="submit" class="">DELETE</x-main-button>
                                </form>
                                <x-main-button class="bg-transparent " @click="isOpen = false">CANCEL</x-main-button>
                            </div>
                        </x-main-modal>
                    </div>

                    <div class=" px-2 h-full mt-3"  :class="seeMore ? 'line-clamp-4 pb-3' : ''">
                        {!! $content->content !!}
                    </div>
                    <button @click="seeMore = !seeMore" x-text="seeMore ? 'Show more..' : 'See less'" class="hover:underline px-5 py-1 bg-white absolute bottom-0 right-0 text-xs text-blue-700"></button>
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
        }
    </script>
</x-app-layout>