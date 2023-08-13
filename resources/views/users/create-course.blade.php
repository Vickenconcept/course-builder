<x-app-layout>
    <x-notification />
    <div class=" bg-white py-10 px-3 sm:px-0 lg:px-20  ">
        <a href="{{ route('content-planner.index') }}" class="text-xs font-bold text-blue-700 "> <i class='bx bx-chevron-left mr-2'></i> Back to content planner</a>

          <!--<div class="  mx-auto w-full sm:w-2/5 mt-5">
            <a href="{{ route('content-planner.index') }}"><x-main-button class=" bg-transparent text-blue-700 font-normal"><i class='bx bx-chevron-left'></i>Show saved Contents</x-main-button></a>
            <h1 class="font-bold py-5 text-blue-700"> <i class='bx bxs-edit'></i> My Course idea</h1>
            <div class="flex flex-row gap-3">
                <x-main-button onClick="document.getElementById('myForm').submit()" x-bind:disabled="inputText === ''" class=""><i class='bx bx-save mr-2'></i> Save</x-main-button>
                <x-main-button class=" bg-transparent text-blue-700 ">
                    <a href="{{ route('export.text') }}">
                        <i class='bx bxs-file-export mr-2'></i> Export as Text
                    </a>
                </x-main-button>

            </div>

            <form action="{{ route('content-planner.store') }}" method="post" class="mt-8" id="myForm">
                @csrf
                <div class="w-full col-span-1 mb-2">
                    <label for="title" class="  text-blue-600 text-sm">Title</label>
                    <div class="">
                        <input x-model="inputText" @change="isButtonDiabled = (firstOption === '')" class="shadow peer w-full outline-none border-gray-300 mt-3  rounded-lg focus:none text-sm text-blue-700 pr-2 placeholder-gray-400 border-b-2" type="text" id="title" name="title" placeholder="UI/UX design 2022" />
                    </div>
                </div>
                <div class="w-full col-span-1 mb-2">
                    <label for="description" class="  text-blue-600 text-sm mr-2">Course Description</label><i class='bx bx-bulb text-blue-500  text-sm'></i>
                    <div class="">
                        <textarea class="shadow peer w-full outline-none border-gray-300 mt-3 h-40  rounded-lg focus:none text-sm text-blue-700 pr-2 placeholder-gray-400 border-b-2" type="text" id="description" name="description" placeholder="UI/UX design 2022"></textarea>
                    </div>
                </div>
                <label for="outline" class=" text-blue-600 text-sm">Outline (Modules)</label>
                <div x-data="{ fields: [] }">
                    <template x-for="(field, index) in fields" :key="index">
                        <div class="flex flex-row">

                            <input class="shadow peer flex-grow outline-none border-gray-300 mt-3  rounded-lg focus:none text-sm text-blue-700 pr-2 placeholder-gray-400 border-b-2" type="text" id="title" :name="'newinput_' + Math.floor(Math.random() * 10000)" placeholder="module points" />
                            <button type="button" @click="fields.splice(index, 1)" class="bg-transparent text-red-400  text-xs shadow-none p-0 hover:shadow-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                        </div>
                    </template>

                    <button type="button" @click="fields.push('')" class=" bg-transparent border my-5 border-blue-400 px-3 py-2 rounded text-blue-500 text-xs">Add Modules +</button>
                </div>

            </form>
            <div class="mt-8">
                <button @click="document.getElementById('myForm').reset()" class=" bg-transparent border border-red-400 px-3 py-2 rounded text-red-500 text-xs"><i class='bx bxs-message-alt-x mr-2'></i> Delete Course Idea</button>
            </div>
        </div> -->
        <!-- {{$library}} -->
        <div class="mx-auto w-full  mt-5">
            <form action="{{ route('content-planner.store') }}" method="post" class="mt-8" id="myForm">
                @csrf
                <!-- <textarea id="" name="mytextarea" class="w-[50%] mx-auto">{{ strip_tags($library->content) }}</textarea> -->
                <textarea id="mytextarea" name="mytextarea" class="w-[50%] mx-auto">{{ $library->content }}</textarea>
            </form>
            <x-main-button onClick="document.getElementById('myForm').submit()" class=""><i class='bx bx-save mr-2'></i> Save</x-main-button>
        </div>
    </div>
    <script>
        tinymce.init({
            selector: '#mytextarea',
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
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant"))
        });



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
    </script>
</x-app-layout>