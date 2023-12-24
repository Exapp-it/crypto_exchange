@extends('layouts.home')

@section('title', __('Home Page'))

@section('home.content')

    <section>
        <h2 class="text-2xl font-semibold text-center text-gray-800 capitalize lg:text-3xl">
            Buy Or Sell <br>
            <span class="text-blue-500">Cryptocurrency</span>
        </h2>
        <div class="relative items-center w-full py-12">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <div class="w-full max-w-2xl my-4 bg-white shadow-xl rounded-xl">
                    <div class="p-6">
                        <div>
                            <div class="mt-3 text-left sm:mt-5">
                                <span class="mb-8 text-xs font-semibold tracking-widest text-blue-600 uppercase">Buy
                                    cryptocurrency</span>
                                <div class="mt-2">
                                    <p class="mt-3 text-base leading-relaxed text-gray-500">This code expires in 24
                                        hours.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="justify-end mt-6">
                            <label for="email" class="sr-only">Email</label>
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-8 h-8 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                        </path>
                                    </svg>
                                </div>
                                <input type="text"
                                    class="w-full px-5 py-3 pl-10 text-base text-neutral-600 border-none rounded-lg bg-gray-50">
                            </div>
                        </div>

                        <div class="flex gap-2 mt-0 lg:mt-6 max-w-7xl">
                            <div class="mt-3 rounded-lg sm:mt-0">
                                <button
                                    class="items-center block px-10 py-3.5 text-base font-medium text-center text-blue-600 transition duration-500 ease-in-out transform border-2 border-white shadow-md rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Decline</button>
                            </div>
                            <div class="mt-3 rounded-lg sm:mt-0 sm:ml-3">
                                <button
                                    class="items-center block px-10 py-4 text-base font-medium text-center text-white transition duration-500 ease-in-out transform bg-blue-600 rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Accept</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full max-w-2xl mx-auto my-4 bg-white shadow-xl rounded-xl">
                    <div class="p-6">
                        <div>
                            <div class="mt-3 text-left sm:mt-5">
                                <span class="mb-8 text-xs font-semibold tracking-widest text-blue-600 uppercase">Sell
                                    cryptocurrency</span>
                                <div class="mt-2">
                                    <p class="mt-3 text-base leading-relaxed text-gray-500">This code expires in 24
                                        hours.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="justify-end mt-6">
                            <label class="sr-only">Email</label>
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-8 h-8 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                        </path>
                                    </svg>
                                </div>
                                <input type="text"
                                    class="w-full px-5 py-3 pl-10 text-base text-neutral-600 border-none rounded-lg bg-gray-50">
                            </div>
                        </div>

                        <div class="flex gap-2 mt-0 lg:mt-6 max-w-7xl">
                            <div class="mt-3 rounded-lg sm:mt-0">
                                <button
                                    class="items-center block px-10 py-3.5 text-base font-medium text-center text-blue-600 transition duration-500 ease-in-out transform border-2 border-white shadow-md rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Decline</button>
                            </div>
                            <div class="mt-3 rounded-lg sm:mt-0 sm:ml-3">
                                <button
                                    class="items-center block px-10 py-4 text-base font-medium text-center text-white transition duration-500 ease-in-out transform bg-blue-600 rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Accept</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="https://files.coinmarketcap.com/static/widget/coinPriceBlock.js"></script>
    <div id="coinmarketcap-widget-coin-price-block" coins="1,1027,825,1839" currency="USD" theme="light"
        transparent="false" show-symbol-logo="true">
    </div>

    <section>
        <div class="py-20">
            <div class="text-center">
                <div class="grid grid-cols-5 gap-4 lg:grid-cols-5">
                    @isset($currencies)
                        @foreach ($currencies as $currency)
                            <div>
                                <img class="h-8 lg:h-20" src="{{ asset(Storage::url($currency->icon)) }}"
                                    alt="{{ $currency->name }}">
                            </div>
                        @endforeach
                    @endisset

                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="py-20">
            <h2 class="text-2xl font-semibold text-center text-gray-800 capitalize lg:text-3xl">explore our <br> awesome
                <span class="text-blue-500">Components</span>
            </h2>

            <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-16 md:grid-cols-2 xl:grid-cols-3">
                <div
                    class="flex flex-col items-center p-6 space-y-3 text-center bg-gray-100 rounded-xl hover:shadow-lg transform hover:scale-105 transition duration-500">
                    <span class="inline-block p-3 text-blue-500 bg-blue-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </span>

                    <h1 class="text-xl font-semibold text-gray-700 capitalize">Copy & paste components</h1>

                    <p class="text-gray-500">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident ab nulla quod dignissimos vel non
                        corrupti doloribus voluptatum eveniet
                    </p>

                    <a href="#"
                        class="flex items-center -mx-1 text-sm text-blue-500 capitalize transition-colors duration-300 transform hover:underline hover:text-blue-600">
                        <span class="mx-1">read more</span>
                        <svg class="w-4 h-4 mx-1 rtl:-scale-x-100" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>

                <div
                    class="flex flex-col items-center p-6 space-y-3 text-center bg-gray-100 rounded-xl hover:shadow-lg transform hover:scale-105 transition duration-500">
                    <span class="inline-block p-3 text-blue-500 bg-blue-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                    </span>

                    <h1 class="text-xl font-semibold text-gray-700 capitalize">Zero Configuration</h1>

                    <p class="text-gray-500">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident ab nulla quod dignissimos vel non
                        corrupti doloribus voluptatum eveniet
                    </p>

                    <a href="#"
                        class="flex items-center -mx-1 text-sm text-blue-500 capitalize transition-colors duration-300 transform hover:underline hover:text-blue-600">
                        <span class="mx-1">read more</span>
                        <svg class="w-4 h-4 mx-1 rtl:-scale-x-100" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>

                <div
                    class="flex flex-col items-center p-6 space-y-3 text-center bg-gray-100 rounded-xl hover:shadow-lg ttransform hover:scale-105 transition duration-500">
                    <span class="inline-block p-3 text-blue-500 bg-blue-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                    </span>

                    <h1 class="text-xl font-semibold text-gray-700 capitalize">Simple & clean designs</h1>

                    <p class="text-gray-500">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident ab nulla quod dignissimos vel non
                        corrupti doloribus voluptatum eveniet
                    </p>

                    <a href="#"
                        class="flex items-center -mx-1 text-sm text-blue-500 capitalize transition-colors duration-300 transform hover:underline hover:text-blue-600">
                        <span class="mx-1">read more</span>
                        <svg class="w-4 h-4 mx-1 rtl:-scale-x-100" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="py-20 w-full mx-auto lg:py-40">
            <div class="flex flex-wrap items-center mx-auto max-w-7xl">
                <div class="w-full lg:max-w-lg lg:w-1/2 rounded-xl">
                    <div>
                        <div class="relative w-full max-w-lg">
                            <div
                                class="absolute top-0 rounded-full bg-blue-300 -left-4 w-72 h-72 mix-blend-multiply filter blur-xl opacity-70 animate-blob">
                            </div>

                            <div
                                class="absolute rounded-full bg-sky-300 -bottom-24 right-20 w-72 h-72 mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000">
                            </div>
                            <div class="relative">
                                <img class="bject-cover object-center" alt="feature"
                                    src="{{ asset(Storage::url('images/feature.png')) }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-col items-start mt-12 mb-16 text-left lg:flex-grow lg:w-1/2 lg:pl-6 xl:pl-24 md:mb-0 xl:mt-0">
                    <span class="mb-8 text-xs font-bold tracking-widest text-blue-600 uppercase"> Your tagline </span>
                    <h1
                        class="mb-8 text-4xl font-bold leading-none tracking-tighter text-neutral-600 md:text-7xl lg:text-5xl">
                        Medium length display headline.</h1>
                    <p class="mb-8 text-base leading-relaxed text-left text-gray-500">Free and Premium themes, UI Kit's,
                        templates and landing pages built with Tailwind CSS, HTML &amp; Next.js.</p>
                    <p class="mb-8 text-base leading-relaxed text-left text-gray-500">Free and Premium themes, UI Kit's,
                        templates and landing pages built with Tailwind CSS, HTML &amp; Next.js.</p>
                    <div class="flex-col mt-0 lg:mt-6 max-w-7xl sm:flex">
                        <div class="prose prose-md">
                            <ul>
                                <li class="text-gray-500">Ain't no sunshine when she's gone.</li>
                                <li class="text-gray-500">Expensive feature.</li>
                                <li class="text-gray-500">Really good feauture.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
