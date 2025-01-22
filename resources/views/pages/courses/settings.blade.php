<x-app-layout>
    <x-notification />

    <div class="grid  grid-cols-1 md:grid-cols-3 gap-5 px-5" x-data="{ selected: '' }">
        <div class="col-span-1 grid gap-5">

            <!-- component -->
            <div class="bg-gray-200 min-h-screen pt-2 font-mono mb-10 mt-0 rounded-lg">
                <div class="container mx-auto">
                    <div class="inputs w-full max-w-2xl p-6 mx-auto">
                        <div class=" w-full md:w-[80%] my-3 rounded-full border-b border-gray-400  px-2 ">
                            <a href="{{ route('courses.edit', ['course' => $course->id]) }}"
                                class="text-xs font-bold block text-gray-700 mb-3 ">
                                <i class='bx bx-chevron-left mr-2'></i> Back to course Editor
                            </a>
                        </div>
                        <h2 class="text-2xl text-gray-900"><i class='bx bxs-cog text-4xl'></i>Course Setting</h2>
                        <p class="text-gray-700 font-bold text-sm bg-gray-100 p-2 w-full rounded">Course price:
                            ${{ $course->price }}</p>
                        <div class="mt-6 border-t border-gray-400 pt-4">


                            <div class='flex flex-wrap -mx-3 mb-6'>


                                <div class='w-full md:w-full px-3 mb-6'>
                                    <form action="{{ route('course.checkout', ['courseId' => $course]) }}"
                                        method="POST">
                                        @method('PUT')
                                        @csrf
                                        <label
                                            class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>Course
                                            Checkout Option</label>
                                        <div class="flex-shrink w-full inline-block relative">
                                            <select
                                                class="block appearance-none text-gray-600 w-full bg-white border border-gray-400 shadow-inner px-4 py-2 pr-8 rounded"
                                                name="checkout_option" onchange="this.form.submit()">
                                                <option disabled selected>Checkout Mode</option>
                                                <option value="email"
                                                    @if (session('checkout_option') === 'email') selected @endif>Email</option>
                                                <option value="payment"
                                                    @if (session('checkout_option') === 'payment') selected @endif>Payment</option>
                                                <option value="share"
                                                    @if (session('checkout_option') === 'share') selected @endif>Social share
                                                </option>
                                            </select>
                                            <div
                                                class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg>
                                            </div>
                                        </div>
                                        {{-- <button type="submit" class="underline">Check</button> --}}
                                    </form>
                                </div>
                                @if (session('checkout_option') === 'email')
                                    <div class="space-y-2 w-full">

                                        <button @click="selected = 'mailchimp'"
                                            class="block bg-[#339966] w-full text-left text-white rounded-full px-3 py-1"><i
                                                class='bx bxs-envelope mr-1 text-white'></i>Mailchimp</button>
                                        <button @click="selected = 'getresponse'"
                                            class="block bg-[#339966] w-full text-left text-white rounded-full px-3 py-1"><i
                                                class='bx bxs-envelope mr-1 text-white'></i>GetResponse</button>
                                        <button @click="selected = 'convertKit'"
                                            class="block bg-[#339966] w-full text-left text-white rounded-full px-3 py-1"><i
                                                class='bx bxs-envelope mr-1 text-white'></i>ConvertKit</button>


                                    </div>
                                @endif
                                {{-- <div class='w-full md:w-full px-3 mb-6'>
                                    <label
                                        class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>Pick your Audience</label>
                                    <div class="flex-shrink w-full inline-block relative">
                                        <form action="{{ route('course-setting.saveSetting', ['courseId' => $course]) }}" method="POST">
                                            @csrf
                                            <select
                                                class="block appearance-none text-gray-600 w-full bg-white border border-gray-400 shadow-inner px-4 py-2 pr-8 rounded" onchange="this.form.submit()" name="list_id">
                                                <option disabled selected>choose ...</option>
                                                @foreach ($lists->lists as $list)
                                                <option value="{{ $list->id }}">
                                                    {{ $list->name }}
                                                </option>
                                             
                                               
                                                @endforeach
                                            </select>
                                        </form>
                                        <div
                                            class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div> --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-span-2">
            <!-- component -->
            <div class="bg-gray-200 min-h-screen pt-2 font-mono mb-10 mt-0 rounded-lg">
                <div class="container mx-auto">
                    <div class="inputs w-full max-w-2xl p-6 mx-auto">
                        <div class='flex flex-wrap -mx-3 mb-6'>

                            <div class="personal w-full border-t border-gray-400 pt-4">
                                <h2 class="text-2xl text-gray-900 capitalize">Title: {{ $course->title }}</h2>

                                <div class="flex items-center justify-between mt-4">
                                    <form action="{{ route('course-setting.update', ['course_setting' => $id]) }}"
                                        method="post">
                                        @method('PUT')
                                        @csrf
                                        <div class='w-full px-3 mb-6'>
                                            <label
                                                class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>Free
                                                Lesson Count</label>
                                            <input
                                                class='  bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-2 px-4 leading-tight focus:outline-none  focus:border-gray-500'
                                                type='number' value="{{ $freeLessonCount }}" required
                                                name="free_lessons_count">
                                            <x-main-button type="submit">submit</x-main-button>
                                        </div>
                                    </form>

                                </div>

                            </div>
                            <div class='w-full md:w-full px-3 mb-6'>
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>Set
                                    price rate</label>
                                <div class="flex-shrink w-full inline-block relative">
                                    <form action="{{ route('courses.coursePrice', ['course' => $course]) }}"
                                        method="POST">
                                        @csrf
                                        <div x-data="{ customPriceEnabled: false }" class="price-selector p-4">
                                            <label class=" mb-2">
                                                <input type="radio" name="price-option" value="50" checked
                                                    class="mr-2">
                                                $50
                                            </label>
                                            <label class=" mb-2">
                                                <input type="radio" name="price-option" value="100" class="mr-2">
                                                $100
                                            </label>
                                            <label class=" mb-2">
                                                <input type="radio" name="price-option" value="200" class="mr-2">
                                                $200
                                            </label>
                                            <label class=" mb-2 ">
                                                <input type="radio" name="price-option" value="custom" class="mr-2"
                                                    x-on:click="customPriceEnabled = true">
                                                Custom: $
                                                <input id="custom-price" step="10" min="0"
                                                    class="appearance-none bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-2 px-4 leading-tight focus:outline-none focus:border-gray-500"
                                                    type="number" name="custom-price"
                                                    x-bind:disabled="!customPriceEnabled">
                                            </label>
                                            <x-main-button type="submit" class="underline ">save</x-main-button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                            {{--  --}}
                            <div class='w-full md:w-full px-3 mb-6' x-show="selected === 'mailchimp'">
                                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>Select
                                    Mailchimp Audience</label>
                                <div class="flex-shrink w-full inline-block relative">
                                    <form action="{{ route('course-setting.saveSetting', ['courseId' => $course]) }}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="esp" value="mailchimp">
                                        <select
                                            class="block appearance-none text-gray-600 w-full bg-white border border-gray-400 shadow-inner px-4 py-2 pr-8 rounded"
                                            onchange="this.form.submit()" name="list_id">
                                            <option disabled selected>choose ...</option>
                                            @if (isset($lists))
                                                @foreach ($lists->lists as $list)
                                                    <option value="{{ $list->id }}">
                                                        {{ $list->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </form>
                                    <div
                                        class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            {{--  --}}
                            <div class='w-full md:w-full px-3 mb-6' x-show="selected === 'getresponse'">
                                <label
                                    class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>Select
                                    Get Response Audience</label>
                                <div class="flex-shrink w-full inline-block relative">
                                    <form
                                        action="{{ route('course-setting.saveGetResponseId', ['courseId' => $course]) }}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="esp" value="getresponse">
                                        <select
                                            class="block appearance-none text-gray-600 w-full bg-white border border-gray-400 shadow-inner px-4 py-2 pr-8 rounded"
                                            onchange="this.form.submit()" name="get_response_id">
                                            <option disabled selected>choose ...</option>
                                            @if (isset($getrepsonseAudience))

                                                @foreach ($getrepsonseAudience as $res)
                                                    <option value="{{ $res['audienceId'] }}">
                                                        {{ $res['name'] }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </form>
                                    <div
                                        class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{--  --}}
                            <div class='w-full md:w-full px-3 mb-6' x-show="selected === 'convertKit'">
                                <label
                                    class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2'>Select
                                    Convert Kit Audience</label>
                                <div class="flex-shrink w-full inline-block relative">
                                    <form action="{{ route('course-setting.convertKit', ['courseId' => $course]) }}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="esp" value="convertKit">
                                        <select
                                            class="block appearance-none text-gray-600 w-full bg-white border border-gray-400 shadow-inner px-4 py-2 pr-8 rounded"
                                            onchange="this.form.submit()" name="convert_id">
                                            <option disabled selected>choose ...</option>
                                            @if (isset($convert))
                                                @foreach ($convert as $res)
                                                    <option value="{{ $res['id'] }}">
                                                        {{ $res['name'] }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </form>
                                    <div
                                        class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

</x-app-layout>
