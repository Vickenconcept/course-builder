<x-app-layout>
    <x-notification />
    <section class="h-full w-full bg-gray-50 flex flex-col-reverse sm:flex-row min-h-0 min-w-0 overflow-hidden">
        <main class="sm:h-full flex-1 flex flex-col min-h-0 min-w-0 overflow-auto">
            <section class="flex-1 pt-3 md:p-6 lg:mb-0 lg:min-h-0 lg:min-w-0">
                <div class="flex flex-col lg:flex-row h-full w-full">
                    <div
                        class=" pb-2 lg:pb-0 w-full lg:max-w-sm px-3 flex flex-row lg:flex-col flex-wrap lg:flex-nowrap mb-10 lg:mb-0 space-y-10">
                        <!-- control content left -->
                        <div class="w-full  min-h-0 min-w-0 mb-4 space-y-8">
                            <div>
                                <p class="font-bold text-xl capitalize">for your Paypal set up</p>
                                <h1 class="font-bold text-sm capitalize">Add Your paypal client key</h1>
                            </div>
                            <form action="{{ route('save.paypal') }}" method="post">
                                @csrf
                                <input type="text" name="super_admin_paypal_client_id" 
                                    class="form-control shadow" placeholder="o6yLhuE4_********">
                                <input type="text" name="subscriptiion_amount" 
                                    class="form-control shadow" placeholder="1000">

                                <div class="mt-3">
                                    <button 
                                        class="w-full  text-cyan-50 bg-cyan-800 rounded-lg hover:bg-cyan-900 hover:shadow p-2 flex justify-center items-center">
                                        <span wire:loading><i class='bx bx-loader-alt animate-spin mr-1'></i></span>
                                        Save &
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
                <!-- -->

                </div>
            </section>
        </main>
    </section>

</x-app-layout>
