<x-app-layout>
    <x-notification />
        <div class="grid  grid-cols-1 md:grid-cols-3 gap-5 px-5" x-data="{ openMailChimp: false}">
            <div class="col-span-1 grid gap-5">
                <!-- component -->
                <div class="bg-gray-200 min-h-screen pt-2 font-mono my-16">
                    <div class="container mx-auto">
                        <div class="inputs w-full max-w-2xl p-6 mx-auto">
                            <h2 class="text-2xl text-gray-900">Account Setting</h2>
                            <div class="mt-6 border-t border-gray-400 pt-4">
                                <div class='flex flex-wrap -mx-3 mb-6'>
                                    
                                    {{--  --}}
                                    {{-- <form action="{{ route('setting.store') }}" method="POST">
                                        @csrf
                                        <div class='w-full md:w-full px-3 mb-6'>
                                            <label
                                                class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'
                                                for='grid-text-1'>API Key </label>
                                            <input
                                                class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-2 px-4 leading-tight focus:outline-none  focus:border-gray-500'
                                                id='grid-text-1' type='text' placeholder='Enter API key' 
                                                name="mailchimp_api_key">
                                        </div>
                                        <div class='w-full md:w-full px-3 mb-6'>
                                            <label
                                                class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'
                                                for='grid-text-1'>Prefix</label>
                                            <input
                                                class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-2 px-4 leading-tight focus:outline-none  focus:border-gray-500'
                                                id='grid-text-1' type='text' placeholder='Enter prefix eg. us21'
                                                 name="mailchimp_prefix_key">
                                        </div>
                                        <div class='w-full md:w-full px-3 mb-6 '>
                                            <button type="submit"
                                                class="appearance-none bg-gray-200 text-gray-900 px-2 py-1 shadow-sm border border-gray-400 rounded-md ">Submit</button>
                                        </div>
                                    </form> --}}
                                    {{--  --}}        
                                    
                                    {{--  --}}
                                    <div x-data="{ isOpen: false }" class=" ">
                                        <button @click="isOpen = !isOpen" class="bg-transparent border-none text-gray-700 py-2 px-4 cursor-pointer font-bold underline"><i class='bx bxs-envelope mr-1'></i>ESP </button>
                                        <div x-show="isOpen" class="p-4">
                                            <ul class="list-none p-0 text-gray-700">
                                                <li class="mb-2"><a href="#" class=" no-underline" class="" @click="openMailChimp = !openMailChimp"><i class='bx bx-envelope mr-1'></i>MailChimp</a></li>
                                                <li class="mb-2"><a href="#" class=" no-underline"><i class='bx bx-envelope mr-1'></i>About</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class='w-full md:w-full px-3 mb-6'>
                                        <label
                                            class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>pick
                                            your country</label>
                                        <div class="flex-shrink w-full inline-block relative">
                                            <select
                                                class="block appearance-none text-gray-600 w-full bg-white border border-gray-400 shadow-inner px-4 py-2 pr-8 rounded">
                                                <option>choose ...</option>
                                                <option>USA</option>
                                                <option>France</option>
                                                <option>Spain</option>
                                                <option>UK</option>
                                            </select>
                                            <div
                                                class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='w-full md:w-full px-3 mb-6'>
                                        <label
                                            class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>fav
                                            language</label>
                                        <div class="flex-shrink w-full inline-block relative">
                                            <select
                                                class="block appearance-none text-gray-600 w-full bg-white border border-gray-400 shadow-inner px-4 py-2 pr-8 rounded">
                                                <option>choose ...</option>
                                                <option>English</option>
                                                <option>France</option>
                                                <option>Spanish</option>
                                            </select>
                                            <div
                                                class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-red-400 p-10">
                    c,cx,
                </div>
            </div>

            <div class="col-span-2">
                <!-- component -->
                <div class="bg-gray-200 min-h-screen pt-2 font-mono my-16">
                    <div class="container mx-auto">
                        <div class="inputs w-full max-w-2xl p-6 mx-auto">
                            <h2 class="text-2xl text-gray-900">Account Setting</h2>
                            <div class="mt-6 border-t border-gray-400 pt-4">
                                {{--  --}}
                                <div x-show="openMailChimp">
                                <form  action="{{ route('setting.store') }}" method="POST">
                                    @csrf
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                        <div class='w-full md:w-full inline  mb-6'>
                                            <label
                                                class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'
                                                for='grid-text-1'>API Key </label>
                                            <input
                                                class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-2 px-4 leading-tight focus:outline-none  focus:border-gray-500'
                                                id='grid-text-1' type='text' placeholder='Enter API key' 
                                                name="mailchimp_api_key" value="{{ auth()->user()->setting->mailchimp_api_key ?? '' }}" @if ($formSubmitted) disabled @endif>
                                        </div>
                                        <div class='w-full md:w-full inline px-3 mb-6'>
                                            <label
                                                class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'
                                                for='grid-text-1'>Prefix</label>
                                            <input
                                                class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-2 px-4 leading-tight focus:outline-none  focus:border-gray-500'
                                                id='grid-text-1' type='text' placeholder='Enter prefix eg. us21'
                                                 name="mailchimp_prefix_key " value="{{ auth()->user()->setting->mailchimp_prefix_key ?? '' }}" @if ($formSubmitted) disabled @endif>
                                        </div>
                                    </div>
                                    <button type="submit">submit</button>
                                  
                                </form>
                                </div>
                                {{--  --}}
                                <div class='flex flex-wrap -mx-3 mb-6'>
                                    <div class='w-full md:w-full px-3 mb-6'>
                                        <label
                                            class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'
                                            for='grid-text-1'>email address</label>
                                        <input
                                            class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-2 px-4 leading-tight focus:outline-none  focus:border-gray-500'
                                            id='grid-text-1' type='text' placeholder='Enter email' >
                                    </div>
                                    <div class='w-full md:w-full px-3 mb-6 '>
                                        <label
                                            class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>password</label>
                                        <button
                                            class="appearance-none bg-gray-200 text-gray-900 px-2 py-1 shadow-sm border border-gray-400 rounded-md ">change
                                            your password</button>
                                    </div>
                                    <div class='w-full md:w-full px-3 mb-6'>
                                        <label
                                            class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>pick
                                            your country</label>
                                        <div class="flex-shrink w-full inline-block relative">
                                            <select
                                                class="block appearance-none text-gray-600 w-full bg-white border border-gray-400 shadow-inner px-4 py-2 pr-8 rounded">
                                                <option>choose ...</option>
                                                <option>USA</option>
                                                <option>France</option>
                                                <option>Spain</option>
                                                <option>UK</option>
                                            </select>
                                            <div
                                                class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='w-full md:w-full px-3 mb-6'>
                                        <label
                                            class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>fav
                                            language</label>
                                        <div class="flex-shrink w-full inline-block relative">
                                            <select
                                                class="block appearance-none text-gray-600 w-full bg-white border border-gray-400 shadow-inner px-4 py-2 pr-8 rounded">
                                                <option>choose ...</option>
                                                <option>English</option>
                                                <option>France</option>
                                                <option>Spanish</option>
                                            </select>
                                            <div
                                                class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="personal w-full border-t border-gray-400 pt-4">
                                        <h2 class="text-2xl text-gray-900">Personal info:</h2>
                                        <div class="flex items-center justify-between mt-4">
                                            <div class='w-full md:w-1/2 px-3 mb-6'>
                                                <label
                                                    class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>first
                                                    name</label>
                                                <input
                                                    class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-2 px-4 leading-tight focus:outline-none  focus:border-gray-500'
                                                    type='text' >
                                            </div>
                                            <div class='w-full md:w-1/2 px-3 mb-6'>
                                                <label
                                                    class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>last
                                                    name</label>
                                                <input
                                                    class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-2 px-4 leading-tight focus:outline-none  focus:border-gray-500'
                                                    type='text' >
                                            </div>
                                        </div>
                                        <div class='w-full md:w-full px-3 mb-6'>
                                            <label
                                                class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>user
                                                name</label>
                                            <input
                                                class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-2 px-4 leading-tight focus:outline-none  focus:border-gray-500'
                                                type='text' >
                                        </div>
                                        <div class='w-full md:w-full px-3 mb-6'>
                                            <label
                                                class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>Bio</label>
                                            <textarea
                                                class='bg-gray-100 rounded-md border leading-normal resize-none w-full h-20 py-2 px-3 shadow-inner border border-gray-400 font-medium placeholder-gray-700 focus:outline-none focus:bg-white'
                                                ></textarea>
                                        </div>
                                        <div class="flex justify-end">
                                            <button
                                                class="appearance-none bg-gray-200 text-gray-900 px-2 py-1 shadow-sm border border-gray-400 rounded-md mr-3"
                                                type="submit">save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

</x-app-layout>
