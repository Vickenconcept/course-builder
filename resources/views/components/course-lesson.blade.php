@props(['lesson'])

<div class="  mt-0.5 ">

    <div {{-- x-data="{ childIsOpen }"   --}} x-data="{ open: false, isOpen:false }" class="">
        <div class="relative ">
            <div class="border p-2 shadow text-gray-500 font-semibold flex items-center justify-between">
                <div class="pl-2 flex">
                    <button @click="open = !open">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                        </svg>
                    </button>
                    <h4 class="text-md font-bold px-2">{{ $lesson->title }}</h4>
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
                            class="  bg-yellow-700 border text-white rounded-lg px-2 py-1  shadow-sm text-xs text-right">
                            <span class=""> AI</span>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link class="cursor-pointer" @click="isOpen = true ; ">
                            <button  
                            >
                                write an intro summary for this module based on this title
                            </button>
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>

                <livewire:modal :title="$lesson->title" :lesson="$lesson" />
                <livewire:text-editor :lesson="$lesson" />

            </div>
        </div>
    </div>
</div>
