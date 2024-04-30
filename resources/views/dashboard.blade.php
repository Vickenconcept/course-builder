<x-app-layout>
    <x-notification />
    <div class="p-2 md:px-10">
        @if ($errors->any())
        <div class="bg-red-200 text-red-500 p-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="flex flex-wrap my-5 -mx-2">
            <div class="w-full lg:w-1/3 p-2">
                <div class="flex items-center flex-row w-full   bg-slate-900 rounded-md px-3 py-8">

                    <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                        <div class="text-xs whitespace-nowrap">
                            Total User
                        </div>
                        <div class="">
                            {{ $userStats->total_users }}
                        </div>
                    </div>

                </div>
            </div>
            <div class="w-full md:w-1/2 lg:w-1/3 p-2">
                <div class="flex items-center flex-row w-full   bg-[#79d2a6] rounded-md px-3 py-8">
                    <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                        <div class="text-xs whitespace-nowrap">
                            Subscribed Users
                        </div>
                        <div class="">
                            {{ $userStats->subscribed_users }}
                        </div>
                    </div>

                </div>
            </div>
            <div class="w-full md:w-1/2 lg:w-1/3 p-2">
                <div class="flex items-center flex-row w-full   bg-slate-900 rounded-md px-3 py-8">

                    <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                        <div class="text-xs whitespace-nowrap">
                            Pending users
                        </div>
                        <div class="">
                            {{ $userStats->unsubscribed_users }}
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <section class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="w-full">
                <section class="text-xs ">
                    <div class="bg-white shadow-md border-b rounded p-3 my-1">
                        <div class="w-full  min-h-0 min-w-0 mb-4 space-y-8">
                            <div class="text-gray-700">
                                <div class="flex justify-between p-2 bg-slate-200 items-center rounded-md">
                                    <i class='bx bxl-stripe text-purple-700 text-5xl'></i>
                                    <form method="post" action="{{ route('use.stripe') }}">
                                        @csrf
                                        <label class="relative inline-flex items-center  cursor-pointer">
                                            <input type="checkbox" value="1" class="sr-only peer"
                                                onchange="this.form.submit()"
                                                @if (auth()->user()->use_stripe) checked @endif>
                                            <div
                                                class="w-11 z-0 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-[#79d2a6]  rounded-full peer dark:bg-gray-500 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all 
                                                {{ auth()->user()->use_stripe ? 'peer-checked:bg-[#79d2a6]' : 'peer-checked:bg-[#79d2a6]' }}
                                                 dark:border-gray-600 
                                                ">
                                            </div>
                                        </label>
                                    </form>
                                </div>
                                <p class="font-bold text-xl capitalize ">for your Stripe set up</p>
                                <h1 class="font-bold text-sm capitalize">Add Your stripe credential</h1>
                            </div>


                            @php
                                $firstThreeS = substr(auth()->user()->super_admin_strip_secret, 0, 3);
                                $lastThreeS = substr(auth()->user()->super_admin_strip_secret, -3);

                                $firstThreeK = substr(auth()->user()->super_admin_strip_key, 0, 3);
                                $lastThreeK = substr(auth()->user()->super_admin_strip_key, -3);

                            @endphp
                            <form action="{{ route('save.stripe') }}" method="post" class="space-y-5  {{ auth()->user()->use_stripe ? '':'hidden' }}" >
                                @csrf
                                <div>
                                    <label for=" " class="font-semibold mb-1 block">Stripe Key</label>
                                    <input type="text" name="super_admin_strip_key"
                                        class="rounded-md bg-gray-100 w-full shadow"
                                        placeholder="{{ $firstThreeK }} *****************{{ $lastThreeK }}"
                                        value="">

                                </div>
                                <div>
                                    <label for=" " class="font-semibold mb-1 block">Stripe Secret</label>
                                    <input type="text" name="super_admin_strip_secret"
                                        class="rounded-md bg-gray-100 w-full shadow"
                                        placeholder="{{ $firstThreeS }} *****************{{ $lastThreeS }}"
                                        value="">
                                </div>
                                <div>
                                    <label for=" " class="font-semibold mb-1 block">Application Amount</label>
                                    <input type="text" name="subscriptiion_amount"
                                        class="rounded-md bg-gray-100 w-full shadow" placeholder="1000"
                                        value="{{ auth()->user()->subscriptiion_amount }}">
                                </div>

                                <div class="mt-3">
                                    <button
                                        class="w-full  text-cyan-50 bg-slate-900 rounded-lg hover:bg-cyan-900 hover:shadow p-2 flex justify-center items-center">
                                        <span wire:loading><i class='bx bx-loader-alt animate-spin mr-1'></i></span>
                                        Save &
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>

            <div class="w-full">
                <section class="text-xs ">
                    <div class="bg-white shadow-md border-b rounded p-3 my-1">
                        <div class="w-full  min-h-0 min-w-0 mb-4 space-y-8">
                            <div class="text-gray-700">
                                <div class="flex justify-between p-2 bg-slate-200 items-center rounded-md">
                                    <i class='bx bxl-paypal text-blue-700 text-5xl'></i>
                                    <form method="post" action="{{ route('use.paypal') }}">
                                        @csrf
                                        <label class="relative inline-flex items-center  cursor-pointer">
                                            <input type="checkbox" value="1" class="sr-only peer"
                                                onchange="this.form.submit()"
                                                @if (auth()->user()->use_paypal) checked @endif>
                                            <div
                                                class="w-11 z-0 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-[#79d2a6]  rounded-full peer dark:bg-gray-500 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all 
                                                    {{ auth()->user()->use_paypal ? 'peer-checked:bg-[#79d2a6]' : 'peer-checked:bg-[#79d2a6]' }}
                                                     dark:border-gray-600 
                                                    ">
                                            </div>
                                        </label>
                                    </form>
                                </div>

                                <p class="font-bold text-xl capitalize ">for your Paypal set up</p>
                                <h1 class="font-bold text-sm capitalize">Add Your paypal client key</h1>
                            </div>


                            @php
                                $firstThree = substr(auth()->user()->super_admin_paypal_client_id, 0, 3);
                                $lastThree = substr(auth()->user()->super_admin_paypal_client_id, -3);

                            @endphp
                            <form action="{{ route('save.paypal') }}" method="post" class="space-y-5 {{ auth()->user()->use_paypal ? '':'hidden' }}">
                                @csrf
                                <div>
                                    <label for=" " class="font-semibold mb-1 block">Client ID</label>
                                    <input type="text" name="super_admin_paypal_client_id"
                                        class="rounded-md bg-gray-100 w-full shadow"
                                        placeholder="{{ $firstThree }} *****************{{ $lastThree }}"
                                        value="">
                                </div>
                                <div>
                                    <label for=" " class="font-semibold mb-1 block">Application Amount</label>
                                    <input type="text" name="subscriptiion_amount"
                                        class="rounded-md bg-gray-100 w-full shadow" placeholder="1000"
                                        value="{{ auth()->user()->subscriptiion_amount }}">
                                </div>

                                <div class="mt-3">
                                    <button
                                        class="w-full  text-cyan-50 bg-slate-900 rounded-lg hover:bg-cyan-900 hover:shadow p-2 flex justify-center items-center">
                                        <span wire:loading><i class='bx bx-loader-alt animate-spin mr-1'></i></span>
                                        Save &
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </section>

        <section class="mt-16 overflow-auto">
            <table class=" w-full mt-5  ">
                <thead>

                    <tr class="text-left border-b-2 shadow bg-white ">
                        <th scope="col"
                            class="text-gray-900  font-semibold firstletter:uppercase text-sm pt-10 pl-10  ">S/N</th>
                        <th scope="col" class="text-gray-900  font-semibold firstletter:uppercase text-sm pt-10 ">
                            Name</th>
                        <th scope="col" class="text-gray-900  font-semibold firstletter:uppercase text-sm pt-10 ">
                            Email</th>
                        <th scope="col" class="text-gray-900  font-semibold firstletter:uppercase text-sm pt-10 ">
                            Date</th>
                        <th scope="col" class="text-gray-900  font-semibold firstletter:uppercase text-sm pt-10 ">
                            Subscribed</th>
                        {{-- <th scope="col" class="text-gray-900  font-semibold firstletter:uppercase text-sm pt-10 "></th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="text-left border-b-2 shadow hover:bg-white transition duration-300 rounded-lg">
                            <td class="text-gray-900 whitespace-nowrap text-xs py-2 pl-10  form-semibold">
                                {{ $loop->iteration }}</td>
                            <td class="text-gray-900 whitespace-nowrap text-xs py-2 ">
                                {{-- <i class='bx bx-edit text-gray-400 mr-1'></i> --}}
                                {{ $user->name }}</td>
                            <td class="text-gray-900 whitespace-nowrap text-xs py-2">{{ $user->email }}</td>
                            <td class="text-gray-900 whitespace-nowrap text-xs py-2">{{ $user->created_at }}</td>
                            <td class="text-gray-900 whitespace-nowrap text-xs py-2">
                                @if ($user->subscribed)
                                    subscribed
                                @else
                                    pending..
                                @endif
                            </td>
                            {{-- <td class="text-gray-900 whitespace-nowrap text-xs py-2 pr-10">
                            <form action="{{ route('dashboard.update', ['dashboard' => $user->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <label for="userType">Update to Admin:</label>
                                <x-main-button type="submit">Update</x-main-button>
                            </form>
                        </td> --}}
                        </tr>
                    @endforeach
                </tbody>
        </section>



    </div>
</x-app-layout>
