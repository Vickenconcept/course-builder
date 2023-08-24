<div wire:poll.visible="updateDatabase"wire:poll.10s class="bg-white">
{{-- <div wire:poll.visible="updateDatabase"wire:poll.10s> --}}
    {{-- <div wire:loading>
        Processing Payment...
        <span class="animate-spin">nn</span>
    </div> --}}
        <div wire:ignore  >
            <textarea id="content-{{ $lesson->id }}" name="content" class="w-full" rows="10" input="content" wire:model="content"  wire:poll>{{ $content }}</textarea>
        </div>
    {{-- @push('script') --}}
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
        </script>

    {{-- @endpush --}}
</div>
