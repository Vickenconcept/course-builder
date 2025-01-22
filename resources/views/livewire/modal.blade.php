<div>
    @props(['modalData', 'title'])
    <div {{-- x-data="{ isOpen : false }" --}}
        class=" fixed flex items-center justify-center absolute top-0 left-0 mx-auto w-full h-full bg-gray-400 bg-opacity-20 z-10"
        x-show="isOpen" style="display: none;">
        <div
            class="bg-white w-[90%] shadow-sm border rounded overflow-auto h-[70%] my-auto pb-6 transition-all relative duration-700">
            <div>
                <button type="button" class=" font-bold px-4 pt-3" @click="isOpen = false">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                {{-- {{ $title }}
            {{ $modalData }} --}}
                @if (!isset($generatedResponse))
                    <x-main-button class="text" wire:click="aiCourseGenerator" wire:loading.attr="disabled"
                        type="submit" wire:target="aiCourseGenerator">
                        Generate
                    </x-main-button>
                @else
                    <x-main-button class="text" wire:click="regenerate" wire:loading.attr="disabled" type="submit"
                        wire:target="aiCourseGenerator">
                        Regenerate
                    </x-main-button>
                @endif
            </div>
            <div class="p-5 overflow-y-auto w-full h-full ">
                <div wire:loading  class=" h-full w-full flex  justify-center items-center ">
                   <div class="flex">
                    <img src="{{ asset('images/moving_ball.gif') }}" class="h-20 w-20" alt="">
                    <div class="h-20 flex  justify-center items-center"> <p class=" "> Generating Content....</p></div>
                   </div>
                </div>

                @if (isset($generatedResponse))
                    <div class="flex justify-end">
                        <button class="  bg-[#339966] text-white rounded-xl px-5 py-1.5  shadow-sm text-xs space-x-2 flex items-center"
                            @click="isOpen = false" wire:click="sendModalResponse">
                           <span> Add Content to
                            Textarea</span>
                        </button>
                        <button onclick="toCopy(document.getElementById('title_{{ $uniqueId }}'))">
                            <i class="bx bx-copy ml-2 text-gray-700"></i>
                        </button>
                    </div>
                    <div id="title_{{ $uniqueId }}">
                        {!! nl2br($generatedResponse) !!}
                    </div>
                @endif

            </div>
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
            alert("copied!");
        }
    </script>

</div>
