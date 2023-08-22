<div wire:poll.visible="updateDatabase"wire:poll.10s>
    <div class="flex justify-end">
        <x-dropdown align="right">
            <x-slot name="trigger">
                <button
                    class="  bg-yellow-700 border-4 text-white rounded-lg px-2 py-1  shadow-sm text-xs text-right">
                    <span class=""> AI</span>
                </button>
            </x-slot>
            <x-slot name="content">
                <x-dropdown-link class="cursor-pointer">
                    <button  @click="isOpen = true ; "
                    wire:click="sendData('{{ $action1 }}')">
                        write an intro summary for this module based on this title
                    </button>
                </x-dropdown-link>
                {{-- <x-dropdown-link class="cursor-pointer">
                    <button @click="isOpen = true ; "
                        wire:click="sendData('{{ $action2 }}')">
                        Generate key ideas (below) for this module
                    </button>
                </x-dropdown-link> --}}
            </x-slot>
        </x-dropdown>
    </div>
   
        <div wire:ignore  >
            <textarea id="content-{{ $lesson->id }}" name="content" class="w-full" rows="10" input="content" wire:model="content"  wire:poll>{{ $content }}</textarea>
        </div>
    @push('script')
        <script>
            $(document).ready(() => {
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
            })
        </script>
    @endpush
</div>
