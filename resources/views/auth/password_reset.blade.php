<x-guest-layout>
    <x-notification />
    <div class="w-full h-[26rem] flex justify-center items-center">
        <div class="w-full max-w-xl xl:px-8 xl:w-5/12">
            <div class="bg-white rounded shadow-md p-7 sm:p-10">
                <h3 class="mb-4 text-xl font-semibold sm:text-center sm:mb-6 sm:text-2xl">
                    Change Your password
                </h3>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />

                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required
                            autocomplete="current-email"  placeholder="Enter your email address"/>

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('New Password')" />

                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password"  placeholder="Enter new password"/>

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ml-3">
                            {{ __('Reset') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
