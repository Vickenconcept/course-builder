<x-app-layout>
    <div class=" p-2 md:px-10">
        <section class="flex flex-wrap my-5 -mx-2">
            <div class=" w-full lg:w-1/3 p-2 ">
                <div class="w-full md:w-1/2 lg:w-full  col-span-1 shadow rounded">
                    <form action="{{ route('search.store') }}" method="POST">
                        @csrf
                        <div class="relative flex items-center w-full h-10 rounded-lg focus-within:shadow-lg bg-white overflow-hidden">
                            <div class="grid place-items-center h-full w-12 text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input autocomplete="off" class="peer h-full w-full outline-none border-transparent focus:none focus:ring-none text-sm text-gray-700 pr-2 placeholder-gray-300" type="text" name="query" id="keywordInput" placeholder="Search..." />
                        </div>
                    </form>
                </div>
                <div id="suggestionList" class="text-gray-700 text-xs bg-white"></div>
                <!-- <p class="text-gray-700 text-xs mt-3 opacity-70">you have 26 keywords searches left this month.</p> -->
                <!-- <p class="text-gray-700 text-xs my-1 opacity-70">And you have 6 keywords searches from bought packs</p> -->
                <!-- <button class="bg-blue-800 text-blue-100 px-3 rounded-full shadow hover:shadow-lg hover:text-white transition duration-300 py-1 text-xs">Buy packs</button> -->
            </div>
            <div class="w-full md:w-1/2 lg:w-1/3 p-2 ">
                <div class="w-full p-3 bg-white rounded shadow h-56">
                    <h1 class="text-gray-700 font-semibold capitalize mb-2">Average top 10 titles <i class='bx bx-question-mark bg-gray-200 rounded-full text-white'></i></h1>
                    <div class="grid grid-cols-3 gap-5 text-gray-700">
                        <div class="bg-green-50 p-2 rounded-lg text-xs ">
                            <p class="text-xs">Search Volume</p>
                            <p class="font-semibold">
                                @if(isset($total_search))
                                <li>{{ $total_search}}</li>
                                @endif
                            </p>
                        </div>
                        <div class="bg-purple-50 p-2 rounded-lg text-xs ">
                            <p class="text-xs">Competition</p>
                            <p class="font-semibold">0.02</p>
                        </div>
                        <div class="bg-red-50 p-2 rounded-lg text-xs ">
                            <p class="text-xs">CPC</p>
                            <p class="font-semibold">$ 3.18</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2 lg:w-1/3 p-2 ">
                <div class="w-full p-3 bg-white rounded shadow h-56">
                    <h1 class="text-gray-700 font-semibold capitalize">
                        <span class="font-extrabold text-xl">
                            <span class="text-blue-600">G</span>
                            <span class="text-red-500">o</span>
                            <span class="text-yellow-500">o</span>
                            <span class="text-blue-600">g</span>
                            <span class="text-green-600">l</span>
                            <span class="text-red-500">e</span>
                        </span>
                        Trends
                    </h1>
                    <div class="w-full overflow-hidden bg-cover bg-opacity-10 bg-no-repeat object-contain p-2 relative">
                        <canvas id="lineChart" class="w-full z-10"></canvas>
                        {{-- <img src="{{ asset('images/chart.jpg') }}" style="opacity: 0.2; position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;" alt="Image"> --}}
                    </div>
                </div>
            </div>
        </section>

        <section class="py-8 overflow-x-auto">
            <!-- <button class="bg-blue-800 text-blue-100 px-3 rounded shadow hover:shadow-lg hover:text-white transition duration-300 py-2 text-xs">Pre-set filter</button> -->
            <!-- <button class="bg-transparent border-blue-800 border  rounded text-blue-800 px-3  shadow hover:shadow-lg transition duration-300 py-2 text-xs ">Export as CSV</button> -->

            <div class=" p-5 md:px-20 bg-white overflow-x-auto mt-3">
                <table class=" w-full  bg-white  table-fixed">
                    <thead>
                        <tr class="text-left border-b bg-white ">
                            <th class="text-gray-700 px-6 font-semibold firstletter:uppercase truncate w-[350px] text-sm pt-10 pl-10">Title Search</th>
                            <!-- <th class="text-gray-700 pr-6 font-semibold firstletter:uppercase text-sm w-[1000px]">Title Search</th> -->
                            <!-- <th class="text-gray-700 px-6 font-semibold firstletter:uppercase text-sm  w-[200px]">Search Trend <i class='bx bx-question-mark bg-gray-200 rounded-full text-white'></i></th> -->
                            <th class="text-gray-700 px-6 font-semibold firstletter:uppercase text-sm  w-[200px]">Monthly Average Searchs <i class='bx bx-question-mark bg-gray-200 rounded-full text-white'></i> <i class='bx bx-down-arrow-alt'></i></th>
                            <th class="text-gray-700 px-6 font-semibold firstletter:uppercase text-sm w-[120px]">CPC <i class='bx bx-question-mark bg-gray-200 rounded-full text-white'></i></th>
                            <th class="text-gray-700 px-6 font-semibold firstletter:uppercase text-sm w-[150px] pr-10">Competition <i class='bx bx-question-mark bg-gray-200 rounded-full text-white'></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($titles))
                        @forelse($titles as $title)
                        <tr class="text-left border-b hover:bg-gray-50 translate duration-300">
                            <td class="text-gray-700 whitespace-nowrap text-xs py-2 px-6 truncate w-[1000px]">
                                <span x-on:click="isOpen = true" id="{{ $title }}">{{ $title }}</span>
                                <button onclick="toCopy(document.getElementById(`{{ $title }}`))">
                                    <i class='bx bx-copy text-gray-300 text-md ml-1'></i>
                                </button>
                            </td>
                            <!-- <td class="text-gray-700 whitespace-nowrap text-xs py-2 px-6 truncate w-[200px]">
                                <canvas id="{{ $title }}" class="w-full"></canvas>
                                hellow
                            </td> -->
                            <td class="text-gray-700 whitespace-nowrap text-xs py-2 px-6 truncate w-[200px]">135,499</td>
                            <td class="text-gray-700 whitespace-nowrap text-xs py-2 px-6 truncate w-[120px]">3.0</td>
                            <td class="text-gray-700 whitespace-nowrap text-xs py-2 px-6  w-[150px] pr-10">
                                0.17 <span class="text-xs rounded-full shadow-sm lowercase border px-2 py-0.5 ml-2">low</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-gray-700 px-6 py-4 whitespace-nowrap text-sm capitalize text-center pr-10">No Data</td>
                        </tr>
                        @endforelse
                        @endif
                    </tbody>
                </table>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                var keywordInput = document.getElementById('keywordInput');
                var suggestionList = document.getElementById('suggestionList');
                var debounceTimer;

                keywordInput.addEventListener('keyup', function() {
                    var inputVal = this.value.trim(); //important
                    suggestionList.innerHTML = '';

                    clearTimeout(debounceTimer);

                    if (inputVal !== '') {
                        debounceTimer = setTimeout(function() {
                            axios.get('/suggestions', {
                                    params: {
                                        keyword: inputVal
                                    }
                                })
                                .then(function(response) {
                                    console.log(response);
                                    var suggestions = response.data.values;
                                    var list = '<ul>';

                                    for (var i = 0; i < suggestions.length; i++) {
                                        list += '<li>' + suggestions[i] + '</li>';
                                    }

                                    list += '</ul';
                                    suggestionList.innerHTML = list;

                                    var listItems = suggestionList.getElementsByTagName('li');
                                    for (var i = 0; i < listItems.length; i++) {
                                        listItems[i].addEventListener('click', function() {
                                            keywordInput.value = this.innerText;
                                        });
                                    }
                                })
                                .catch(function(error) {
                                    console.log(error);
                                });
                        }, 500); // 500ms debounce delay (adjust as needed)
                    }
                });

                // ---

                @if(isset($trend))
                const trendData = @json($trend['searchVolumes']);
                const dates = @json($trend['dates']);
                @endif

                 function extractMonthFromArray(array) {
                    const modifiedArray = array.map((item) => {
                        const parts = item.split(',');
                        const datePart = parts[0].split(' ');

                        return datePart[0]; // This will give 'july' for example
                    });

                    return modifiedArray;
                }
                const monthsArray = extractMonthFromArray(dates);


                if (typeof dates !== 'undefined' && dates.length > 0) {
                    const data = {
                        labels: monthsArray,
                        datasets: [{
                            label: "Search Volumes",
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
                }

                // for coping text
                function toCopy(copyData) {
                    var range = document.createRange();
                    range.selectNode(copyData);
                    window.getSelection().removeAllRanges();
                    window.getSelection().addRange(range);
                    document.execCommand("copy");
                    alert("copied!" );
                }



                

               
            </script>
        </section>
    </div>




</x-app-layout>