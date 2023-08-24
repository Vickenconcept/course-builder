<div x-show="isOpen" 
    class="fixed z-[60] inset-0 overflow-y-auto bg-gray-500/50 transform  transition-all  duration-700 -full"
    style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-10">
        <div class="bg-white w-[90%] rounded overflow-hidden pb-6 transition-all relative duration-700"
            >
            <div>
                <button type="button" class=" px-4 pt-3"
                @click="isOpen = false">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                  
            </button>
        </div>
        <div class="p-5 overflow-y-auto">
            {{ $slot }}
          
            </div>
        </div>
    </div>
</div>
