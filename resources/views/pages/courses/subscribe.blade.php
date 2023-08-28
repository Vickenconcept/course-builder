<x-guest-layout>
    @if (session('message'))
        <div class="alert alert-success" role="alert">{{ session('message') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
    @endif
    {{-- <div class=" w-full h-screen flex  items-center justify-center">

        <div class="text-gray-100 bg-gray-800 w-[80%] mx-auto">
            <div class="w-full py-5">
                <h1 class="text-center font-semibold text-xl lg:text-4xl capitalize">Subscribe To Grab The Course</h1>
                <p class="text-center px-20 py-1">Sign up to the newsletter and be the first one to know about new
                    product or
                    special offers.</p>
                <div class="flex justify-center mt-6">
                    <div class="flex-row">
                        <div class="bg-white rounded-lg">
                            <form action="{{ route('subscribe.store') }}" method="post">
                                @csrf
                                <div class="flex flex-warp justify-between md:flex-row">
                                    <input type="text" value="{{ $course->id }}" name="courseId" hidden>
                                    <input type="email"
                                        class="m-1 p-3 md:w-[24rem] guestearance-none border-none text-gray-700 text-sm font-medium focus:outline-none focus:border-white focus:rounded focus:placeholder-transparent"
                                        placeholder="Enter your email" aria-label="Enter your email" name="email">
                                    <button type="submit"
                                        class="w-full text-sm m-1 p-2 bg-gray-800 rounded-lg font-semibold lg:w-auto hover:bg-gray-700">
                                        Subscribe
                                    </button>
                                </div>
                            </form>
                        </div>
                        <p class="text-sm ml-1 mt-2 font-light text-gray-300 text-center">Enjoy the move!!</p>
                    </div>
                </div>
                <hr class="h-px mt-6 bg-gray-500 border-none">
                <div class="flex flex-col items-center justify-between mt-6 md:flex-row">

                </div>
            </div>

<div></div> --}}






    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 ">
        <div class="col-span-1 bg-gray-50 px-4 pt-8 mt-10 text-gray-700 py-10">
            <img src="{{ asset('images/book-cover.jpg') }}" alt="" class="w-40 ">
            <h1 class="text-xl font-bold my-3 capitalize">{{ $course->title }}</h1>
            <p class="text-sm  my-3 capitalize truncate w-36">{{ $course->description }}</p>

            <div class="text-yellow-500">
                <i class='bx bxs-star '></i>
                <i class='bx bxs-star '></i>
                <i class='bx bxs-star '></i>
                <i class='bx bxs-star-half'></i>
                <i class='bx bx-star '></i>
            </div>
        </div>
        <div class="col-span-2">
            {{-- <div class="grid sm:px-10 lg:grid-cols-2 lg:px-20 xl:px-32"> --}}

            <div class="mt-10 bg-gray-50 px-4 pt-8 lg:mt-0">
                <p class="text-xl font-medium">Subscribe To Grab The Course</p>
                <p class="text-gray-400">Enjoy the move!!</p>
                <div class="">
                    @if ($course->courseSettings->checkout_option === 'email')
                        <div class="py-10">
                            <form action="{{ route('subscribe.store') }}" method="post">
                                @csrf
                                <label for="email" class="mt-4 mb-2 block text-sm font-medium">Email</label>
                                <div class="relative">
                                    <input type="text" value="{{ $course->id }}" name="courseId" hidden>
                                    <input type="text" value="{{ $list_id }}" name="list_id" hidden>
                                    <input type="text" id="email" name="email"
                                        class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="your.email@gmail.com" name="email" />
                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                        </svg>
                                    </div>
                                </div>
                                <button
                                    class="mt-4 mb-8 w-full rounded-md bg-gray-900 px-6 py-3 font-medium text-white">Subscribe</button>
                            </form>
                        </div>
                    @else
                        {{-- <label for="email" class="mt-4 mb-2 block text-sm font-medium">Email</label>
                        <div class="relative">
                            <input type="text" id="email" name="email"
                                class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="your.email@gmail.com" />
                            <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                        </div>
                        <label for="card-holder" class="mt-4 mb-2 block text-sm font-medium">Card Holder</label>
                        <div class="relative">
                            <input type="text" id="card-holder" name="card-holder"
                                class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm uppercase shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Your full name here" />
                            <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                                </svg>
                            </div>
                        </div>
                        <label for="card-no" class="mt-4 mb-2 block text-sm font-medium">Card Details</label>
                        <div class="flex">
                            <div class="relative w-7/12 flex-shrink-0">
                                <input type="text" id="card-no" name="card-no"
                                    class="w-full rounded-md border border-gray-200 px-2 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="xxxx-xxxx-xxxx-xxxx" />
                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                                    <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path
                                            d="M11 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1z" />
                                        <path
                                            d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm13 2v5H1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm-1 9H2a1 1 0 0 1-1-1v-1h14v1a1 1 0 0 1-1 1z" />
                                    </svg>
                                </div>
                            </div>
                            <input type="text" name="credit-expiry"
                                class="w-full rounded-md border border-gray-200 px-2 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="MM/YY" />
                            <input type="text" name="credit-cvc"
                                class="w-1/6 flex-shrink-0 rounded-md border border-gray-200 px-2 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="CVC" />
                        </div>
                        <label for="billing-address" class="mt-4 mb-2 block text-sm font-medium">Billing
                            Address</label>
                        <div class="flex flex-col sm:flex-row">
                            <div class="relative flex-shrink-0 sm:w-7/12">
                                <input type="text" id="billing-address" name="billing-address"
                                    class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Street Address" />
                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                                    <img class="h-4 w-4 object-contain"
                                        src="https://flagpack.xyz/_nuxt/4c829b6c0131de7162790d2f897a90fd.svg"
                                        alt="" />
                                </div>
                            </div>
                            <select type="text" name="billing-state"
                                class="w-full rounded-md border border-gray-200 px-4 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500">
                                <option value="State">State</option>
                            </select>
                            <input type="text" name="billing-zip"
                                class="flex-shrink-0 rounded-md border border-gray-200 px-4 py-3 text-sm shadow-sm outline-none sm:w-1/6 focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="ZIP" />
                        </div>

                        <!-- Total -->
                        <div class="mt-6 border-t border-b py-2">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-900">Subtotal</p>
                                <p class="font-semibold text-gray-900">$399.00</p>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-900">Shipping</p>
                                <p class="font-semibold text-gray-900">$8.00</p>
                            </div>
                        </div>
                        <div class="mt-6 flex items-center justify-between">
                            <p class="text-sm font-medium text-gray-900">Total</p>
                            <p class="text-2xl font-semibold text-gray-900">$408.00</p>
                        </div>

                </div>
                <button class="mt-4 mb-8 w-full rounded-md bg-gray-900 px-6 py-3 font-medium text-white">Place
                    Order</button> --}}

                    {{-- for strip --}}

                        {{-- <form method="POST" action="{{ route('products.purchase', $course->id) }}"
                            class="card-form mt-3 mb-3">
                            @csrf
                            <input type="hidden" name="payment_method" class="payment-method">
                            <input class="StripeElement mb-3" name="card_holder_name" placeholder="Card holder name"
                                required>
                            <div class="col-lg-4 col-md-6">
                                <div id="card-element"></div>
                            </div>
                            <div id="card-errors" role="alert"></div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary pay">
                                    Purchase
                                </button>
                            </div>
                        </form> --}}
                    @endif
                </div>
            </div>

        </div>
        @section('styles')
            <style>
                .StripeElement {
                    box-sizing: border-box;
                    height: 40px;
                    padding: 10px 12px;
                    border: 1px solid transparent;
                    border-radius: 4px;
                    background-color: white;
                    box-shadow: 0 1px 3px 0 #e6ebf1;
                    -webkit-transition: box-shadow 150ms ease;
                    transition: box-shadow 150ms ease;
                }

                .StripeElement--focus {
                    box-shadow: 0 1px 3px 0 #cfd7df;
                }

                .StripeElement--invalid {
                    border-color: #fa755a;
                }

                .StripeElement--webkit-autofill {
                    background-color: #fefde5 !important;
                }
            </style>
        @endsection

        {{-- @section('scripts') --}}
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            let stripe = Stripe("{{ env('STRIPE_KEY') }}")
            let elements = stripe.elements()
            let style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            }
            let card = elements.create('card', {
                style: style
            })
            card.mount('#card-element')
            let paymentMethod = null
            $('.card-form').on('submit', function(e) {
                $('button.pay').attr('disabled', true)
                if (paymentMethod) {
                    return true
                }
                stripe.confirmCardSetup(
                    "{{ $intent->client_secret }}", {
                        payment_method: {
                            card: card,
                            billing_details: {
                                name: $('.card_holder_name').val()
                            }
                        }
                    }
                ).then(function(result) {
                    if (result.error) {
                        $('#card-errors').text(result.error.message)
                        $('button.pay').removeAttr('disabled')
                    } else {
                        paymentMethod = result.setupIntent.payment_method
                        $('.payment-method').val(paymentMethod)
                        $('.card-form').submit()
                    }
                })
                return false
            })
        </script>


        </x-app-layout>
