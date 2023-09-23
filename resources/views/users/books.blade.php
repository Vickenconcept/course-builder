<x-app-layout>
    <div class=" p-2 md:px-10 text-gray-700" x-data="{ isOpen: false }">
        <x-notification />
        <h1 class="font-bold   py-5">What course topic are you interested in? <i
                class='bx bx-question-mark rounded-full bg-gray-300 text-white'></i></h1>
        <div class="grid grid-cols-1 md:grid-cols-3">
            <div class=" w-full  col-span-1">
                <form action="{{ route('books.create') }}" method="get">
                    @csrf
                    <div
                        class="relative flex items-center w-full h-10 rounded-lg overflow-hidden focus-within:shadow-lg bg-white ">
                        <div class="grid place-items-center h-full w-12 text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input autocomplete="off"
                            class="peer h-full w-full outline-none border-none focus:none focus:border-none focus:ring-white  text-sm  pr-2 placeholder-gray-200"
                            type="text" name="query" id="query" placeholder="Search..." />
                    </div>
                    @if (isset($query))
                        <p class="text-xs text~-blue-900 mt-1"><span class="font-bold">Last search: </span>
                            {{ $query }}</p>
                            
                    @endif
                </form>
            </div>
        </div>

        <section class="pt-10 overflow-x-auto">
            <form action="{{ route('export.books') }}" method="get">
                @csrf
                <button type="submit"
                    class="bg-transparent text-xs  px-3 shadow hover:shadow-lg transition duration-300 py-2 border border-[#39ac73] rounded ">Export
                    as CSV</button>

            </form>
            <p class=" text-xs font-bold mt-5">Total books:
                @if (isset($books))
                    <span>{{ count($books) }} +</span>
                @endif
            </p>

            <!-- ... Other sorting links ... -->

            <table class=" mt-3 bg-white w-full table-fixed">
                <thead>
                    <tr class="text-left border-b-2 shadow bg-white ">
                        <th scope="col"
                            class=" font-semibold firstletter:uppercase text-sm  truncate w-[120px] pt-4 px-6 pl-10 ">
                            Thumbnail</th>
                        <th scope="col"
                            class=" font-semibold firstletter:uppercase text-sm  truncate w-[120px] pt-4 px-6 ">Title
                        </th>
                        <th scope="col"
                            class=" font-semibold firstletter:uppercase text-sm  truncate w-[120px] pt-4 px-6 ">
                            Sub_Ttitle</th>
                        <th scope="col"
                            class=" font-semibold firstletter:uppercase text-sm  truncate w-[120px] pt-4 px-6 ">
                            Description</th>
                        <th scope="col"
                            class=" font-semibold firstletter:uppercase text-sm  truncate w-[120px] pt-4 px-6 ">Category
                        </th>
                        <th scope="col"
                            class=" font-semibold firstletter:uppercase text-sm  truncate w-[100px] pt-4 px-6 text-center ">
                            Rating</th>
                        <th scope="col"
                            class=" font-semibold firstletter:uppercase text-sm  truncate w-[120px] pt-4 px-6 ">Author
                        </th>
                        <th scope="col"
                            class=" font-semibold firstletter:uppercase text-sm  truncate w-[120px] pt-4 px-6 ">
                            Published Date</th>
                    </tr>
                </thead>
                @if (isset($books))
                    <tbody id="childArrayContainer">

                    </tbody>
                @endif
                @if (!isset($books))
                    <tbody>
                        <tr class="text-left border-b-2 shadow bg-white ">
                            <td colspan="10"
                                class=" whitespace-nowrap text-sm py-5 px-3 align-top truncate w-[120px] text-center ">
                                No Book Search Yet!</td>
                        </tr>
                    </tbody>
                @endif

            </table>

        </section>
        <!-- <button x-on:click="isOpen = true">click me</button> -->

        <x-main-modal>
            <div class="h-[28rem] ">
                <h2 class=" first-letter:uppercase font-semibold text-sm border-t py-1 ">View Book</h2>
                <div id="clickedBookContainer">

                </div>

            </div>
        </x-main-modal>


        <script>
            const childArrayContainer = document.getElementById("childArrayContainer");
            const clickedBookContainer = document.getElementById("clickedBookContainer");

            const books =
                @if (isset($books))
                    {!! json_encode($books) !!}
                @else
                    null
                @endif ;

            function showBook(book) {
                clickedBookContainer.innerHTML = ` 
                <form action="{{ route('books.store') }}"  method="post" id="myForm" class="hidden">
                @csrf
        <input type="text" value="${ book['title'] }" name="title">
        <input type="text" value="${ book['description'] ?book['description']: 'no description' }" name="description">
        <input type="text" value="${ book['thumbnail'] ? book['thumbnail'] : '/images/book-cover.jpg' }" name="image">
        <input type="text" value="${ book['category'] }" name="category">
        <input type="text" value="${ book['rating']}" name="rating">
        <input type="text" value="${ book['author']}" name="author">
        <input type="text" value="${ book['pages'] }" name="pages">
        <input type="text" value="${ book['previewLink']}" name="infolink">
        <input type="text" value="${ book['published_date']}" name="published_date">
        </form>
            <div h-full>
            
                <button class="bg-[#39ac73] py-2 my-3 px-4 rounded-lg hover:shadow-md text-white shadow text-xs" onClick="document.getElementById('myForm').submit()">Save to Library</button>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 h-full">
                    <div class="h-full shadow">
                        <a href="${ book['previewLink'] }" target="_blank" class=" first-letter:uppercase font-extrabold text-sm underline mt-2 inline " id="myTitle">${ book['title'] }</a><button onclick="toCopy(document.getElementById('myTitle'))"><i class='bx bx-copy ml-1 text-gray-300' ></i></button>
                        <div class="w-20 h-28 overflow-hidden shadow-sm">
                        <img src="${ book['thumbnail'] ? book['thumbnail'] : '/images/book-cover.jpg' }" alt="${ book['title']  }" class="h-full  object-cover ">
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="grid grid-cols-2 col-span-1 gap-1 py-1">
                                <div class=" text-xs capitalize">Rating</div>
                                <div class=" text-xs">${ book['rating'] ? book['rating'] :  '-' }</div>
                                <div class=" text-xs capitalize">Publisher</div>
                                <div class=" text-xs">${ book['author'] ? book['author'] : '-' }</div>
                                <div class=" text-xs capitalize">publissed Date</div>
                                <div class=" text-xs">${ book['published_date'] ? book['published_date']  : '-'}</div>
                                <div class=" text-xs capitalize">Pages</div>
                                <div class=" text-xs">${ book['page_count'] ? book['page_count']  : '-'}</div>
                                <div class=" text-xs capitalize">Category</div>
                                <div class=" text-xs">${ book['category'] ? book['category'] : '-' }</div>
                            </div>
                        </div>
                        <h2 class=" first-letter:uppercase font-extrabold text-sm  my-1 inline " >Description</h2>
                        <button  onclick="toCopy(document.getElementById('myDesc'))"><i class='bx bx-copy ml-1 text-gray-300' ></i></button>
                        <div class="h-40 overflow-auto">
                                <p class=" first-letter:uppercase text-xs " id="myDesc">${ book['description'] ? book['description'] : 'No description' }</p>
                        </div>
                    </div>
                    <div class="overflow-hidden px-10 overflow-y-auto shadow">
                       <div w-[80%] h-[100px]>
                            <img src="${ book['thumbnail'] ? book['thumbnail'] : '/images/book-cover.jpg' }" alt="${ book['title']  }" class="w-[80%]  object-contain shadow-md transform duration-700  hover:opacity-90 ">
                       </div>
                    </div>
                </div>
        </div> 
                `;
            }
            books.forEach(book => {
                const childElement = document.createElement("tr");

                childElement.style.borderBottom = '1px solid #eee';
                childElement.style.boxShadow = "0 2px 4px 0 rgba(0, 0, 0, 0.1)";

                childElement.innerHTML =
                    `
                    <td class=" whitespace-nowrap text-xs py-2 px-3  w-20 h-24  cursor-pointer"  x-on:click="isOpen = true">
                        <i class='bx bx-edit text-blue-400 mr-1' ></i>
                        <img src="${ book['thumbnail'] ? book['thumbnail'] : '/images/book-cover.jpg' }" alt="${ book['title'] }" class="w-20 h-24 transform duration-300 inline hover:opacity-90 hover:rotate-[5deg]">
                    </td>
                    <td class=" whitespace-nowrap text-xs py-2 px-3 align-top truncate w-[120px] ">${ book['title'] }</td>
                    <td class=" whitespace-nowrap text-xs py-2 px-3 align-top truncate w-[120px] ">${ book['subtitle'] ? book['subtitle'] : 'nill' }</td>
                    <td class=" whitespace-nowrap text-xs py-2 px-3 align-top truncate w-[120px] ">${ book['description'] ? book['description'] : 'nill' }</td>
                    <td class=" whitespace-nowrap text-xs py-2 px-3 align-top truncate w-[120px] ">${ book['category'] ? book['category'] :'nill' }</td>
                    <td class=" whitespace-nowrap text-xs text-center py-2 px-3 align-top truncate w-[100px] ">${ book['rating'] ? book['rating'] :  'nill' }</td>
                    <td class=" whitespace-nowrap text-xs py-2 px-3 align-top truncate w-[120px] ">${ book['author'] ? book['author'] : 'nill' }</td>
                    <td class=" whitespace-nowrap text-xs py-2 px-3 align-top truncate w-[120px]  pr-10">${ book['published_date'] ? book['published_date']  : 'nill'}</td>`

                childElement.addEventListener("click", () => {
                    showBook(book);
                });

                childArrayContainer.appendChild(childElement);
            });

            // for coping text
            function toCopy(copyDiv) {
                var range = document.createRange();
                range.selectNode(copyDiv);
                window.getSelection().removeAllRanges();
                window.getSelection().addRange(range);
                document.execCommand("copy");
                alert("copied!");
            }
        </script>
    </div>

</x-app-layout>
