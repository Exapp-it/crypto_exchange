<div x-data="{ isFixed: false }">
    <div class="bg-white shadow-lg rounded-xl w-72 h-full max-w-xs">
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 transform flex items-center mb-10 py-8 px-6 rounded-t-lg">
            <img class="rounded-full w-20 h-20 ring-4 ring-opacity-20 ring-gray-200" src="{{ img('avatar.png') }}"
                alt="Avatar">
            <div class="ml-5">
                <h1 class="text-white tracking-wide text-lg">{{ $user->email }}</h1>
                <p class="text-gray-300 tracking-wider text-sm">{{ $user->external_id }}</p>
            </div>
        </div>
        <button
            class="text-white capitalize text-sm bg-gradient-to-r from-blue-600 to-blue-700 rounded-md flex items-center py-2 pl-3 pr-4 shadow-md mx-auto tracking-wider mb-5">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                </path>
            </svg> add branch</button>

        <ul class="px-8 relative pb-5">
            <li class="flex items-center text-gray-900 text-md py-4 hover:text-blue-600">
                <a href="{{ route('user') }}" class="flex items-center">
                    <span class="text-gray-400 mr-5 ">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2">
                            </path>
                        </svg>
                    </span> {{ __('Dashboard') }}
                </a>
            </li>
            <li class="flex items-center text-gray-900 text-md py-4 hover:text-blue-600">
                <a href="{{ route('user.wallets') }}" class="flex items-center">
                    <span class="text-gray-400 mr-5 ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                        </svg>

                    </span> {{ __('Wallet') }}
                </a>
            </li>
            <li class="flex items-center text-gray-900 text-md py-4 hover:text-blue-600">
                <a href="{{ route('trade') }}" class="flex items-center">
                    <span class="text-gray-400 mr-5 ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" />
                        </svg>


                    </span> {{ __('Transactions') }}
                </a>
            </li>

            <li class="flex items-center text-gray-900 text-md py-4 hover:text-blue-600">
                <div x-data="{ open: false }">
                    <div @click="open = !open" class="flex items-center cursor-pointer">
                        <span class="text-gray-400 mr-5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" />
                            </svg>

                        </span> {{ __('Trade') }}
                        <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <ul x-show="open" x-сloak class="py-2 space-y-2 text-center transition duration-300">
                        <li>
                            <a href="{{ route('trade.buy') }}"
                                class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-150 rounded-lg group hover:text-blue-600 pl-11">{{ __('Buy') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('trade.sell') }}"
                                class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-150 rounded-lg group hover:text-blue-600 pl-11">{{ __('Sell') }}</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-150 rounded-lg group hover:text-blue-600 pl-11">Invoice</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <div class="re">
            <div
                class="bg-gradient-to-r from-blue-600 to-blue-700 transform flex items-center  py-8 px-6 mb-auto rounded-t-lg">
                <img class="rounded-full w-20 h-20 ring-4 ring-opacity-20 ring-gray-200" src="{{ img('avatar.png') }}"
                    alt="Avatar">
                <div class="ml-5">
                    <h1 class="text-white tracking-wide text-lg">{{ $user->email }}</h1>
                    <p class="text-gray-300 tracking-wider text-sm">{{ $user->external_id }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // function init() {
    //     const scrollElement = this.$refs.scrollElement;
    //     const elementOffset = scrollElement.offsetTop;
    //     window.addEventListener('scroll', () => {
    //         const scrollPosition = window.scrollY;
    //         this.isFixed = scrollPosition >= elementOffset;
    //     });
    // }
</script>
