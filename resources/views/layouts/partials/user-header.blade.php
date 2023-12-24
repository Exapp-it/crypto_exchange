<header class="w-full">
    <div class="flex px-5 py-3 justify-center border border-gray-100">
        <p class="text-center text-blue-600 text-sm font-medium">
            Love Alpine JS?
            <a href="#" class="inline-block underline">Check out this new course!</a>
        </p>
    </div>

    <div x-data="{ open: false }" class="flex flex-col px-5 py-5 mx-auto md:items-center md:justify-between md:flex-row">
        <div class="flex flex-row items-center justify-between lg:justify-start">
            <a class="text-lg font-bold tracking-tighter text-blue-600 transition duration-500 ease-in-out transform tracking-relaxed lg:pr-8"
                href="{{ route('home') }}"> <span class="text-green-400 font-bold">P2P</span> Crypto </a>
            <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-8 h-8">
                    <path x-show="!open" fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                    <path x-show="open" fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" style="display: none"></path>
                </svg>
            </button>
        </div>

        <nav :class="{ 'flex': open, 'hidden': !open }"
            class="flex-col items-center flex-grow hidden pb-4 border-blue-600 md:pb-0 md:flex md:justify-end md:flex-row lg:border-l-2 lg:pl-2">
            <a class="px-4 py-2 mt-2 text-sm text-gray-500 md:mt-0 hover:text-blue-600 focus:outline-none focus:shadow-outline transition duration-300"
                href="{{ route('main') }}">Main</a>
            @include('layouts.partials.home-menu')
            <div class="inline-flex items-center gap-2 pt-4  list-none lg:ml-auto">
                <div x-data="{ dropdownOpen: false }" class="relative">
                    <button @click="dropdownOpen = ! dropdownOpen"
                        class="relative block h-8 w-8 overflow-hidden shadow focus:outline-none">
                        <img class="object-cover rounded-lg"
                            src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=faceare&facepad=3&w=688&h=688&q=100"
                            alt="">

                    </button>

                    <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"
                        x-cloak></div>

                    <div x-show="dropdownOpen"
                        class="absolute right-0 mt-2 min-w-[300px] bg-white rounded-md overflow-hidden shadow-xl z-10"
                        x-transition:enter="transition ease-out duration-200 transform"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0" x-cloak>
                        <div class="flex items-center py-2 px-2 mx-2 space-x-4 border-b border-gray-200">
                            <img class="object-cover rounded-lg w-14 h-14"
                                src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=faceare&facepad=3&w=688&h=688&q=100"
                                alt="">
                            <span class="pr-4">{{ $user->email }}</span>
                        </div>
                        <div class="py-2 px-4">
                            <form action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                <button
                                    class="block w-full px-4 py-2 text-sm rounded-lg text-gray-700 hover:bg-red-600 hover:text-white">
                                    {{ __('Logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
