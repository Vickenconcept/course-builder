<aside
    class="w-60 -translate-x-48 fixed transition transform ease-in-out duration-1000 z-50 flex h-screen bg-[#339966] ">
    <!-- open sidebar button -->
    <div
        class="max-toolbar translate-x-24 scale-x-0 w-full -right-6 transition transform ease-in duration-300 flex items-center justify-between border-4 border-white  bg-[#339966]  absolute top-2 rounded-full h-12">

        <div class="flex pl-4 items-center space-x-2 ">
        </div>
        <div
            class="flex items-center space-x-3 group bg-gradient-to-r  from-[#9fdfbf] via-[#79d2a6] to-[#39ac73]  pl-10 pr-2 py-1 rounded-full text-blue-50  ">
            <div class="transform ease-in-out duration-300 mr-12">
                ConvergeAI
            </div>
        </div>
    </div>
    <div onclick="openNav()"
        class="-right-6 transition transform ease-in-out duration-500 flex border-4 border-[#26734d]  bg-[#339966]  hover:bg-[#8cd9b3] absolute top-2 p-3 rounded-full text-blue-50 hover:rotate-45">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={3} stroke="currentColor"
            class="w-4 h-4">
            <path strokeLinecap="round" strokeLinejoin="round"
                d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
        </svg>
    </div>
    <!-- MAX SIDEBAR-->
    <div class="max hidden text-blue-50 mt-20 flex-col space-y-2 w-full h-[calc(100vh)]">
        <!-- <a href="{{ route('coming-soon') }}">
            <div class="hover:ml-4 text-sm w-full cursor-pointer text-blue-50  bg-[#339966] p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
                <i class="text-sm bx bx-bulb"></i>
                <div>
                    Home
                </div>
            </div>
        </a> -->
        <div
            class="hover:ml-4 text-sm w-full cursor-pointer text-blue-50  bg-[#339966] p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
            <i class='bx bxs-videos'></i>
            <div>
                Tutotrials
            </div>
        </div>
        </a>
        <a href="{{ route('course-validation.index') }}">
            <div
                class="hover:ml-4 text-sm w-full cursor-pointer text-blue-50  bg-[#339966] p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">

                <i class='text-sm bx bx-file-find'></i>
                <div>
                    Validate Your Idea
                </div>
            </div>
        </a>
        <a href="{{ route('research.index') }}">
            <div
                class="hover:ml-4 text-sm w-full cursor-pointer text-blue-50  bg-[#339966] p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
                <i class='text-sm bx bxs-rectangle'></i>
                <div>
                    Course research
                </div>
            </div>
        </a>
        <a href="{{ route('books.index') }}">
            <div
                class="hover:ml-4 text-sm w-full cursor-pointer text-blue-50  bg-[#339966] p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">

                <i class='text-sm bx bxs-book-open'></i>
                <div>
                    Book
                </div>
            </div>
        </a>
        <a href="{{ route('content-planner.index') }}">
            <div
                class="hover:ml-4 text-sm w-full cursor-pointer text-blue-50  bg-[#339966] p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">

                <i class='text-sm bx bx-book-bookmark'></i>
                <div>
                    Content-planner
                </div>
            </div>
        </a>
        {{-- <a href="{{ route('search.index') }}">
            <div class="hover:ml-4 text-sm w-full cursor-pointer text-blue-50  bg-[#339966] p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">

                <i class='text-sm bx bx-search'></i>
                <div>
                    Search
                </div>
            </div>
        </a> --}}
        <a href="{{ route('course') }}">
            <div
                class="hover:ml-4 text-sm w-full cursor-pointer text-blue-50  bg-[#339966] p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">

                <i class='text-sm bx bx-brain'></i>
                <div>
                    Create Course
                </div>
            </div>
        </a>
        <a href="{{ route('setting.index') }}">
            <div
                class="hover:ml-4 text-sm w-full cursor-pointer text-blue-50  bg-[#339966] p-2 pl-8 rounded-full transform ease-in-out duration-300 flex flex-row items-center space-x-3">
                <i class='bx bxs-cog'></i>
                <div>
                    Setting
                </div>
            </div>
        </a>
        <a href="{{ route('tutorials') }}">

    </div>
    <!-- MINI SIDEBAR-->
    <div class="mini mt-20 flex flex-col space-y-2 w-full h-[calc(100vh)]">
        <!-- <a href="{{ route('coming-soon') }}" class="hover:ml-4 justify-end pr-5 text-blue-50  w-full bg-[#339966] p-2 rounded-full transform ease-in-out duration-300 flex">
            <i class='text-sm bx  bx-bulb'></i>
        </a> -->
        <a href="{{ route('tutorials') }}"
            class="hover:ml-4 justify-end pr-5 text-blue-50  w-full bg-[#339966] p-2 rounded-full transform ease-in-out duration-300 flex">
            <i class='bx bxs-videos'></i>
        </a>
        <a href="{{ route('course-validation.index') }}"
            class="hover:ml-4 justify-end pr-5 text-blue-50  w-full bg-[#339966] p-2 rounded-full transform ease-in-out duration-300 flex">

            <i class='text-sm bx  bx-file-find'></i>
        </a>
        <a href="{{ route('research.index') }}"
            class="hover:ml-4 justify-end pr-5 text-blue-50  w-full bg-[#339966] p-2 rounded-full transform ease-in-out duration-300 flex">
            <i class='text-sm bx  bxs-rectangle'></i>
        </a>
        <a href="{{ route('books.index') }}"
            class="hover:ml-4 justify-end pr-5 text-blue-50  w-full bg-[#339966] p-2 rounded-full transform ease-in-out duration-300 flex">

            <i class='text-sm bx  bxs-book-open'></i>
        </a>
        <a href="{{ route('content-planner.index') }}"
            class="hover:ml-4 justify-end pr-5 text-blue-50  w-full bg-[#339966] p-2 rounded-full transform ease-in-out duration-300 flex">

            <i class='text-sm bx  bx-book-bookmark'></i>
        </a>
        {{-- <a href="{{ route('search.index') }}" class="hover:ml-4 justify-end pr-5 text-blue-50  w-full bg-[#339966] p-2 rounded-full transform ease-in-out duration-300 flex">

            <i class='text-sm bx  bx-search'></i>
        </a> --}}
        <a href="{{ route('course') }}"
            class="hover:ml-4 justify-end pr-5 text-blue-50  w-full bg-[#339966] p-2 rounded-full transform ease-in-out duration-300 flex">

            <i class='text-sm bx  bx-brain'></i>
        </a>
        <a href="{{ route('setting.index') }}"
            class="hover:ml-4 justify-end pr-5 text-blue-50  w-full bg-[#339966] p-2 rounded-full transform ease-in-out duration-300 flex">
            <i class='bx bxs-cog'></i>
        </a>

    </div>

</aside>
