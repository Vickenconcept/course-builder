<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <x-notification />
    <div class="relative h-screen bg-cover bg-no-repeat "
        style="background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTpIPKAIdz6p4WYQDW22q0YjSP17ysWhG_-BQ&usqp=CAU')">
        <div class="relative h-screen bg-gray-900 bg-opacity-75">
            <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
                <div class="flex flex-col items-center justify-between ">
                    <div class="w-full max-w-xl mb-12 xl:mb-0 xl:pr-16 xl:w-7/12 py-5">
                        {{-- <h2
                            class="max-w-lg  font-sans text-3xl font-bold tracking-tight text-white sm:text-4xl sm:leading-none text-center">
                            Unlock Limitless Course Content with AI-Powered Learning<br class="hidden md:block" />
                        </h2> --}}
                       
                    </div>
                    <div class="w-full max-w-xl ">
                        <div class="bg-white rounded shadow-2xl p-7 sm:p-10">
                            <h3 class="mb-4 text-xl font-semibold sm:text-center sm:mb-6 sm:text-2xl">
                                Welcome, Sign In
                            </h3>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="Enter Your Email"
                                        :value="old('email')" required autofocus autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="password" :value="__('Password')" />

                                    <x-text-input id="password" class="block mt-1 w-full" type="password"
                                        name="password" required autocomplete="current-password" placeholder="*****" />

                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                {{-- <div class="block mt-4">
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    href="{{ route('register') }}">
                                    {{ __("Don't have account, register?") }}
                                </a>
                                </div> --}}

                                <div class="flex items-center justify-end mt-4">
                                    @if (Route::has('password.request'))
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                            href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif
                                    
                                    
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        href="{{ route('password.reset') }}">
                                        {{ __('Forgotten password?') }}
                                    </a>

                                    <x-primary-button class="ml-3">
                                        {{ __('Log in') }}
                                    </x-primary-button>
                                </div>
                              
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
