<div class="fixed w-full z-30 flex bg-white  p-2 items-center justify-center h-16 pl-10 pr-5 shadow">
    <div class="logo ml-12 text-gray-700 font-semibold  transform ease-in-out duration-500 flex-none h-full flex items-center justify-center capitalize">
        <a href="{{ route('dashboard') }}" class="text-left py-2  {{ request()->routeIs('dashboard') ? '' : 'hidden' }}">Dashboard</a>
        <a href="{{ route('books.index') }}" class=" {{ request()->routeIs('books.index') ? '' : 'hidden' }}">Books</a>
        <a href="{{ route('course-validation.index') }}" class=" {{ request()->routeIs('course-validation.index') ? '' : 'hidden' }}">Course-research</a>
        <a href="{{ route('content-planner.index') }}" class=" {{ request()->routeIs('content-planner.index') ? '' : 'hidden' }}">Content-planner</a>
        <a href="{{ route('course') }}" class=" {{ request()->routeIs('course') ? '' : 'hidden' }}">Lesson-architect</a>
        <a href="{{ route('research.index') }}" class=" {{ request()->routeIs('research.index') ? '' : 'hidden' }}">Platform-research</a>
        <a href="{{ route('search.index') }}" class=" {{ request()->routeIs('search.index') ? '' : 'hidden' }}">Title Rank(SEO)</a>
    </div>
    <!-- SPACER -->
    <div class="grow h-full flex items-center justify-center"></div>
    <div class="flex-none h-full text-center flex items-center justify-center">

        <div class="flex space-x-3 items-center px-3 ">
            <div class="hidden sm:flex">
                <x-dropdown>
                    <x-slot name="trigger">
                        <i class='bx bx-user px-3 py-3 text-xl cursor-pointer'></i>
                    </x-slot>

                    <x-slot name="content">
                        <div class="p-3 text-blue-700"></div>
                        @if (Auth::user())
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('auth.logout') }}">
                            @csrf
                            <x-dropdown-link href="javascript:void(0)" onclick="this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                        @else
                        <x-dropdown-link :href="route('register')">
                            {{ __('Register') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('login')">
                            {{ __('Login') }}
                        </x-dropdown-link>
                        @endif
                    </x-slot>
                </x-dropdown>
            </div>

        </div>
    </div>
</div>