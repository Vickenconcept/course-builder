<x-app-layout>
    <x-notification />
    <div class=" bg-white py-10 px-3 sm:px-0 lg:px-20  ">
        <a href="{{ route('content-planner.index') }}" class="text-xs font-bold text-blue-700 "> <i class='bx bx-chevron-left mr-2'></i> Back to content planner</a>

          
        <div class="mx-auto w-full  mt-5">
            <form action="{{ route('content-planner.store') }}" method="post" class="mt-8" id="myForm">
                @csrf
                {{-- <!-- <textarea id="" name="mytextarea" class="w-[50%] mx-auto">{{ strip_tags($library->content) }}</textarea> --> --}}
                <textarea id="mytextarea" name="mytextarea" class="w-[50%] mx-auto">

                    {{ $library->course->topic}}
                    <br>
                    <br>
                    {{ $library->course->overview}}
                    <br>
                    <br>
                    <br>
                    {{ $library->course->library->content}}
                </textarea>
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