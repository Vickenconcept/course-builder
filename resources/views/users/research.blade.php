<x-app-layout>
    <div class="p-2 md:px-10 text-gray-700">
        <form action="{{ route('research.store') }}" method="POST" >
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-3 mt-10 " x-data="{ firstOption: '', isSecondSelectDisabled: true }">
                @csrf
                
                <div class="w-full col-span-1">
                    <label for="platform"
                    class="block mb-2 bg-[#9fdfbf] text-blue-50 px-3 rounded shadow hover:text-white transition duration-300 py-2 text-xs">Select
                    platform</label>
                    {{-- <p class="text-gray-700">this is it:   {{ session('last_selected_option1') }}  </p> --}}
                    <select id="platform" model="firstOption" 
                    name="platform"
                        class="bg-white border mt-3 border-white  text-sm rounded-lg  block w-full p-2.5 ">
                        <option disabled class="bg-gray-100 text-white"
                            @if (session('last_selected_option1') == '') selected  @endif>-</option>
                        <option value="Udemy" @if (session('last_selected_option1') === 'Udemy') selected @endif>Udemy</option>
                        <option value="Amazon KDP" @if (session('last_selected_option1') === 'Amazon KDP') selected @endif>Amazon KDP</option>
                        <option value="Google Books" @if (session('last_selected_option1') === 'Google Books') selected @endif>Google Books
                        </option>
                        <option value=" Open Library" @if (session('last_selected_option1') === 'Open Library') selected @endif> Open Library
                        </option>

                    </select>
                </div>
                <div class="w-full col-span-1">
                    <label for="category"
                        class="block mb-2 bg-[#9fdfbf] text-blue-50 px-3 rounded shadow hover:text-white transition duration-300 py-2 text-xs">Select
                        Category</label>
                    <select id="category" @change="isSecondSelectDisabled = (firstOption === '')"  
                        name="category"
                        class="bg-white border mt-3 border-white  text-sm rounded-lg  block w-full p-2.5 ">
                        <option disabled class="bg-gray-100 text-white"
                            @if (session('last_selected_option2') == '') selected @endif>-</option>
                        <option value="Design" @if (session('last_selected_option2') === 'Design') selected @endif>Design</option>
                        <option value="Computer Science" @if (session('last_selected_option2') === 'Computer Science') selected @endif>Computer
                            Science</option>
                        <option value="Digital Marketing" @if (session('last_selected_option2') === 'Digital Marketing') selected @endif>Digital
                            Marketing</option>
                        <option value="Development" @if (session('last_selected_option2') === 'Development') selected @endif>Development
                        </option>
                        <option value="Business" @if (session('last_selected_option2') === 'Business') selected @endif>Business</option>
                        <option value="Animation" @if (session('last_selected_option2') === 'Animation') selected @endif>Animation</option>
                        <option value="Creative Writting" @if (session('last_selected_option2') === 'Creative Writting') selected @endif>Creative
                            Writting</option>
                        <option value="Art & Design" @if (session('last_selected_option2') === 'Art & Design') selected @endif>Art & Design
                        </option>
                    </select>
                    <!-- <x-main-button type="submit">search</x-main-button> -->
                </div>
                <div class=" ">
                    <label for="category"
                        class="block mb-2 bg-[#9fdfbf] text-blue-50 px-3 rounded shadow hover:text-white transition duration-300 py-2 text-xs">Search title</label>
                    <div
                        class="relative flex items-center w-full h-10 rounded-lg focus-within:shadow-lg bg-white overflow-hidden mt-3">
                        <div class="grid place-items-center h-full w-12 text-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input autocomplete="off"
                        {{-- :disabled="isSecondSelectDisabled" --}}
                            class="peer h-full w-full outline-none border-none focus:none focus:border-none focus:ring-white  text-sm  pr-2 placeholder-gray-300 placeholder:italic"
                            type="text" name="search_title" id="query" placeholder="Graphic design, writing" />
                    </div>
                </div>
            </div>
        </form>

        <div class="mt-16 ">

            <h1 class="font-bold  text-sm">Total Courses:
                @if (isset($books))
                    <span class="font-normal">{{ count($books) }} + found on {{ $platform }}</span>
                @endif
            </h1>
        </div>

        <section class="my-5 py-2 overflow-auto">
            <table class=" w-full table-fixed ">
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
                        <!-- <th class=" px-6 font-semibold firstletter:uppercase truncate w-[120px] text-sm pt-10 ">Est. Earning($)
                        </th> -->
                        <!-- <th class=" px-6 font-semibold firstletter:uppercase truncate w-[120px] text-sm pt-10 ">Students</th> -->
                        <th class=" px-6 font-semibold firstletter:uppercase truncate w-[120px] text-sm pt-10 ">Rating
                        </th>
                        <th class=" px-6 font-semibold firstletter:uppercase truncate w-[120px] text-sm pt-10 ">Price
                        </th>
                        <!-- <th class=" px-6 font-semibold firstletter:uppercase truncate w-[120px] text-sm pt-10 pr-10">Platform</th> -->
                    </tr>
                </thead>
                <tbody class="">
                    @if (isset($books))
                        @forelse($books as $book)
                            <tr
                                class="text-left border-b-2 hover:bg-white transition duration-300 shadow rounded-lg bg-transparent">
                                <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[350px]  pl-10">
                                    <a href="{{ $book['infoLink'] }}">
                                        <button class="group flex relative ">
                                            {{-- <i class='bx bx-edit text-blue-400 mr-1 '></i>  --}}
                                            About {{ $book['title'] }}
                                            <!-- <span class="bg-red-400 text-white px-2 py-1">a</span> -->
                                            <span
                                                class="group-hover:opacity-100 transition-opacity -top-6 bg-gray-800 px-1 text-xs text-gray-100 rounded-md absolute left-1/2 -translate-x-1/2 translate-y-full opacity-0 m-4 mx-auto">
                                                {{ $book['title'] }}
                                            </span>
                                        </button>
                                    </a>
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
                                <!-- <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[120px]  pr-10"><i class='bx bxs-color font-bold text-red-500 text-xl'></i>{{ $platform }}</td> -->
                            </tr>
                        @empty
                        @endforelse
                        <tr>
                            <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[120px] " colspan="3"></td>
                        </tr>
                    @endif

                    @if (!isset($books))
                        <tr class="text-left border-b-2 shadow bg-white ">
                            <td colspan="6"
                                class=" whitespace-nowrap text-sm py-5 px-3 align-top truncate w-[120px] text-center ">
                                No Book Search Yet!</td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </section>
    </div>
</x-app-layout>
