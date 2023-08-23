<x-app-layout>
    <x-notification />
    <div class=" overflow-auto p-2 md:px-10 text-gray-700" x-data="{ isOpen: false, bookData: '' }">
        <h1 class="font-bold   py-5">What course topic are you interested in?</h1>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 py-4">
            <div class=" w-full  col-span-1 rounded">
                <div class="shadow ">
                    <form action="{{ route('course-validation.create') }}" method="get">
                        @csrf
                        <div
                            class="relative flex items-center w-full h-10 rounded-lg focus-within:shadow-lg bg-white overflow-hidden">
                            <div class="grid place-items-center h-full w-12 text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input autocomplete="off"
                                class="peer h-full w-full outline-none border-none focus:none focus:border-none focus:ring-white  text-sm  pr-2 placeholder-gray-300"
                                type="text" name="query" id="query" placeholder="Search..." />
                        </div>
                    </form>
                </div>
                @if (isset($query))
                    <p class="text-xs  mt-1"><span class="font-bold">Latest search: </span>
                        @if (isset($trend) && is_array($trend))
                        @else
                            {{ $trend }} for
                        @endif
                        {{ $query }}
                    </p>
                @endif
            </div>
            <div class="flex flex-row gap-2">
                <!-- <x-main-button>Niche </x-main-button>
                <x-main-button>Topic Area</x-main-button>
                <x-main-button>Platform</x-main-button>
                <x-main-button>Enrollment</x-main-button>
                <x-main-button>Rating</x-main-button> -->
                <!-- <x-main-button>Price</x-main-button> -->

                <!-- <x-dropdown align="right">
                    <x-slot name="trigger">
                        <x-main-button class="">Niche</x-main-button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Arts & Design') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Animation') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Art & Humanities') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Audio + Music') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Business') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Business Analytics') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Craft & Maker') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Computer Science') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Creative Writting') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Data Science') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Digital Marketing') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Development') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Design') }}
                        </x-dropdown-link>

                    </x-slot>
                </x-dropdown> -->
                <!-- <x-dropdown align="right">
                    <x-slot name="trigger">
                        <x-main-button class="">Area</x-main-button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                    </x-slot>
                </x-dropdown> -->

                <!-- <x-dropdown align="right">
                    <x-slot name="trigger">
                        <x-main-button class="">Platform</x-main-button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                    </x-slot>
                </x-dropdown> -->

                <!-- <x-dropdown align="right">
                    <x-slot name="trigger">
                        <x-main-button class="">Enrollment</x-main-button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                    </x-slot>
                </x-dropdown> -->

                <!-- <x-dropdown align="right">
                    <x-slot name="trigger">
                        <x-main-button class="">Rating</x-main-button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                    </x-slot>
                </x-dropdown> -->

                <!-- <x-dropdown align="right">
                    <x-slot name="trigger">
                        <x-main-button class="">Price</x-main-button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown> -->
            </div>
        </div>
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="col-span-1 shadow-md rounded p-4  bg-white h-40">
                <h1 class="font-semibold capitalize">Summary</h1>
                <div class="grid grid-cols-2 gap-3 py-1">
                    <div class=" text-xs capitalize">Total Courses</div>
                    <div class=" text-xs">
                        @if (isset($books))
                            {{ count($books) * rand(11, 51) }}
                        @endif
                    </div>

                    <div class=" text-xs capitalize">Total students</div>
                    <div class=" text-xs">
                        @if (isset($trend) && is_array($trend))
                            {{ $trend['totalStudents'] }}
                        @endif
                    </div>
                    <!-- <div class=" text-xs capitalize">Platform</div>
                    <div class=" text-xs">5</div> -->
                    <!-- <div class=" text-xs capitalize">niches</div>
                    <div class=" text-xs">35</div> -->
                    <div class=" text-xs capitalize">Average price</div>
                    <div class=" text-xs">
                        @if (isset($trend) && is_array($trend))
                            $ {{ $trend['averagePrice'] }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-span-1 shadow-md rounded p-4 bg-white">
                <h1 class="font-semibold capitalize ">Opportunity Score</h1>
                <canvas id="myChart"></canvas>
            </div>
            <div class="col-span-1 sm:col-span-2 shadow-md rounded p-5 bg-white">
                <h1 class="font-semibold capitalize ">topic search trend</h1>

                <!-- @php
                    $imageSrc = asset('images/chart.jpg');
                @endphp -->
                <div class="w-full overflow-hidden bg-cover bg-opacity-10 bg-no-repeat object-contain p-2 relative">
                    <canvas id="lineChart" class="w-full " style=" z-index: 10;"></canvas>
                    <img src="{{ asset('images/chart.jpg') }}"
                        style="opacity: 0.2; position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;"
                        alt="Image">
                </div>
                <!-- <div class="w-full overflow-hidden bg-cover bg-opacity-50 bg-no-repeat object-contain p-2 relative" style="background-image: url('{{ $imageSrc }}');">
                    <canvas id="lineChart" class="w-full" style="z-index: 10;"></canvas>
                </div> -->




                <!-- </div> -->
                <div class="w-full bg-neutral-200 dark:bg-neutral-600 rounded-full overflow-hidden">
                    <!-- <div class="bg-blue-600 p-0.5 text-center text-[8px] font-medium leading-none text-blue-50" style="width: 45%">
                        45%
                    </div> -->
                </div>
            </div>

        </section>
        <div class="mt-12">
            <!-- <button class="bg-blue-800 text-blue-100 px-3 rounded shadow hover:shadow-lg hover:text-white transition duration-300 py-2 text-xs">Pre-set filter</button> -->
            <form action="{{ route('export.books') }}" method="get" class="inline">
                @csrf
                <button
                    class="bg-yellow-500 text-white px-3  shadow hover:shadow-lg transition duration-300 py-2 text-xs">Export
                    as CSV</button>
            </form>
        </div>
        <section class="py-2 overflow-x-auto ">
            <table class=" w-full mt-3  table-fixed ">
                <thead>
                    <tr class="text-left border-b-2 hover:bg-white transition duration-300 shadow bg-white ">
                        <th class=" px-6 font-semibold firstletter:uppercase truncate w-[350px] text-sm pt-10 pl-10">
                            Title</th>
                        <th class=" px-6 font-semibold firstletter:uppercase truncate w-[120px] text-sm pt-10 ">Niche
                        </th>
                        <th class=" px-6 font-semibold firstletter:uppercase truncate w-[150px] text-sm pt-10 ">
                            Sub-category</th>
                        <th class=" px-6 font-semibold firstletter:uppercase truncate w-[200px] text-sm pt-10 ">Topic
                        </th>
                        <!-- <th class=" px-6 font-semibold firstletter:uppercase truncate w-[120px] text-sm pt-10 ">Duration(hr)
                        </th> -->
                        <!-- <th class=" px-6 font-semibold firstletter:uppercase truncate w-[120px] text-sm pt-10 ">Est. Earning($) -->
                        </th>
                        <!-- <th class=" px-6 font-semibold firstletter:uppercase truncate w-[120px] text-sm pt-10 ">Students</th> -->
                        <th class=" px-6 font-semibold firstletter:uppercase truncate w-[120px] text-sm pt-10 ">Rating
                        </th>
                        <th class=" px-6 font-semibold firstletter:uppercase truncate w-[120px] text-sm pt-10 ">
                            Price($)</th>
                        <!-- <th class=" px-6 font-semibold firstletter:uppercase truncate w-[120px] text-sm pt-10 pr-10">Platform</th> -->
                    </tr>
                </thead>
                <tbody class="">

                    @if (isset($books))
                        @forelse($books as $book)
                            <tr
                                class="text-left border-b-2 hover:bg-white transition duration-300 shadow rounded-lg bg-transparent">
                                <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[350px]  pl-10">
                                    {{-- <button class="group flex relative " x-on:click="isOpen = true"> --}}
                                    <button class="group flex relative "
                                        x-on:click="isOpen = true ; bookData = @js($book)">
                                        <i class='bx bx-edit text-blue-400 mr-1 '></i> About {{ $book['title'] }}
                                        <!-- <span class="bg-red-400 text-white px-2 py-1">Button</span> -->
                                        <span
                                            class="group-hover:opacity-100 transition-opacity -top-6 bg-gray-800 px-1 text-xs text-gray-100 rounded-md absolute left-1/2 -translate-x-1/2 translate-y-full opacity-0 m-4 mx-auto">
                                            {{ $book['title'] }}
                                        </span>
                                    </button>
                                </td>
                                <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[120px] ">
                                    {{ $book['category'] }}</td>
                                <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[150px] ">
                                    {{ $book['category'] }}</td>
                                <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[200px] ">
                                    {{ $book['title'] }}</td>
                                <!-- <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[120px] ">8.15</td> -->
                                <!-- <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[120px] ">3.99</td> -->
                                <!-- <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[120px] ">438,216</td> -->
                                <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[120px] ">
                                    {{ $book['rating'] }}</td>
                                <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[120px] ">
                                    {{ $book['price'] <= 10 ? 'free' : $book['price'] }}</td>
                                <!-- <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[120px]  pr-10"><i class='bx bxs-color font-bold text-red-500 text-xl'></i></td> -->
                            </tr>
                        @empty
                            <tr>
                                <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[120px] " colspan="3">
                                    no data</td>
                            </tr>
                        @endforelse
                    @endif

                    @if (!isset($books))
                        <tr class="text-left border-b-2 shadow bg-white ">
                            <td colspan="10"
                                class=" whitespace-nowrap text-sm py-5 px-3 align-top truncate w-[120px] text-center ">
                                No Book Search Yet!</td>

                        </tr>
                    @endif
                </tbody>
            </table>
        </section>


        <x-main-modal x-data="{ data: bookData }">

            <form action="{{ route('course-validation.store') }}" method="POST" id="myForm" class="hidden">
                @csrf
                <input type="text" :value="bookData.title" name="title">
                <input type="text" :value="bookData.author" name="author">
                <input type="text" :value="bookData.description" name="description">
                <input type="text" :value="bookData.category" name="category">
                <input type="text" :value="bookData.rating" name="rating">
                <input type="text" :value="bookData.subtitle" name="subtitle">
                <input type="text" :value="bookData.isbn" name="isbn">
                <input type="text" :value="bookData.page_count" name="pages">
                <input type="text" :value="bookData.infoLink" name="infolink">
            </form>
            <div class="h-96">
                <h2 class="text-gray-700 first-letter:uppercase font-semibold text-md border-t py-3">Add New Category
                </h2>
                <x-main-button onClick="document.getElementById('myForm').submit()">Save Course To
                    Libray</x-main-button>
                <a :href="bookData.infoLink" target="_blank">
                    <h3 class="my-3 underline text-2xl font-bold" x-text="bookData.title"></h3>
                </a>
                <p x-text="bookData.description" class="text-gray-400 text-sm truncate w-[80%]"></p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 py-10">
                    <div>
                        <h4 class="font-semibold mb-3">Details</h4>
                        <p class=" text-gray-700 my-2"> Instructor: <span class="ml-5 "
                                x-text="bookData.author"></span></p>
                        <p class=" text-gray-700 my-2"> Subcategory: <span class="ml-5 "
                                x-text="bookData.category"></span></p>
                        {{-- <p class=" text-gray-700 my-2"> Platform: <span class="ml-5 " x-text ="bookData.author"></span></p> --}}
                        <p class=" text-gray-700 my-2"> Niche: <span class="ml-5 " x-text="bookData.category"></span>
                        </p>
                        <p class=" text-gray-700 my-2"> Topic: <span class="ml-5 " x-text="bookData.title"></span>
                        </p>
                        <p class=" text-gray-700 my-2"> Subtitle: <span class="ml-5 "
                                x-text="bookData.subtitle"></span></p>
                        <p class=" text-gray-700 my-2"> Price: <span class="ml-5 " x-text="bookData.price"></span>
                        </p>
                        <p class=" text-gray-700 my-2"> Rating: <span class="ml-5 " x-text="bookData.rating"></span>
                        </p>
                        <p class=" text-gray-700 my-2"> ISBN: <span class="ml-5 " x-text="bookData.isbn"></span></p>
                        <p class=" text-gray-700 my-2"> Pages: <span class="ml-5 "
                                x-text="bookData.page_count"></span></p>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-3">Description</h4>
                        <p class=" text-gray-700 my-2"x-text="bookData.description"></p>
                    </div>
                    <div>
                    </div>
                </div>

            </div>



        </x-main-modal>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        @if (isset($trend) && is_array($trend))
            const trendData = @json($trend['searchVolumes']);
            const dates = @json($trend['dates']);
            const opportunityScore = @json($trend['opportunityScore']);
        @endif

        const data = {
            labels: dates,
            datasets: [{
                label: "Search Trend",
                fill: true,
                lineTension: 0,
                backgroundColor: "lightblue",
                borderColor: "rgba(0,0,255,0.1)",
                data: trendData,
                // data: [7, 8, 9, 9, 14, 14, 15],
            }],
        };
        const configLineChart = {
            type: "line",
            data,
            options: {},
        };
        var chartLine = new Chart("lineChart", configLineChart);


        // --

        // Calculate the degree based on opportunity score (max 360 degrees)
        var degree = Math.min(opportunityScore * 330, 360);
        const dataDoughnut = {
            labels: ['Opportunity', 'Remaining'],
            datasets: [{
                label: "My Score",
                data: [degree, 360 - degree],
                backgroundColor: ['lightblue', '#e0e0e0'],
                hoverOffset: 4,
            }, ],
        };

        const configDoughnut = {
            type: "doughnut",
            data: dataDoughnut,
            options: {},
        };
        var chartBar = new Chart(
            document.getElementById("myChart"),
            configDoughnut
        );
    </script>

</x-app-layout>
