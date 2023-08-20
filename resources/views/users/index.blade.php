<x-app-layout>
    <div class="bg-white">
        <div class="">
            <a href="{{ route('content-planner.index') }}" class="text-xs font-bold text-gray-700 ">
                <i class='bx bx-chevron-left mr-2'></i> Back to content planner
            </a>
        </div>
    
        <section>
            {{-- <x-main-button onClick="document.getElementById('myForm').submit()" class="">
                <i class='bx bx-save mr-2'></i> Save
            </x-main-button> --}}
        </section>
        <section class="mt-20">
            {{-- <form action="" method="" id=""> --}}
                @foreach ($course->lessons as $lesson)
                    <div>
                        <livewire:course-content :course="$lesson" />
                    </div>
                @endforeach
            {{-- </form> --}}
           
        </section>
    </div>
</x-app-layout>
