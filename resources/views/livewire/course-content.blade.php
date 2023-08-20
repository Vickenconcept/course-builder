<div>
    <x-notification />
    <div class="  " x-data="{ isOpen: false, inputData: '', action: '' }" wire:poll.visible="updateDatabase" wire:poll.15s>



        <div class="mx-auto w-[70%]  mt-0.5 ">
            {{-- <form action="{{ route('content-planner.store') }}" method="post" class="mt-8" id="myForm"> --}}
            @csrf

            <div x-data="{ open: false }" class="">
                <div class="relative ">
                    <div class="border py-2 shadow text-gray-500 font-semibold">
                        <button class="px-3" @click="open = !open">:::</button>
                        <input type="text" value="{{ $title }}" class=" border-none  px-4 py-2 w-80"
                            placeholder="Select an option">
                        <button @click="open = !open" class="absolute top-0 right-0 p-3">
                            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </div>

                    <div x-show="open" class=" bg-gray-50 border rounded transition duration-700 ease-in-out ">
                        <div class="flex justify-end">
                            <x-dropdown align="right">
                                <x-slot name="trigger">
                                    <button
                                        class="  border-yellow-700 border-4 bg-white rounded-lg px-2 py-1  shadow-sm text-xs text-right">
                                        <span class=""> AI</span>

                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link class="cursor-pointer">
                                        <button {{-- onClick="document.getElementById('aiCourseGenerator').submit()" --}} @click="isOpen = true ; "
                                            wire:click="setButtonValue('write an intro summary for this module based on this title')">
                                            write an intro summary for this module based on this title
                                        </button>
                                    </x-dropdown-link>
                                    <x-dropdown-link class="cursor-pointer">
                                        <button @click="isOpen = true ; "
                                            wire:click="setButtonValue('Generate key ideas (below) for this module')">
                                            Generate key ideas (below) for this module
                                        </button>
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </div>


                        {{-- <div class="relative"> --}}
                        {{-- modal --}}
                        <div>
                            <div class="flex items-center justify-center absolute top-0 left-0 mx-auto w-full h-full bg-gray-500 bg-opacity-75 z-10"
                                x-show="isOpen">
                                <div
                                    class="bg-white w-[90%] shadow-sm border rounded overflow-auto h-full pb-6 transition-all relative duration-700">
                                    <div>
                                        <button type="button" class="text-yellow-500 font-bold px-4 pt-3"
                                            @click="isOpen = false">
                                            <i class='bx bxs-message-square-x'></i>
                                        </button>

                                        @if (!isset($content))
                                            <x-main-button class="text" wire:click="aiCourseGenerator"
                                                wire:loading.attr="disabled" type="submit"
                                                wire:target="aiCourseGenerator">
                                                Generate
                                                {{-- <span wire:loading.remove>Generate</span> --}}
                                                {{-- <span wire:loading>Loading...</span> --}}
                                            </x-main-button>
                                        @else
                                            <x-main-button class="text" wire:click="aiCourseGenerator" wire:click="resetContent"
                                                wire:loading.attr="disabled" type="submit"
                                                wire:target="aiCourseGenerator">
                                                {{-- <span wire:loading.remove>Regenerate</span> --}}
                                                {{-- <span wire:loading>Loading...</span> --}}
                                                Regenerate
                                            </x-main-button>
                                        @endif
                                    </div>
                                    <div class="p-5 overflow-y-auto">
                                        @if (isset($content))
                                            <div class="flex justify-end">
                                                <button
                                                    class="border-yellow-700 border-4 bg-white rounded-lg px-2 py-1  shadow-sm text-xs"
                                                    @click="isOpen = false" wire:click="addToTextarea">Add Content to
                                                    Textarea
                                                </button>
                                            </div>
                                            {!! nl2br($content) !!}
                                        @endif

                                    </div>
                                </div>
                            </div>
                            {{-- </div> --}}

                            <textarea id="myTextarea" name="textarea" class="w-full mx-auto " rows="10"wire:model="textareaData">
                               
                            </textarea>
                        </div>
                        <!-- Dropdown options go here -->

                    </div>
                </div>
            </div>
            </form>

            {{--  --}}
        </div>


    </div>
</div>
<script>
    tinymce.init({
        selector: '#myTextareai',
        plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [{
                value: 'First.Name',
                title: 'First Name'
            },
            {
                value: 'Email',
                title: 'Email'
            },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
            "See docs to implement AI Assistant"))
    });
</script>
