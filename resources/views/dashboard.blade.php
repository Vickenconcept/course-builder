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
                        <div class="text-sm whitespace-nowrap flex items-center  space-x-1">
                            <i class='bx bxs-group text-xl'></i>
                            <span>Total User</span>
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
                        <div class="text-sm whitespace-nowrap flex items-center  space-x-1">
                            <i class='bx bxs-user text-xl' ></i>
                            <span>Subscribed Users</span>
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
                        <div class="text-sm whitespace-nowrap flex items-center  space-x-1">
                            <i class='bx bx-user-x text-xl'></i>
                            <span>Pending users</span>
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
                                                class="w-11 z-0 h-6 bg-gray-400 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-[#79d2a6]  rounded-full peer  peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all 
                                                {{ auth()->user()->use_stripe ? 'peer-checked:bg-[#79d2a6]' : 'peer-checked:bg-[#79d2a6]' }}
                                                  
                                                ">
                                            </div>
                                        </label>
                                    </form>
                                </div>
                                <div class="font-bold text-xl capitalize  flex items-center space-x-1">
                                    <span>for your Stripe set up</span>

                                <div class="relative">
                                    <button type="button" class="peer cursor-pointer"
                                        aria-describedby="tooltipExample"><i class='bx bxs-info-circle text-gray-600 hover:text-gray-800'></i></button>
                                    <div id="tooltipExample"
                                        class="pointer-events-none absolute bottom-full mb-2 left-1/2 -translate-x-1/2 z-10 flex w-64 flex-col gap-1 rounded bg-neutral-950 p-2.5 text-xs text-neutral-300 opacity-0 transition-all ease-out peer-hover:opacity-100 peer-focus:opacity-100 "
                                        role="tooltip">
                                        <span
                                            class="text-sm font-medium text-white  uppercase">Secured</span>
                                        <p class="text-balance">Your Stripe Keys will be handled with the utmost care
                                            and stored securely. We do not store or access your Stripe login credentials
                                            or sensitive financial information.</p>
                                    </div>
                                </div>
                            </div>
                                <h1 class="font-bold text-sm capitalize">Add Your stripe credential</h1>
                            </div>


                            @php
                                $firstThreeS = substr(auth()->user()->super_admin_strip_secret, 0, 3);
                                $lastThreeS = substr(auth()->user()->super_admin_strip_secret, -3);

                                $firstThreeK = substr(auth()->user()->super_admin_strip_key, 0, 3);
                                $lastThreeK = substr(auth()->user()->super_admin_strip_key, -3);

                            @endphp
                            <form action="{{ route('save.stripe') }}" method="post"
                                class="space-y-5  {{ auth()->user()->use_stripe ? '' : 'hidden' }}">
                                @csrf
                                <div>
                                    <label for=" " class="font-semibold mb-1 block">Stripe Publishable
                                        Key</label>
                                    <input type="text" name="super_admin_strip_key"
                                        class="rounded-md bg-gray-100 w-full shadow"
                                        placeholder="{{ $firstThreeK }} *****************{{ $lastThreeK }}"
                                        value="">

                                    <div class="font-semibold flex items-center space-x-1 mt-1 text-blue-600">

                                        <div class="relative">
                                            <button type="button" class="peer cursor-pointer"
                                                aria-describedby="tooltipExample"><i
                                                    class='bx bx-info-circle'></i></button>
                                            <div id="tooltipExample"
                                                class="pointer-events-none absolute bottom-full mb-2 left-1/2 -translate-x-1/2 z-10 flex w-64 flex-col gap-1 rounded bg-neutral-950 p-2.5 text-xs text-neutral-300 opacity-0 transition-all ease-out peer-hover:opacity-100 peer-focus:opacity-100 "
                                                role="tooltip">
                                                <span class="text-sm font-medium text-white ">Get
                                                    Stripe Keys</span>
                                                <p class="text-balance">Follow the link. Login to your Stripe account.
                                                    In the Stripe Dashboard, ensure you are in Live Mode (not Test
                                                    Mode).</p>
                                            </div>
                                        </div>
                                        <span>
                                            click <a href="https://dashboard.stripe.com/apikeys" target="_blank"
                                                class="underline font-bold hover:text-blue-900">
                                                HERE</a>
                                            to get stripe Publishable key and secret
                                        </span>
                                    </div>

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
                                                class="w-11 z-0 h-6 bg-gray-400 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-[#79d2a6]  rounded-full peer  peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all 
                                                    {{ auth()->user()->use_paypal ? 'peer-checked:bg-[#79d2a6]' : 'peer-checked:bg-[#79d2a6]' }}
                                                     
                                                    ">
                                            </div>
                                        </label>
                                    </form>
                                </div>

                                <div class="font-bold text-xl capitalize  flex items-center space-x-1">
                                    <span>for your Paypal set up</span>

                                <div class="relative">
                                    <button type="button" class="peer cursor-pointer"
                                        aria-describedby="tooltipExample"><i class='bx bxs-info-circle text-gray-600 hover:text-gray-800'></i></button>
                                    <div id="tooltipExample"
                                        class="pointer-events-none absolute bottom-full mb-2 left-1/2 -translate-x-1/2 z-10 flex w-64 flex-col gap-1 rounded bg-neutral-950 p-2.5 text-xs text-neutral-300 opacity-0 transition-all ease-out peer-hover:opacity-100 peer-focus:opacity-100 "
                                        role="tooltip">
                                        <span
                                            class="text-sm font-medium text-white  uppercase">Secured</span>
                                        <p class="text-balance">Your Paypal Key will be handled with the utmost care
                                            and stored securely. We do not store or access your Paypal login credentials
                                            or sensitive financial information.</p>
                                    </div>
                                </div>
                            </div>
                                <h1 class="font-bold text-sm capitalize">Add Your paypal client key</h1>
                            </div>


                            @php
                                $firstThree = substr(auth()->user()->super_admin_paypal_client_id, 0, 3);
                                $lastThree = substr(auth()->user()->super_admin_paypal_client_id, -3);

                            @endphp
                            <form action="{{ route('save.paypal') }}" method="post"
                                class="space-y-5 {{ auth()->user()->use_paypal ? '' : 'hidden' }}">
                                @csrf
                                <div>
                                    <label for=" " class="font-semibold mb-1 block">Client ID</label>
                                    <input type="text" name="super_admin_paypal_client_id"
                                        class="rounded-md bg-gray-100 w-full shadow"
                                        placeholder="{{ $firstThree }} *****************{{ $lastThree }}"
                                        value="">
                                    <div class="font-semibold flex items-center space-x-1 mt-1 text-blue-600">

                                        <div class="relative">
                                            <button type="button" class="peer cursor-pointer"
                                                aria-describedby="tooltipExample"><i
                                                    class='bx bx-info-circle'></i></button>
                                            <div id="tooltipExample"
                                                class="pointer-events-none absolute bottom-full mb-2 left-1/2 -translate-x-1/2 z-10 flex w-64 flex-col gap-1 rounded bg-neutral-950 p-2.5 text-xs text-neutral-300 opacity-0 transition-all ease-out peer-hover:opacity-100 peer-focus:opacity-100 "
                                                role="tooltip">
                                                <span class="text-sm font-medium text-white ">Get
                                                    Paypal Key</span>
                                                <p class="text-balance">Follow the link. Login to your Paypal account,
                                                    click Create App (if you don’t have one already) or select an
                                                    existing app.</p>
                                            </div>
                                        </div>
                                        <span>
                                            click <a href="https://developer.paypal.com/dashboard/applications/live"
                                                target="_blank" class="underline font-bold hover:text-blue-900">
                                                HERE</a>
                                            to get Client ID
                                        </span>
                                    </div>
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

        <section class="mt-16 mb-10 overflow-auto">
            <table class=" w-full my-5  ">
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
                    <div class="my-5">
                        {{ $users->links() }}
                    </div>
                </tbody>
        </section>



    </div>
</x-app-layout>
