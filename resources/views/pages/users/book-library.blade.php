<x-app-layout>
<div class=" p-2 md:px-10" >
    <h1 class="text-bg-blue-900 mb-6">My Books</h1>
    <section class="py-2 overflow-x-auto ">
        <table class=" w-full mt-3  ">
            <thead>
                <tr class="text-left border-b-2 hover:bg-white transition duration-300 shadow bg-white ">
                    <th class="text-blue-900  font-semibold firstletter:uppercase truncate w-[] text-sm ml-5 pt-10 ">S/N</th>
                    <th class="text-blue-900 px-6 font-semibold firstletter:uppercase truncate w-[] text-sm pt-10 ">thumbnail</th>
                    <th class="text-blue-900 px-6 font-semibold firstletter:uppercase truncate w-[] text-sm pt-10 ">Title</th>
                    <th class="text-blue-900 px-6 font-semibold firstletter:uppercase truncate w-[120px] text-sm pt-10 ">description</th>
                    <!-- <th class="text-blue-900 px-6 font-semibold firstletter:uppercase truncate w-[] text-sm pt-10 pr-10">Platform</th> -->
                </tr>
            </thead>
            <tbody class="">
                @if(isset($books))
                @forelse($books as $book)
                <tr class="text-left border-b-2 hover:bg-white transition duration-300 shadow rounded-lg bg-transparent">
                    <td class="text-blue-900 whitespace-nowrap text-xs py-2   truncate w-[] ml-5">{{ $loop->iteration }}</td>
                    <td class="text-blue-900 whitespace-nowrap text-xs py-2 px-6  truncate w-[] ">
                        <img src="{{ $book->image }}" alt="{{ $book->image }}" class="w-20 h-24 transform duration-300 inline hover:opacity-90 hover:rotate-[5deg]">
                    </td>
                    <td class="text-blue-900 whitespace-nowrap text-xs py-2 px-6  truncate w-[] ">
                        <div class="w-[200px] overflow-hidden">
                        <button class="group flex relative " x-on:click="isOpen = true">
                            <i class='bx bx-edit text-blue-400 mr-1 '></i> About {{ $book->title }}
                            <!-- <span class="bg-red-400 text-white px-2 py-1">Button</span> -->
                            <span class="group-hover:opacity-100 transition-opacity -top-6 bg-gray-800 px-1 text-xs text-gray-100 rounded-md absolute left-1/2  opacity-0 m-4 mx-auto">
                                {{ $book->title }}
                            </span>
                        </button>
                        </div>
                    </td>
                    <td class="text-blue-900 whitespace-nowrap text-xs py-2 px-6  truncate w-[120px] "><div class="w-[400px] overflow-hidden break-words">{{ $book->description}}</div></td>
                    <!-- <td class="text-blue-900 whitespace-nowrap text-xs py-2 px-6  truncate w-[]  pr-10"><i class='bx bxs-color font-bold text-red-500 text-xl'></i></td> -->
                </tr>
                @empty
                <tr>
                    <td class="text-blue-900 whitespace-nowrap text-xs py-2 px-6  truncate w-[] " colspan="3">no data</td>
                </tr>
                @endforelse
                @endif

                @if(!isset($books)) <tr class="text-left border-b-2 shadow bg-white ">
                    <td colspan="10" class="text-blue-900 whitespace-nowrap text-sm py-5 px-3 align-top truncate w-[] text-center ">No Book Search Yet!</td>
                </tr>
                @endif
            </tbody>
        </table>
    </section>
</div>
</x-app-layout>