<x-app-layout>
    <x-notification />

    <div x-data="{ openModal: false }" class="m-4 lg:m-10 space-y-5 pb-50 ">

        @if ($errors->any())
            <div class="bg-red-300">
                <ul class="mb-4 rounded-lg bg-red-100 px-6 py-5 text-base text-red-700">
                    @foreach ($errors->all() as $error)
                        <li class="text-red-400">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- modal --}}
        <div class="fixed items-center justify-center  flex top-0 left-0 mx-auto w-full h-full bg-gray-600 bg-opacity-20 z-50 transition duration-1000 ease-in-out"
            x-show="openModal" style="display: none;">
            <div @click.away="openModal = false"
                class="bg-[#9fdfbf] w-[70%] lg:w-[40%] shadow-inner  border rounded-lg overflow-auto  pb-6 px-5 transition-all relative duration-700">
                <div class="space-y-5 py-5 ">
                    <form class="space-y-3" action="{{ route('reseller.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="name" class="input-label text-gray-600">Name</label>
                            <div class="mt-2">
                                <input id="name" name="name" value="{{ old('name') }}" type="text"
                                    autocomplete="name" class="peer h-full w-full outline-none border-none focus:none rounded-md focus:border-none focus:ring-white  text-sm  pr-2 placeholder-gray-300 placeholder:italic" placeholder="Smith Joe">
                                @error('name')
                                    <span class="text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div>
                            <label for="email" class="input-label text-gray-600">Email Address</label>
                            <div class="mt-2">
                                <input id="email" name="email" value="{{ old('email') }}" type="text"
                                    autocomplete="email" class="peer h-full w-full outline-none border-none focus:none rounded-md focus:border-none focus:ring-white  text-sm  pr-2 placeholder-gray-300 placeholder:italic" placeholder="example@gmail.com">
                                @error('email')
                                    <span class="text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between">
                                <label for="password" class="input-label text-gray-600">Password</label>
                            </div>
                            <div class="mt-2">
                                <input id="password" name="password" type="password" autocomplete="current-password"
                                    class="peer h-full w-full outline-none border-none focus:none rounded-md focus:border-none focus:ring-white  text-sm  pr-2 placeholder-gray-300 placeholder:italic" placeholder="********">
                                @error('password')
                                    <span class="text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div>
                            <div class="flex items-center justify-between">
                                <label for="password_confirmation" class="input-label text-gray-600">Password
                                    Confirmation</label>
                            </div>
                            <div class="mt-2">
                                <input id="password_confirmation" name="password_confirmation" type="password"
                                    autocomplete="current-password" class="peer h-full w-full outline-none border-none focus:none rounded-md focus:border-none focus:ring-white  text-sm  pr-2 placeholder-gray-300 placeholder:italic" placeholder="********">
                            </div>
                        </div>

                        <div class="pt-3">
                            <x-main-button type="submit" class="btn-primary2  ">Create</x-main-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div >

            <livewire:resell-table />
            
        </div>
    </div>


</x-app-layout>
