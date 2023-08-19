 <div>
     <x-notification />
     <div class=" bg-white py-10 px-3 sm:px-0 lg:px-20  " x-data="{ isOpen: false, inputData: '', action: '' }">
         <a href="{{ route('content-planner.index') }}" class="text-xs font-bold text-gray-700 "> <i
                 class='bx bx-chevron-left mr-2'></i> Back to content planner</a>
                 


         <div class="mx-auto w-[70%]  mt-5 ">
             {{-- <form action="{{ route('content-planner.store') }}" method="post" class="mt-8" id="myForm"> --}}
             @csrf
             {{-- <!-- <textarea id="" name="mytextarea" class="w-[50%] mx-auto">{{ strip_tags($library->content) }}</textarea> --> --}}
             @foreach ($cachedCourseOutline as $index => $subheading)
                 <div x-data="{ open: false }" class="">
                     <div class="relative ">
                         <div class="border py-2 shadow text-gray-500 font-semibold">
                             <button class="px-3" @click="open = !open">:::</button>
                             {{ $loop->iteration }}
                             <input type="text" value="{{ $subheading }}" class=" border-none  px-4 py-2 w-60"
                                 placeholder="Select an option">
                             <button @click="open = !open" class="absolute top-0 right-0 p-3">
                                 <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M19 9l-7 7-7-7"></path>
                                 </svg>
                             </button>
                         </div>

                         <div x-show="open" class="bg-gray-50 border rounded ">
                             {{-- <h2>{{ $subheading }}</h2> --}}
                             {{-- <textarea name="subheadings[{{ $index }}]"></textarea> --}}
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
                                             <button 
                                                 @click="isOpen = true ; inputData = '{{ $subheading }}'; action='write an intro summary for this module based on this title' ">
                                                 write an intro summary for this module based on this title
                                             </button>
                                         </x-dropdown-link>
                                         <x-dropdown-link class="cursor-pointer">
                                             <button
                                                 @click="isOpen = true ; inputData = '{{ $subheading }}'; action='Generate key ideas (below) for this module'">
                                                 Generate key ideas (below) for this module
                                             </button>
                                         </x-dropdown-link>
                                     </x-slot>
                                 </x-dropdown>
                             </div>
                             <div class="relative">
                                 {{-- modal --}}
                                 <div class="">
                                     <div class="flex items-center justify-center absolute top-0 left-0 w-full h-full bg-gray-500 bg-opacity-75 z-10"
                                         x-show="isOpen" @click.away="isOpen = false">
                                         <div
                                             class="bg-white w-[90%] shadow-sm border rounded overflow-hidden pb-6 transition-all relative duration-700">
                                             <div>
                                                 <button type="button" class="text-yellow-500 font-bold px-4 pt-3"
                                                     @click="isOpen = false">
                                                     <i class='bx bxs-message-square-x'></i>
                                                 </button>
                                             </div>
                                             <div class="p-5">
                                                 {{-- <form wire:submit.prevent="aiCourseGenerator" id="aiCourseGenerator"
                                                    onsubmit="updateInputFields()">

                                                    <input class=" hidden shadow-sm rounded-lg w-full p-2" name="action"
                                                        type="text" class="form-control" id="action"
                                                        wire:model="action" value="" x-model="action">

                                                    <input class=" hidden shadow-sm rounded-lg w-full p-2" name="subheading"
                                                        type="text" class="form-control" id="subheading"
                                                        wire:model="subheading" value="" x-model="inputData">
                                                    <x-main-button type="submit">Generate</x-main-button> --}}

                                                 </form>
                                                 {{-- <livewire:content-generator :cachedCourseOutline="$cachedCourseOutline" /> --}}
                                                 {{-- This is the content --}}
                                                 @if (isset($content))
                                                     {{ $content }}
                                                 @else
                                                     {{-- <div wire:loading.remove class="w-full text-center">No content</div> --}}
                                                     {{-- <div wire:loading class="text-center w-full">
                                                        <div class="mt-[50%]">
                                                            <i class='bx bx-loader-alt animate-spin text-4xl '></i>
                                                            <p class="mt-2 ">Generating Content...</p>
                                                        </div>
                                                    </div> --}}
                                                 @endif
                                             </div>
                                         </div>
                                     </div>
                                 </div>


                                 <textarea id="mytextarea_{{ $index }}" name="mytextarea" class="w-[50%] mx-auto">
                                    <p class="p-2 bg-gray-500">{{ $subheading }}</p>
                                </textarea>
                             </div>
                             <!-- Dropdown options go here -->

                         </div>
                     </div>
                 </div>
             @endforeach
             </form>
             <x-main-button onClick="document.getElementById('myForm').submit()" class="">
                 <i class='bx bx-save mr-2'></i> Save</x-main-button>
         </div>


     </div>
 </div>
 <script>
     //  tinymce.init({
     //      selector: '#mytextarea',
     //      plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
     //      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
     //      tinycomments_mode: 'embedded',
     //      tinycomments_author: 'Author name',
     //      mergetags_list: [{
     //              value: 'First.Name',
     //              title: 'First Name'
     //          },
     //          {
     //              value: 'Email',
     //              title: 'Email'
     //          },
     //      ],
     //      ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
     //          "See docs to implement AI Assistant"))
     //  });

     @foreach ($cachedCourseOutline as $index => $subheading)
             <script >
             tinymce.init({
                 selector: '#mytextarea_{{ $index }}',
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
 @endforeach




 // --
 var form = document.getElementById('myForm');

 form.addEventListener('input', function(event) {
 event.preventDefault();

 var formData = new FormData(form);
 var formValues = {};

 formData.forEach(function(value, key) {
 formValues[key] = value;
 });

 console.log(formValues);
 });


 // function updateInputFields() {
 // console.log('hello ');
 // const actionInput = document.getElementById('action');
 // const subheadingInput = document.getElementById('subheading');

 // if (actionInput) {
 // actionInput.dispatchEvent(new Event('input'));
 // }

 // if (subheadingInput) {
 // subheadingInput.dispatchEvent(new Event('input'));
 // }
 // }
 </script>
