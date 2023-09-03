
<x-guest-layout>
    @seo([
        'title' => 'Course Dynamo',
        'description' => 'A comprehensive app for Ai course generator',
        'image' => 'https://media.istockphoto.com/id/1452604857/photo/businessman-touching-the-brain-working-of-artificial-intelligence-automation-predictive.jpg?s=612x612&w=0&k=20&c=GkAOxzduJbUKpS2-LX_l6jSKtyhdKlnPMo2ito4xpR4=',
        'type' => 'article', // You can set this to 'article', 'website', 'video', etc. depending on the type of content
        'url' => '', // Replace with the actual route for viewing the course
        'site_name' => config('app.name'),
        'favicon' => asset('images/book-cover.jpg'),
    ])
<div class="antialiased  " x-data="{ openNav: false}" >
    <div class="bg-white bg-cover bg-no-repeat h-screen " style="background-image:url('https://media.istockphoto.com/id/1452604857/photo/businessman-touching-the-brain-working-of-artificial-intelligence-automation-predictive.jpg?s=612x612&w=0&k=20&c=GkAOxzduJbUKpS2-LX_l6jSKtyhdKlnPMo2ito4xpR4=')">
        <header class="absolute inset-x-0 top-0 z-50">
            <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">Your Company</span>
                    </a>
                </div>
                <div class="flex lg:hidden">
                    <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700" @click="openNav = true">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6 text-white hover:text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
                
                <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                    @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-100 hover:text-gray-100 ">Dashboard <span aria-hidden="true">&rarr;</span></a>
                        @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-100 hover:text-gray-100 ">Log in <span aria-hidden="true">&rarr;</span></a>
                        
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-100 hover:text-gray-100 ">Register</a>
                        @endif
                        @endauth
                        @endif
                    </div>
                </div>
            </nav>
            <div class="lg:hidden" role="dialog" aria-modal="true">
                <div x-show="openNav" class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                    <div class="flex items-center justify-between">
                        <a href="#" class="-m-1.5 p-1.5">
                            <span class="sr-only">Your Company</span>
                            <!-- <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt=""> -->
                        </a>
                        <button @click="openNav = false" type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                            <span class="sr-only">Close menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="mt-6 flow-root">
                        <div class="-my-6 divide-y divide-gray-500/10">
                            <div class="space-y-2 py-6">
                                <!-- <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Product</a>
                                    <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Features</a>
                                    <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Marketplace</a>
                                    <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Company</a> -->
                                </div>
                                <div class="py-6">
                                    @if (Route::has('login'))
                                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-left z-10">
                                        @auth
                                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard <span aria-hidden="true">&rarr;</span></a>
                                        @else
                                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in <span aria-hidden="true">&rarr;</span></a>
                                        
                                        @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                                        @endif
                                    @endauth
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <p id="flipbook"></p>
            
            <div class="relative  px-6 pt-0 lg:px-8 h-screen  bg-gray-900 bg-opacity-75">
                <div class="mx-auto max-w-2xl py-32 sm:py-0 lg:py-0">
                    <div class="hidden sm:mb-8 sm:flex sm:justify-center ">
                        {{-- <div class="relative rounded-full px-3 py-1 text-sm leading-6 text-white ring-1 ring-white hover:ring-gray-900/20">
                            Announcing our next round of funding. <a href="#" class="font-semibold text-white"><span class="absolute inset-0" aria-hidden="true"></span>Read more <span aria-hidden="true">&rarr;</span></a>
                        </div> --}}
                    </div>
                    <div class="text-center mt-20">
                        <h1 class="text-4xl font-bold tracking-tight text-gray-100 sm:text-6xl mt-20 py-10">Unlock Limitless Course Content with AI-Powered Learning</h1>
                        <p class="mt-6 text-lg leading-8 text-gray-100">Discover a revolutionary app that harnesses the power of artificial intelligence to generate engaging course content instantly</p>
                        <div class="mt-10 flex items-center justify-center gap-x-6">
                            <a href="{{ route('register') }}" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Get started</a>
                            <a href="{{ route('register') }}" class="text-sm font-semibold leading-6 text-white hover:text-gray-400">Learn more <span aria-hidden="true">→</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="{{ asset('build/assets/app-dd6eec69.js') }}"></script>
    </div>
    
</x-guest-layout>
   