<div x-data="{ loaded: true }">
    <div x-show="loaded" x-init="window.addEventListener('DOMContentLoaded', () => { setTimeout(() => loaded = false, 600) })"
        class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-[#9fdfbf]"
        style="z-index: 1000">
        <div class="  rounded-full  ">
            <img src="{{ asset('images/moving_ball.gif') }}"  alt="" style="opacity: 0.8;">

        </div>
        <div
        class="loadingio-eclipse">
          <div class="ldio-rpinwye8j0b">
            <div>
            </div>
          </div>
        </div>
    </div>
</div>
