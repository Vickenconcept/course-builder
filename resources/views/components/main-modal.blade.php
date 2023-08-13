<div x-show="isOpen" class="fixed z-[60] inset-0 overflow-y-auto bg-gray-500/50 transform  transition-all  duration-700 -full" style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-10">
        <div class="bg-white w-[90%] rounded overflow-hidden pb-6 transition-all relative duration-700" @click.away="isOpen = false">
            <div>
                <button type="button" class="text-blue-600 font-bold hover:text-blue-900 px-4 pt-3" @click="isOpen = false">
                <i class='bx bxs-message-square-x'></i>
                </button>
            </div>
            <div class="p-5">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>