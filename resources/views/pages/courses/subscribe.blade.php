<x-guest-layout>
    @seo([
        'title' => $course->title,
        'description' => $course->description,
        'image' => asset($course->course_image),
        'type' => 'article',
        'url' => route('courses.share', ['courseId' => $course->id, 'course_slug' => $course->slug]),
    ])
    
    @if (session('message'))
        <div class="alert alert-success" role="alert">{{ session('message') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
    @endif

    <x-notification />
    <div class="grid grid-cols-1 md:grid-cols-3 w-full  md:w-[80%] mx-auto">
        <div class="col-span-1 bg-gray-50 px-10  text-gray-700 py-10 grid grid-cols-2 gap-2">
            <div class=" object-cover overflow-hidden border-r-4 border-b-4 h-40">
                <img src="{{ $course->course_image ?? asset('images/book-cover.jpg') }}" alt="" class="w-full  h-full">
            </div>
            <div>
                <h1 class="text-xl font-bold mb-3 capitalize">{{ $course->title }}</h1>
                <p class="text-sm  my-3 capitalize line-clamp-3 w-36">{{ $course->description }}</p>

                <div class="text-yellow-500">
                    <i class='bx bxs-star '></i>
                    <i class='bx bxs-star '></i>
                    <i class='bx bxs-star '></i>
                    <i class='bx bxs-star-half'></i>
                    <i class='bx bx-star '></i>
                </div>
            </div>
        </div>
        <div class="col-span-2">

            <div class="mt-10 bg-gray-50 px-0 pt-8 lg:mt-0 px-10">
                <p class="text-xl font-medium">Subscribe To Grab The Course</p>
                <p class="text-gray-400">Enjoy the move!!</p>
                <div class="">
                    @if ($course->courseSettings->checkout_option === 'email')
                        @if ($course->esp === 'mailchimp')
                            {{-- mailchimp --}}
                            <h1>mailchimp</h1>
                            <div class="py-10">
                                <form action="{{ route('subscribe.store') }}" method="post">
                                    @csrf
                                    <label for="email" class="mt-4 mb-2 block text-sm font-medium">Email</label>
                                    <div class="relative">
                                        <input type="text" value="{{ $course->id }}" name="courseId" hidden>
                                        <input type="text" value="{{ $course->list_id }}" name="list_id" hidden>
                                        <input type="hidden" name="is_admin" value="user">
                                        <input type="text" id="name" name="name"
                                            class="w-full rounded-md border border-gray-200 px-0 py-3 pl-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="smith" name="name" />
                                        <input type="text" id="email" name="email"
                                            class="w-full rounded-md border border-gray-200 px-0 py-3 mt-3 pl-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="your.email@gmail.com" name="email" />
                                    </div>
                                    <button
                                        class="mt-4 mb-8 w-full rounded-md bg-gray-900 px-6 py-3 font-medium text-white"
                                        type="submit">Subscribe</button>
                                </form>
                            </div>
                        @elseif ($course->esp === 'getresponse')
                            {{--  --}}
                            <h1>getresponse</h1>
                            <div class="py-10">
                                <form action="{{ route('subscribe.getResponse') }}" method="post">
                                    @csrf
                                    <label for="email" class="mt-4 mb-2 block text-sm font-medium">Email</label>
                                    <div class="relative">
                                        <input type="text" value="{{ $course->id }}" name="courseId" hidden>
                                        <input type="text" value="{{ $course->get_response_id }}"
                                            name="get_response_id" hidden>
                                        <input type="hidden" name="is_admin" value="user">
                                        <input type="text" id="name" name="name"
                                            class="w-full rounded-md border border-gray-200 px-0 py-3 pl-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="smith" name="name" />
                                        <input type="text" id="email" name="email"
                                            class="w-full rounded-md border border-gray-200 px-0 py-3 mt-3 pl-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="your.email@gmail.com" name="email" />
                                    </div>
                                    <button
                                        class="mt-4 mb-8 w-full rounded-md bg-gray-900 px-6 py-3 font-medium text-white"
                                        type="submit">Subscribe</button>
                                </form>
                            </div>
                        @elseif ($course->esp === 'convertkit')
                            {{--  --}}
                            <h1>convertkit</h1>
                            <div class="py-10">
                                <form action="{{ route('subscribe.convertkit') }}" method="post">
                                    @csrf
                                    <label for="email" class="mt-4 mb-2 block text-sm font-medium">Email</label>
                                    <div class="relative">
                                        <input type="text" value="{{ $course->id }}" name="courseId" hidden>
                                        <input type="text" value="{{ $course->convert_id }}"
                                            name="convert_id" hidden>
                                        <input type="hidden" name="is_admin" value="user">
                                        <input type="text" id="name" name="name"
                                            class="w-full rounded-md border border-gray-200 px-0 py-3 pl-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="smith" name="name" />
                                        <input type="text" id="email" name="email"
                                            class="w-full rounded-md border border-gray-200 px-0 py-3 mt-3 pl-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="your.email@gmail.com" name="email" />
                                    </div>
                                    <button
                                        class="mt-4 mb-8 w-full rounded-md bg-gray-900 px-6 py-3 font-medium text-white"
                                        type="submit">Subscribe</button>
                                </form>
                            </div>
                        @else
                            <h1>not available now</h1>
                        @endif
                        {{--  --}}
                    @elseif($course->courseSettings->checkout_option === 'payment')
                        <div class="flex-center position-ref full-height">

                            <div class="content">
                                <form action="{{ route('subscribe.paymentData') }}" method="post">
                                    @csrf
                                    <label for="email" class="mt-4 mb-2 block text-sm font-medium">Email</label>
                                    <div class="relative">
                                        <input type="hidden" name="is_admin" value="user">
                                        <input type="text" id="name" name="name"
                                            class="w-full rounded-md border border-gray-200 px-0 py-3 pl-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="smith" name="name"
                                            value="{{ auth()->check() ? auth()->user()->name : '' }}" />
                                        <input type="text" id="email" name="email"
                                            class="w-full rounded-md border border-gray-200 px-0 py-3 mt-3 pl-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="your.email@gmail.com" name="email"
                                            value="{{ auth()->check() ? auth()->user()->email : '' }}" />
                                    </div>
                                    <button
                                        class="mt-4 mb-8 w-full rounded-md bg-gray-900 px-6 py-3 font-medium text-white">save</button>
                                </form>
                            </div>
                            <div class="">
                                <table border="0" cellpadding="10" cellspacing="0" align="center">
                                    <tr>
                                        <td align="center"></td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <a href="https://www.paypal.com/in/webapps/mpp/paypal-popup"
                                                title="How PayPal Works"
                                                onclick="javascript:window.open('https://www.paypal.com/in/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"><img
                                                    src="https://www.paypalobjects.com/webstatic/mktg/Logo/pp-logo-200px.png"
                                                    border="0" alt="PayPal Logo"></a>
                                        </td>
                                    </tr>
                                </table>
                            </div>


                            <form action="{{ route('payment') }}" method="get">
                                @csrf
                                <div class="flex-shrink w-full inline-block relative">
                                    <input type="text" name="title" value="{{ $course->title }}" hidden>
                                    <input type="text" name="price" value="{{ $course->price }}" hidden>
                                    <input type="text" name="courseId" value="{{ $course->id }}" hidden>

                                </div>
                                <button type="submit"
                                    class="mt-4 mb-8 w-full rounded-md bg-gray-900 px-6 py-3 font-medium text-white">
                                    Pay ${{ $course->price }} from Paypal
                                </button>
                            </form>

                        </div>
                    @else
                        @php
                            
                            $socialLinks = Share::page(route('courses.share', ['courseId' => $course->id, 'course_slug' => $course->slug]), 'Share title')
                                ->facebook()
                                ->twitter()
                                ->linkedin('Extra linkedin summary can be passed here')
                                ->whatsapp()
                                ->getRawLinks();
                        @endphp
                        <div class="flex justify-around  mt-4 mb-8 ">
                            @foreach ($socialLinks as $platform => $link)
                                @if ($platform == 'facebook')
                                    <a href="{{ $link }}" class="social-button" id=""
                                        data-platform="facebook" title="" rel="" target="_blank">
                                        <img src="{{ asset('images/facebook_media.png') }}" alt=""
                                            class="w-8 h-8">
                                    </a>
                                @elseif ($platform == 'twitter')
                                    <a href="{{ $link }}" class="social-button" id=""
                                        data-platform="twitter" title="" rel="" target="_blank">
                                        <img src="{{ asset('images/twitter_blue.png') }}" alt=""
                                            class="w-8 h-8">
                                    </a>
                                @elseif ($platform == 'linkedin')
                                    <a href="{{ $link }}" class="social-button" id=""
                                        data-platform="linkedin" title="" rel="" target="_blank">
                                        <img src="{{ asset('images/linkedin.png') }}" alt=""
                                            class="w-8 h-8">
                                    </a>
                                @elseif ($platform == 'whatsapp')
                                    <a href="{{ $link }}" class="social-button" id=""
                                        data-platform="whatsapp" title="" rel="" target="_blank">
                                        <img src="{{ asset('images/whatsapp.png') }}" alt=""
                                            class="w-8 h-8">
                                    </a>
                                @endif
                            @endforeach


                        </div>
                        <button type="button"
                            class="mt-4 mb-8 w-full rounded-md bg-blue-600 px-6 py-3 font-medium text-white">
                        </button>
                    @endif
                </div>
            </div>

        </div>



        <script src="https://js.stripe.com/v3/"></script>



        <script>
            // Declare childWindow in a broader scope
            var childWindow;

            document.querySelectorAll('.social-button').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the default link behavior

                    // Get the platform from the data-platform attribute
                    var platform = button.getAttribute('data-platform');
                    var courseSlug = '{{ $course->slug }}';
                    var courseId = '{{ $course->id }}';

                    // Make an AJAX request to track the share event (similar to your previous code)
                    fetch('{{ route('track-share-event') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                platform: platform,
                                course_slug: courseSlug,
                                courseId: courseId,
                                // Include other relevant data as needed
                            }),

                        })
                        .then(response => {
                            console.log('Share event data sent:', response);

                            childWindow = window.open(button.getAttribute('href'), '_blank');

                        })
                        .catch(error => {
                            console.error(error);
                        });
                });
            });

            let timeoutId; // Store the timeout ID

            document.onvisibilitychange = function() {
                if (document.hidden) {
                    console.log('User is now away from the page');

                    timeoutId = setTimeout(function() {
                        if (childWindow && !childWindow.closed) {
                            childWindow.close();
                        }

                        window.location.href =
                            '{{ route('courses.share', ['courseId' => $course->id, 'course_slug' => $course->slug]) }}';
                    }, 10000); // 10 minutes
                } else {
                    console.log('User is back to the page');


                }
            };
        </script>



        </x-app-layout>
