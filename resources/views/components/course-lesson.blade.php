@props(['lesson'])

<div class="  mt-0.5  bg-white">

    <div x-data="{ open: false, isOpen: false }" class="">
        <div class="relative ">
            <div class="border px-2  shadow text-gray-500 font-semibold flex items-center justify-between">
                <div class="pl-2 flex flex-grow">
                    <form action="{{ route('lesson.update', ['lesson' => $lesson->id]) }}" method="POST" class="w-full">
                        @csrf
                        @method('PUT')
                        <input id="lesson_input_{{ $lesson->id }}" type="text text-2xl font-bold text-gray-700 uppercase"
                            class="w-[70%]  border-transparent  p-3 placholder-gray-700 placeholder:font-bold placeholder:uppercase"
                            value="{{ $lesson->title }}" name="lesson">
                        <x-main-button type="submit" class="whitespace-nowrap hidden" id="submit_btn_{{ $lesson->id }}">Save</x-main-button>
                    </form>
                </div>

                <button @click="open = !open">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>
            <div x-show="open ? open : childIsOpen"
                class=" bg-gray-50 border rounded transition duration-700 ease-in-out ">
                <div class="flex justify-end">
                    <x-dropdown align="right">
                        <x-slot name="trigger">
                            <button
                                class="  bg-[#339966] border text-white rounded-lg px-2 py-1  shadow-sm text-xs text-right">
                                <span class=""> AI</span>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link class="cursor-pointer" @click="isOpen = true ; ">
                                <button>
                                    Generate content for this module
                                </button>
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
                <livewire:modal :title="$lesson->title" :lesson="$lesson" />
                <div id="here">
                    <livewire:text-editor :lesson="$lesson" />
                </div>
                <div class="flex justify-end p-1">
                    <form action="{{ route('lesson.destroy', ['lesson' => $lesson->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="py-1 px-4 rounded-full bg-transparent border mx-3 text-red-500 border-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const input = document.getElementById('lesson_input_{{ $lesson->id }}');
        const button = document.getElementById('submit_btn_{{ $lesson->id }}');
        const originalValue = input.value; // Save the original value of the input

        input.addEventListener('input', () => {
            // Check if the current value differs from the original value
            if (input.value.trim() !== originalValue.trim()) {
                button.classList.remove('hidden'); // Show the button
            } else {
                button.classList.add('hidden'); // Hide the button
            }
        });
    });
</script>
