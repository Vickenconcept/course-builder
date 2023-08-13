<x-app-layout>

    <div class="p-2 md:px-10">
        <h1 class="font-bold  text-gray-700 py-5">What course topic are you interested in?</h1>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 py-4">
            <div class=" w-full  col-span-1">
                <div class="relative flex items-center w-full h-10 rounded-lg focus-within:shadow-lg bg-white overflow-hidden">
                    <div class="grid place-items-center h-full w-12 text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input class="peer h-full w-full outline-none border-transparent focus:none text-sm text-gray-700 pr-2 placeholder-gray-400" type="text" id="search" placeholder="Search..." />
                </div>
            </div>
            <div class="col-span-1 sm:col-span-2 text-right">
                <button class="bg-gray-700 text-gray-100 px-3 rounded shadow hover:text-white transition duration-300 py-2 text-xs">Niche</button>
                <button class="bg-gray-700 text-gray-100 px-3 rounded shadow hover:text-white transition duration-300 py-2 text-xs">Topic Area</button>
                <button class="bg-gray-700 text-gray-100 px-3 rounded shadow hover:text-white transition duration-300 py-2 text-xs">Platform</button>
                <button class="bg-gray-700 text-gray-100 px-3 rounded shadow hover:text-white transition duration-300 py-2 text-xs">Enrollment</button>
                <button class="bg-gray-700 text-gray-100 px-3 rounded shadow hover:text-white transition duration-300 py-2 text-xs">Rating</button>
                <button class="bg-gray-700 text-gray-100 px-3 rounded shadow hover:text-white transition duration-300 py-2 text-xs">Price</button>

            </div>
        </div>

        <section class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            <div class="col-span-1 shadow-md rounded p-2 text-gray-700">
                <h1 class="font-semibold">Summary</h1>
                <div></div>
            </div>
            <div class="col-span-1 shadow-md rounded p-2">
            </div>
            <div class="col-span-1 sm:col-span-2 shadow-md rounded p-2"></div>

        </section>

        <section class="py-8">

            <button class="bg-gray-700 text-gray-100 px-3 rounded shadow hover:text-white transition duration-300 py-2 text-xs">Pre-set filter</button>
            <span class="bg-transparent text-gray-500 px-3  shadow hover:text-white transition duration-300 py-2 text-xs mx-3">Price</span>

            <table class=" w-full mt-5 bg-white ">
                <thead>
                    <tr class="text-left border-b-2 shadow bg-white ">
                        <th class="text-gray-700 font-semibold firstletter:uppercase text-sm pt-10 pl-10">Title</th>
                        <th class="text-gray-700 font-semibold firstletter:uppercase text-sm pt-10 ">Niche</th>
                        <th class="text-gray-700 font-semibold firstletter:uppercase text-sm pt-10 ">Sub-category</th>
                        <th class="text-gray-700 font-semibold firstletter:uppercase text-sm pt-10 ">Topic</th>
                        <th class="text-gray-700 font-semibold firstletter:uppercase text-sm pt-10 ">Duration <p>(hr)</p>
                        </th>
                        <th class="text-gray-700 font-semibold firstletter:uppercase text-sm pt-10 ">Est. Earning <p>($)</p>
                        </th>
                        <th class="text-gray-700 font-semibold firstletter:uppercase text-sm pt-10 ">Students</th>
                        <th class="text-gray-700 font-semibold firstletter:uppercase text-sm pt-10 ">Rating</th>
                        <th class="text-gray-700 font-semibold firstletter:uppercase text-sm pt-10 ">Price</th>
                        <th class="text-gray-700 font-semibold firstletter:uppercase text-sm pt-10 pr-10">Platform</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-left border-b-2 shadow ">
                        <td class="text-gray-700 text-sm py-2 pl-10"> <i class='bx bx-edit text-blue-400 mr-1'></i>hello</td>
                        <td class="text-gray-700 text-sm py-2">hello</td>
                        <td class="text-gray-700 text-sm py-2">hello</td>
                        <td class="text-gray-700 text-sm py-2">hello</td>
                        <td class="text-gray-700 text-sm py-2">hello</td>
                        <td class="text-gray-700 text-sm py-2">hello</td>
                        <td class="text-gray-700 text-sm py-2">hello</td>
                        <td class="text-gray-700 text-sm py-2">hello</td>
                        <td class="text-gray-700 text-sm py-2">hello</td>
                        <td class="text-gray-700 text-sm py-2 pr-10"><i class='bx bxs-color font-bold text-red-500 text-xl'></i></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
</x-app-layout>