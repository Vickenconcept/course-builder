<x-app-layout>

    <div class=" w-[70%] mx-auto bg-white pt-5">
        <div class="m-20   px-1 text-gray-700">

            <section class="  py-5 capitalize">
                <h1 class="font-bold text-2xl my-5 capitalize"> Title: {{ $course->title }}</h1>
                <h4 class="font-semibold my-5 text-xl"> Introduce:</h4>
                <p class="  text-md  text-justify my-3">
                    {{ $course->description }} 
                </p>
                <h3 class="font-semibold my-5">Outline:</h3>
                <ol>
                    @foreach ($course->lessons as $lesson)
                        <li class="py-2"> <i class='bx bx-square text-xs'></i> {{ $lesson->title }}</li>
                    @endforeach
                </ol>
            </section>


            @foreach ($course->lessons as $lesson)
                <section class="  my-5 py-10 ">
                    <h3 class="font-semibold capitalize py-5 text-xl">{{ $loop->iteration }}.  {{ $lesson->title }}</h3>

                    {!! $lesson->content !!}

                </section>
            @endforeach

        </div>
    </div>
</x-app-layout>
