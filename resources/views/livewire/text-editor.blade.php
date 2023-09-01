<div wire:poll.visible="updateDatabase" wire:poll.10s class="bg-white" x-data="{ ignore: true }">


    {{-- <div wire:ignore>
        <textarea id="content-{{ $lesson->id }}" name="content" class="w-full" rows="10" input="content" wire:model="content">{{ $content }}</textarea>
    </div> --}}
    @if ($shouldIgnore)
    <p>ignore this</p>
    @dump($shouldIgnore)
        <div wire:ignore>
            <textarea id="content-{{ $lesson->id }}" name="content" class="w-full" rows="10" input="content" wire:model="content">{{ $content }}</textarea>
        </div>
    @else
        <div >
            @dump($shouldIgnore)
            <p>this is to be left</p>
            <textarea id="content-{{ $lesson->id }}" name="content" class="w-full" rows="10" input="content"
                wire:model="content">{{ $content }}</textarea>
        </div>
    @endif
    <button wire:click="toggleIgnore">Toggle Ignore</button>



    <script>
        $('#content-{{ $lesson->id }}').summernote({
            height: 300, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: true, // set focus to editable area after initializing summernote
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('content', contents);
                },
            }
        });

        // Livewire.on('addToTextarea', (generatedResponse, lessonId) => {
        //     // console.log('Event received with generated response:', generatedResponse);
        //     // console.log('Lesson ID:', lessonId);
        //     const textarea = document.getElementById('content-' + lessonId)
        //     console.log(textarea.value);
        //     @this.set('content', generatedResponse);
        // });

        // Livewire.on('addToTextarea', (generatedResponse, lessonId) => {
        //     console.log('Event received with generated response:', generatedResponse);
        //     console.log('Lesson ID:', lessonId);

        //     // Update the content of the textarea using the provided HTML content
        //     const textarea = document.getElementById('content-' + lessonId);
        //     document.getElementById('para').innerHTML = generatedResponse
        //     if (textarea) {
        //         console.log('hello');
        //         textarea.innerHTML = generatedResponse;
        //     }
        // });
    </script>

</div>
