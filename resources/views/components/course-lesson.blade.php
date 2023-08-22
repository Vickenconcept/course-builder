@props(['lesson'])

<div class="  mt-0.5 " x-data="{ isOpen: false, inputData: '', action: '' }">

    <div x-data="{ open: false }" class="">
        <div class="relative ">
            <div class="border p-2 shadow text-gray-500 font-semibold flex items-center justify-between">
                <div class="pl-2 flex">
                    <button @click="open = !open">:::</button>
                
                    <h4 class="text-md font-bold px-2">{{ $lesson->title }}</h4>
                </div>

                <button @click="open = !open">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>

            <div x-show="open" class=" bg-gray-50 border rounded transition duration-700 ease-in-out ">
                
                <livewire:modal :title="$lesson->title" :lesson="$lesson"/>
                <livewire:text-editor :lesson="$lesson" />

            </div>
        </div>
    </div>
</div>
