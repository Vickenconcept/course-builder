<x-app-layout>
    <x-notification />
    <div class=" bg-white py-10 px-3 sm:px-0 lg:px-20  ">
        <a href="{{ route('content-planner.index') }}" class="text-xs font-bold text-gray-700 "> <i
                class='bx bx-chevron-left mr-2'></i> Back to content planner</a>


        <div class="mx-auto w-full  mt-5">
            <form action="{{ route('content-planner.store') }}" method="post" class="mt-8" id="myForm">
                @csrf
                {{-- <!-- <textarea id="" name="mytextarea" class="w-[50%] mx-auto">{{ strip_tags($library->content) }}</textarea> --> --}}
                <textarea id="mytextarea" name="mytextarea" class="w-[50%] mx-auto">

                    <h1 class=" text-2xl uppercase ">Topic: {{ $library->course->topic }}</h1>
                    <br>
                    <h3 class=" underline py-3">Course overview</h3>
                    <p class=" text-sm italic">

                       " {{ $library->course->overview }} "
                    </p>
                    <br>
                        {!! nl2br($library->course->library->content) !!}
                </textarea>
            </form>
            <x-main-button onClick="document.getElementById('myForm').submit()" class=""><i
                    class='bx bx-save mr-2'></i> Save</x-main-button>
        </div>
    </div>
    <script>
      



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
