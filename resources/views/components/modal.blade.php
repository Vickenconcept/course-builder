@props(['name'])

{{-- modal --}}

<div class="flex items-center justify-center absolute top-0 left-0 mx-auto w-full h-full bg-gray-400 bg-opacity-20 z-10"
    x-show="isOpen" style="display: none;">
    <div
        class="bg-white w-[90%] shadow-sm border rounded overflow-auto h-full pb-6 transition-all relative duration-700">
        <div>
            <button type="button" class=" font-bold px-4 pt-3" @click="isOpen = false">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                  
            </button>

            @if (!isset($generatedResponse))
                <x-main-button class="text" wire:click="aiCourseGenerator" wire:loading.attr="disabled" type="submit"
                    wire:target="aiCourseGenerator">
                    Generate
                    {{-- <span wire:loading.remove>Generate</span> --}}
                    {{-- <span wire:loading>Loading...</span> --}}
                </x-main-button>
            @else
                <x-main-button class="text" wire:click="regenerate" wire:loading.attr="disabled" type="submit"
                    wire:target="aiCourseGenerator">
                    {{-- <span wire:loading.remove>Regenerate</span> --}}
                    {{-- <span wire:loading>Loading...</span> --}}
                    Regenerate
                </x-main-button>
            @endif
        </div>
        <div class="p-5 overflow-y-auto">
            @if (isset($generatedResponse))
                <div class="flex justify-end">
                    <button class="border-yellow-700 border-4 bg-white rounded-lg px-2 py-1  shadow-sm text-xs"
                        @click="isOpen = false" wire:click="addToTextarea">Add Content to
                        Textarea
                    </button>
                </div>
                {!! nl2br($generatedResponse) !!}
            @endif

        </div>
    </div>
</div>
