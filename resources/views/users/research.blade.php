<x-app-layout>
    <div class="p-2 md:px-10 text-gray-700">
        <form action="{{ route('research.create') }}" method="get">
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-3 mt-10 " x-data="{ firstOption: '', isSecondSelectDisabled: true }">
                @csrf

                <div class="w-full col-span-1">
                    <label for="countries" class="block mb-2 bg-yellow-800/50 text-blue-50 px-3 rounded shadow hover:text-white transition duration-300 py-2 text-xs">Select platform</label>
                    <select id="countries" x-model="firstOption" @change="isSecondSelectDisabled = (firstOption === '')" name="platform" class="bg-white border mt-3 border-white  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-blue-600 dark:placeholder-blue-400  dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected  class="bg-gray-100 text-white">Udamy</option>
                        <option value="Udamy">Udamy</option>
                        <option value="Amazon KDP">Amazon KDP</option>
                        <option value="Google Books">Google Books</option>
                        <option value=" Open Library"> Open Library</option>
                    </select>
                </div>
                <div class="w-full col-span-1">
                    <label for="countries" class="block mb-2 bg-yellow-800/50 text-blue-50 px-3 rounded shadow hover:text-white transition duration-300 py-2 text-xs">Select Category</label>
                    <select id="countries" :disabled="isSecondSelectDisabled" onchange="this.closest('form').submit()" name="category" class="bg-white border mt-3 border-white  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-blue-600 dark:placeholder-blue-400  dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected disabled class="bg-gray-100 text-white">Design</option>
                        <option value="Design">Design</option>
                        <option value="Computer Science">Computer Science</option>
                        <option value="Digital Marketing">Digital Marketing</option>
                        <option value="Development">Development</option>
                        <option value="Business">Business</option>
                        <option value="Animation">Animation</option>
                        <option value="Creative Writting">Creative Writting</option>
                        <option value="Art & Design">Art & Design</option>
                    </select>
                    <!-- <x-main-button type="submit">search</x-main-button> -->
                </div>
            </div>
        </form>

        <div class="mt-16 ">

            <h1 class="font-bold  text-sm">Total Courses:
                @if(isset($books))
                <span class="font-normal">{{ count($books) }} + found on {{ $platform }}</span>
                @endif
            </h1>
        </div>

        <section class="my-5 py-2 overflow-auto">
            <table class=" w-full table-fixed ">
                <thead>
                    <tr class="text-left border-b-2 hover:bg-white transition duration-300 shadow bg-white ">
                        <th class=" px-6 font-semibold firstletter:uppercase truncate w-[350px] text-sm pt-10 pl-10">Title</th>
                        <th class=" px-6 font-semibold firstletter:uppercase truncate w-[120px] text-sm pt-10 ">Niche</th>
                        <th class=" px-6 font-semibold firstletter:uppercase truncate w-[150px] text-sm pt-10 ">Sub-category</th>
                        <th class=" px-6 font-semibold firstletter:uppercase truncate w-[200px] text-sm pt-10 ">Topic</th>
                        <!-- <th class=" px-6 font-semibold firstletter:uppercase truncate w-[120px] text-sm pt-10 ">Duration(hr)
                        </th> -->
                        <!-- <th class=" px-6 font-semibold firstletter:uppercase truncate w-[120px] text-sm pt-10 ">Est. Earning($)
                        </th> -->
                        <!-- <th class=" px-6 font-semibold firstletter:uppercase truncate w-[120px] text-sm pt-10 ">Students</th> -->
                        <th class=" px-6 font-semibold firstletter:uppercase truncate w-[120px] text-sm pt-10 ">Rating</th>
                        <th class=" px-6 font-semibold firstletter:uppercase truncate w-[120px] text-sm pt-10 ">Price</th>
                        <!-- <th class=" px-6 font-semibold firstletter:uppercase truncate w-[120px] text-sm pt-10 pr-10">Platform</th> -->
                    </tr>
                </thead>
                <tbody class="">
                    @if(isset($books))
                    @forelse($books as $book)
                    <tr class="text-left border-b-2 hover:bg-white transition duration-300 shadow rounded-lg bg-transparent">
                        <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[350px]  pl-10">
                            <button class="group flex relative ">
                                <i class='bx bx-edit text-blue-400 mr-1 '></i> About {{ $book['title'] }}
                                <!-- <span class="bg-red-400 text-white px-2 py-1">a</span> -->
                                <span class="group-hover:opacity-100 transition-opacity -top-6 bg-gray-800 px-1 text-xs text-gray-100 rounded-md absolute left-1/2 -translate-x-1/2 translate-y-full opacity-0 m-4 mx-auto">
                                    {{ $book['title'] }}
                                </span>
                            </button>
                        </td>
                        <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[120px] ">{{ $book['category'] }}</td>
                        <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[150px] ">{{ $book['category'] }}</td>
                        <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[200px] ">{{ $book['title'] }}</td>
                        <!-- <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[120px] ">8.15</td> -->
                        <!-- <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[120px] ">3.99</td> -->
                        <!-- <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[120px] ">438,216</td> -->
                        <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[120px] ">{{ $book['rating']}}</td>
                        <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[120px] ">{{ $book['price'] <= 10 ? 'free': $book['price']}}</td>
                        <!-- <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[120px]  pr-10"><i class='bx bxs-color font-bold text-red-500 text-xl'></i>{{ $platform }}</td> -->
                    </tr>
                    @empty
                    @endforelse
                    <tr>
                        <td class=" whitespace-nowrap text-xs py-2 px-6  truncate w-[120px] " colspan="3"></td>
                    </tr>
                    @endif

                    @if(!isset($books)) <tr class="text-left border-b-2 shadow bg-white ">
                        <td colspan="10" class=" whitespace-nowrap text-sm py-5 px-3 align-top truncate w-[120px] text-center ">No Book Search Yet!</td>
                    </tr>
                    @endif

                </tbody>
            </table>
        </section>
    </div>
</x-app-layout>