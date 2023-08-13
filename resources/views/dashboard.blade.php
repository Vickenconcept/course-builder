<x-app-layout>

    <div class="p-2 md:px-10">
        <!-- <nav class="flex  py-3 text-gray-700  rounded-lg bg-gray-50 dark:bg-[#1E293B] " aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard.index')}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fillRule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clipRule="evenodd"></path>
                        </svg>
                        <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">Templates</a>
                    </div>
                </li>
            </ol>
        </nav> -->
        <div class="flex flex-wrap my-5 -mx-2">
            <div class="w-full lg:w-1/3 p-2">
                <div class="flex items-center flex-row w-full bg-gradient-to-r  bg-yellow-900 rounded-md p-3">
                    <div class="flex text-indigo-500 dark:text-white items-center bg-white dark:bg-[#0F172A] p-2 rounded-md flex-none w-8 h-8 md:w-12 md:h-12 ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="object-scale-down transition duration-500">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </div>
                    <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                        <div class="text-xs whitespace-nowrap">
                            Total User
                        </div>
                        <div class="">
                            {{ $users->count() }}
                        </div>
                    </div>
                    <div class=" flex items-center flex-none text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 h-6">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>

                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2 lg:w-1/3 p-2 ">
                <div class="flex items-center flex-row w-full bg-gradient-to-r  bg-yellow-500 rounded-md p-3">
                    <div class="flex text-indigo-500 dark:text-white items-center bg-white dark:bg-[#0F172A] p-2 rounded-md flex-none w-8 h-8 md:w-12 md:h-12 ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="object-scale-down transition duration-500 ">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                        </svg>
                    </div>
                    <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                        <div class="text-xs whitespace-nowrap">
                            Verified Users
                        </div>
                        <div class="">
                       {{ $numberOfVerifiedUsers }}
                        </div>
                    </div>
                    <div class=" flex items-center flex-none text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 h-6">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>

                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2 lg:w-1/3 p-2">
                <div class="flex items-center flex-row w-full bg-gradient-to-r  bg-yellow-900 rounded-md p-3">
                    <div class="flex text-indigo-500 dark:text-white items-center bg-white dark:bg-[#0F172A] p-2 rounded-md flex-none w-8 h-8 md:w-12 md:h-12 ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="object-scale-down transition duration-500">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605" />
                        </svg>
                    </div>
                    <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                        <div class="text-xs whitespace-nowrap">
                            Total Visitor
                        </div>
                        <div class="">
                            500
                        </div>
                    </div>
                    <div class=" flex items-center flex-none text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 h-6">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>

                    </div>
                </div>
            </div>
        </div>

        <section class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="w-full">
                <section class="text-xs ">
                    <div class="bg-white shadow-md border-b rounded p-3 my-1">
                        <p class="text-gray-300">3 mins ago</p>

                    
                    </div>
                </section>
            </div>

            <div class="w-full">
                <section class="text-xs ">
                    <div class="bg-white shadow-md border-b rounded p-3 my-1">
                        <p class="text-gray-300">3 mins ago</p>

                    
                    </div>
                </section>
            </div>
        </section>

        <section class="mt-16 overflow-auto">
            <!-- <h1 class="font-bold text-blue-900 text-sm">Total Users <span class="bg-blue-200 rounded-full p-0.5 text-xs text-blue-50">{{ $users->count() }}</span></h1> -->
            <table class=" w-full mt-5  ">
                <thead>

                    <tr class="text-left border-b-2 shadow bg-white ">
                        <th scope="col" class="text-blue-900  font-semibold firstletter:uppercase text-sm pt-10 pl-10  ">S/N</th>
                        <th scope="col" class="text-blue-900  font-semibold firstletter:uppercase text-sm pt-10 ">Name</th>
                        <th scope="col" class="text-blue-900  font-semibold firstletter:uppercase text-sm pt-10 ">Email</th>
                        <th scope="col" class="text-blue-900  font-semibold firstletter:uppercase text-sm pt-10 ">Date</th>
                        <th scope="col" class="text-blue-900  font-semibold firstletter:uppercase text-sm pt-10 "></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="text-left border-b-2 shadow hover:bg-white transition duration-300 rounded-lg">
                        <td class="text-blue-900 whitespace-nowrap text-xs py-2 pl-10  form-semibold">{{ $loop->iteration }}</td>
                        <td class="text-blue-900 whitespace-nowrap text-xs py-2 "> <i class='bx bx-edit text-blue-400 mr-1'></i>{{ $user->name }}</td>
                        <td class="text-blue-900 whitespace-nowrap text-xs py-2">{{ $user->email }}</td>
                        <td class="text-blue-900 whitespace-nowrap text-xs py-2">{{ $user->created_at }}</td>
                        <td class="text-blue-900 whitespace-nowrap text-xs py-2 pr-10"><x-main-button>action</x-main-button></td>
                    </tr>
                    @endforeach
                </tbody>
        </section>

        

    </div>
</x-app-layout>