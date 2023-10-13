<x-app-layout>
    <x-notification />
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
    <div class="grid  grid-cols-1 md:grid-cols-3 gap-5 px-5" x-data="{ selected: '' }">
        <div class="col-span-1 grid gap-5 rounded-lg">
            <!-- component -->
            <div class="bg-gray-200 min-h-screen pt-2 font-mono mb-16">
                <div class="container mx-auto">
                    <div class="inputs w-full max-w-2xl p-6 mx-auto">
                        <h2 class="text-2xl text-gray-900"><i class='bx bxs-cog text-4xl'></i>Account Setting</h2>
                        <div class="mt-6 border-t border-gray-400 pt-4">
                            <div class='flex flex-wrap -mx-3 mb-6'>




                                {{--  --}}
                                <div x-data="{ isOpen: true }" class=" my-5 bg-white w-full rounded">
                                    <button @click="isOpen = !isOpen"
                                        class="bg-transparent border-none text-gray-700 py-2 px-4 cursor-pointer font-bold underline"></button>
                                    <div x-show="isOpen" class="p-4 w-full">
                                        <ul class="list-none p-0 text-gray-700 w-full text-[#339966]">
                                            <a href="#"
                                                class="  hover:bg-[#39ac73] text-[#339966] flex hover:text-white w-full block rounded-full translate duration-300 px-3 py-2"
                                                class="" @click="selected = 'openMailChimp'"><i
                                                    class='bx bxl-mailchimp text-xl mr-.5 '></i>MailChimp</a>
                                            <a href="#"
                                                class="  hover:bg-[#39ac73] text-[#339966] flex hover:text-white w-full block rounded-full translate duration-300 px-3 py-2"
                                                @click="selected = 'getResponse' "><i
                                                    class='bx bxs-shopping-bag-alt text-xl mr-.5 '></i>Get Response</a>
                                            <a href="#"
                                                class="  hover:bg-[#39ac73] text-[#339966] flex hover:text-white w-full block rounded-full translate duration-300 px-3 py-2"
                                                @click="selected = 'convert' "><i
                                                    class='bx bxs-shopping-bag-alt text-xl mr-.5 '></i>ConvertKit</a>
                                            <a href="#"
                                                class="  hover:bg-[#39ac73] text-[#339966] flex hover:text-white w-full block rounded-full translate duration-300 px-3 py-2"
                                                @click="selected = 'paypal' "><i
                                                    class='bx bxl-paypal text-xl mr-.5 '></i>Paypal</a>
                                        </ul>
                                    </div>
                                </div>
                                {{-- <div class='w-full md:w-full px-3 mb-6'>
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
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="bg-red-400 p-10">
                c,cx,
            </div> --}}
        </div>

        <div class="col-span-2 rounded-lg">
            <!-- component -->
            <div class="bg-gray-200 min-h-screen pt-2 font-mono mb-16">
                <div class="container mx-auto">
                    <div class="inputs w-full max-w-2xl p-6 mx-auto">
                        <h2 class="text-2xl text-gray-900">Account Setting</h2>
                        <div class="mt-6 border-t border-gray-400 pt-4">
                            {{--  --}}
                            <div class='flex flex-wrap -mx-3 my-6  border-t border-b border-gray-400'>

                                <div class="personal w-full pt-4 ">
                                    <h2 class="text-2xl text-gray-900">Personal info:</h2>
                                    <div class="flex items-center justify-between mt-4">
                                        <div class='w-full md:w-1/2 px-3 mb-6'>
                                            <label
                                                class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>
                                                Name</label>
                                            <input
                                                class='appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-400 shadow-inner rounded-md py-2 px-4 leading-tight focus:outline-none  focus:border-gray-500'
                                                type='text' value="{{ auth()->user()->name }}" disabled>
                                        </div>
                                        <div class='w-full md:w-1/2 px-3 mb-6'>
                                            <label
                                                class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>
                                                Email Address</label>
                                            <input
                                                class='appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-400 shadow-inner rounded-md py-2 px-4 leading-tight focus:outline-none  focus:border-gray-500'
                                                type='text' value="{{ auth()->user()->email }}" disabled>
                                        </div>
                                    </div>

                                </div>
                            </div>



                            {{--  --}}
                            <div x-show="selected === 'openMailChimp'" class="mb-6">
                                <h1 class="text-2xl text-gray-900 my-4">Mailchimp Credentials</h1>
                                <form action="{{ route('setting.store') }}" method="POST">
                                    @csrf
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                        <div class='w-full md:w-full inline  mb-6'>
                                            <label
                                                class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'
                                                for='grid-text-1'>API Key </label>
                                            <input
                                                class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-2 px-4 leading-tight focus:outline-none  focus:border-gray-500'
                                                id='grid-text-1' type='text' placeholder='Enter API key'
                                                name="mailchimp_api_key"
                                                value="{{ auth()->user()->setting->mailchimp_api_key ?? '' }}">
                                            <label class='block  tracking-wide text-gray-700 text-xs  mb-2'
                                                for='grid-text-1'>Leave empty to disable mailchimp integration </label>
                                        </div>
                                        <div class='w-full md:w-full inline px-3 mb-6'>
                                            <label
                                                class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'
                                                for='grid-text-1'>Prefix</label>
                                            <input
                                                class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-2 px-4 leading-tight focus:outline-none  focus:border-gray-500'
                                                id='grid-text-1' type='text' placeholder='Enter prefix eg. us21'
                                                name="mailchimp_prefix_key"
                                                value="{{ auth()->user()->setting->mailchimp_prefix_key ?? '' }}">
                                            <label class='block  tracking-wide text-gray-700 text-xs  mb-2'
                                                for='grid-text-1'>Ensure to add the List/Audience ID. How to get these
                                                details <a
                                                    href="https://mailchimp.com/developer/guides/manage-subscribers-with-the-mailchimp-api/#Before_you_start"
                                                    class="text-[#339966] text-xs  underline font-bold" target="_blank">
                                                    Mailchimp Documentation</a> </label>
                                        </div>
                                    </div>
                                    <x-main-button type="submit">submit</x-main-button>

                                </form>
                            </div>
                            {{--  --}}

                            <div x-show="selected === 'convert'" class="mt-5">
                                <h1 class="text-2xl text-gray-900 my-4">ConvertKit credentials </h1>
                                <form action="{{ route('setting.saveConvert') }}" method="POST">
                                    @csrf
                                    <div class="">

                                        <div class=' inline px-3 mb-6'>
                                            <label
                                                class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'
                                                for='grid-text-1'>API_Key</label>
                                            <input
                                                class='appearance-none  bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-2 px-4 leading-tight focus:outline-none  focus:border-gray-500'
                                                id='grid-text-1' type='text' placeholder='Enter API key'
                                                name="convert_api_key"
                                                value="{{ auth()->user()->setting->convert_api_key ?? '' }}">
                                            <label class='block  tracking-wide text-gray-700 text-xs  mb-2'
                                                for='grid-text-1'>Leave empty to disable Convert Kit <br>
                                                integration. How to get these details <br><a href="#"
                                                    class="text-[#339966] text-xs  underline font-bold"
                                                    target="_blank">
                                                    Convert Kit Documentation</a> </label>
                                            <x-main-button type="submit">submit</x-main-button>
                                        </div>
                                    </div>
                                </form>
                            </div>


                            {{--  --}}
                            <div x-show="selected === 'paypal'" class="mt-5">
                                <h1 class="text-2xl text-gray-900 my-4">Paypal credentials </h1>
                                <form action="{{ route('setting.paypalData') }}" method="POST">
                                    {{-- @method('PUT') --}}
                                    @csrf
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                        <div class='w-full md:w-full inline  mb-6'>
                                            <label
                                                class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'
                                                for='grid-text-1'>API_USERNAME</label>
                                            <input
                                                class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-2 px-4 leading-tight focus:outline-none  focus:border-gray-500'
                                                id='grid-text-1' type='text' placeholder='Enter API username'
                                                name="paypal_api_username"
                                                value="{{ auth()->user()->setting->paypal_api_username ?? '' }}">
                                        </div>
                                        <div class='w-full md:w-full inline px-3 mb-6'>
                                            <label
                                                class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'
                                                for='grid-text-1'>API_PASSWORD</label>
                                            <input
                                                class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-2 px-4 leading-tight focus:outline-none  focus:border-gray-500'
                                                id='grid-text-1' type='text' placeholder='Enter password'
                                                name="paypal_api_password"
                                                value="{{ auth()->user()->setting->paypal_api_password ?? '' }}">
                                        </div>
                                        <div class='w-full md:w-full inline px-3 mb-6'>
                                            <label
                                                class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'
                                                for='grid-text-1'>API_SECRET</label>
                                            <input
                                                class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-2 px-4 leading-tight focus:outline-none  focus:border-gray-500'
                                                id='grid-text-1' type='text' placeholder='Enter secret'
                                                name="paypal_api_secret"
                                                value="{{ auth()->user()->setting->paypal_api_secret ?? '' }}">
                                                <label class='block  tracking-wide text-gray-700 text-xs  mb-2'
                                                for='grid-text-1'> How to get these details <br><a href="https://www.paypal.com/businessprofile/mytools/apiaccess/firstparty/signature"
                                                    class="text-[#339966] text-xs  underline font-bold"
                                                    target="_blank">
                                                    PayPal Documentation</a> </label>
                                        </div>
                                    </div>
                                    <x-main-button type="submit">submit</x-main-button>

                                </form>
                            </div>
                            {{--  --}}

                            {{--  --}}
                            <div x-show="selected === 'getResponse' " class="mt-5">
                                <h1 class="text-2xl text-gray-900 my-4">Get Response credentials </h1>
                                <form action="{{ route('setting.saveGetResponseData') }}" method="POST">
                                    @csrf
                                    <div class="">

                                        <div class=' inline px-3 mb-6'>
                                            <label
                                                class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'
                                                for='grid-text-1'>API_Key</label>
                                            <input
                                                class='appearance-none  bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-2 px-4 leading-tight focus:outline-none  focus:border-gray-500'
                                                id='grid-text-1' type='text' placeholder='Enter API key'
                                                name="get_response_api_key"
                                                value="{{ auth()->user()->setting->get_response_api_key ?? '' }}">
                                            <label class='block  tracking-wide text-gray-700 text-xs  mb-2'
                                                for='grid-text-1'>Leave empty to disable Get Response <br>
                                                integration. How to get these details <br><a
                                                    href="https://apireference.getresponse.com/?_ga=2.9720757.1698919484.1695829305-332518786.1695383287&_gl=1*1riizxp*_ga*MzMyNTE4Nzg2LjE2OTUzODMyODc.*_ga_EQ6LD9QEJB*MTY5NTg4NjEwNC4xNC4xLjE2OTU4ODY5NjIuNDMuMC4w*_ga_MWJQ4HH5SL*MTY5NTg4NjEwNC4xNC4xLjE2OTU4ODY5NjIuMC4wLjA.#section/Authentication"
                                                    class="text-[#339966] text-xs  underline font-bold"
                                                    target="_blank">
                                                    Get Response Documentation</a> </label>
                                            <x-main-button type="submit">submit</x-main-button>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                            {{--  --}}

                            {{--  --}}

                            {{-- <div x-show="selected === 'convert' " class="mt-5">
                                <h1 class="text-2xl text-gray-900 my-4">ConvertKit credentials </h1>
                                <form action="{{ route('setting.saveConvert') }}" method="POST">
                                    @csrf
                                    <div class="">

                                        <div class=' inline px-3 mb-6'>
                                            <label
                                                class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'
                                                for='grid-text-1'>API_Key</label>
                                            <input
                                                class='appearance-none  bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-2 px-4 leading-tight focus:outline-none  focus:border-gray-500'
                                                id='grid-text-1' type='text' placeholder='Enter API key'
                                                name="get_response_api_key"
                                                value="{{ auth()->user()->setting->convert_api_key ?? '' }}">
                                            <label class='block  tracking-wide text-gray-700 text-xs  mb-2'
                                                for='grid-text-1'>Leave empty to disable Convert Kit <br>
                                                integration. How to get these details <br><a href="#"
                                                    class="text-[#339966] text-xs  underline font-bold"
                                                    target="_blank">
                                                    Convert Kit Documentation</a> </label>
                                            <x-main-button type="submit">submit</x-main-button>
                                        </div>
                                </form>
                            </div> --}}
                            {{--  --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
