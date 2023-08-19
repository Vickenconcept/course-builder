<div>
    {{ implode(', ', $cachedCourseOutline) }}

    <form wire:submit.prevent="aiCourseGenerator" id="aiCourseGenerator" onsubmit="updateInputFields()">

        <input class="  shadow-sm rounded-lg w-full p-2" name="action" type="text" class="form-control"
            id="action.rand()" wire:model="action" value="" x-model="action">

        <input class="  shadow-sm rounded-lg w-full p-2" name="subheading" type="text" class="form-control"
            id="subheading.rand()" wire:model="subheading" value="" x-model="inputData">
        <x-main-button type="submit">Generate</x-main-button>
    </form>


    <script>
         function updateInputFields() {
            console.log('i am clicked');
            const actionInput = document.getElementById('action');
            const subheadingInput = document.getElementById('subheading');
            

            if (actionInput) {
                actionInput.dispatchEvent(new Event('input'));
            }

            if (subheadingInput) {
                subheadingInput.dispatchEvent(new Event('input'));
            }
        }
    </script>
</div>

{{-- <div>
    @foreach ($cachedCourseOutline as $index => $subheading)
        <form wire:submit.prevent="aiCourseGenerator" id="aiCourseGenerator_{{ $index }}"
              onsubmit="updateInputFields('action_{{ $index }}_{{ rand() }}', 'subheading_{{ $index }}_{{ rand() }}')">

            <input class="shadow-sm rounded-lg w-full p-2" name="action" type="text" class="form-control"
                   id="action_{{ $index }}_{{ rand() }}" wire:model="action" value="" x-model="action">

            <input class="shadow-sm rounded-lg w-full p-2" name="subheading" type="text" class="form-control"
                   id="subheading_{{ $index }}_{{ rand() }}" wire:model="subheading" value="" x-model="inputData">
            <x-main-button type="submit">Generate</x-main-button>
        </form>

        <script>
            function updateInputFields(actionInputId, subheadingInputId) {
                const actionInput = document.querySelector(`input#${actionInputId}`);
                const subheadingInput = document.querySelector(`input#${subheadingInputId}`);

                if (actionInput) {
                    actionInput.dispatchEvent(new Event('input'));
                }

                if (subheadingInput) {
                    subheadingInput.dispatchEvent(new Event('input'));
                }
            }
        </script>
    @endforeach
</div> --}}

