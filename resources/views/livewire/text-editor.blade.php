<div wire:poll.visible="updateDatabase" wire:poll.10s class="bg-white" x-data="{ ignore: true }">

    {{-- {{ $content }} --}}

    <div wire:ignore>
        <textarea id="content-{{ $lesson->id }}" name="content" class="w-full" rows="10" input="content" wire:model="content">{{ $content }}</textarea>
    </div>
    {{-- <div wire:ignore>
        <textarea id="content-{{ $lesson->id }}" name="content" class="w-full" rows="10" input="content" wire:model="content"></textarea>
    </div> --}}




    <script>
        // jQuery(document).ready(function() {
        //     // Your Summernote initialization code here
        //     $('#content-{{ $lesson->id }}').summernote({
        //         height: 300,
        //         minHeight: null,
        //         maxHeight: null,
        //         focus: true,
        //         callbacks: {
        //             onChange: function(contents, $editable) {
        //                 @this.set('content', contents);
        //             },
        //         }
        //     });
        // });

        jQuery.noConflict();
        (function($) {
            // Your jQuery code here
            jQuery(document).ready(function() {
                // Your Summernote initialization code here
                $('#content-{{ $lesson->id }}').summernote({
                    height: 300,
                    minHeight: null,
                    maxHeight: null,
                    focus: true,
                    callbacks: {
                        onChange: function(contents, $editable) {
                            @this.set('content', contents);
                        },
                    }
                });


            });


            document.addEventListener("livewire:load", function() {
                window.livewire.on('addToTextarea', function(data, lessonId) {
                    // Get the Summernote editor instance using the lessonId
                    var summernote = $('#content-' + lessonId);
                    // Set the received data as the Summernote editor's content
                    summernote.summernote('code', data);
                });
            });
        })(jQuery);




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
