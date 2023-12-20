<div class="brand-block">
    <a class="uppercase font-bold text-green-400" href="{{route('home')}}">Exapp</a>
    <a class="" href="#">
        <img class="drop-shadow-2xl rounded-lg"
             src="https://linkslot.ru/uploads/16524b276407c6b1911f5b254834ee4e.jpeg" alt="">
    </a>
</div>
<header class="header">
    <nav class="header-nav">
        <ul class="inline-flex items-center">
            <li>
                <a class="header-link" href="{{route('home')}}">{{__('Home')}}</a>
            </li>
            <li>
                <a class="header-link" href="{{route('about')}}">{{__('About')}}</a>
            </li>
            <li>
                <a class="header-link" href="#">{{__('Contact')}}</a>
            </li>
        </ul>
        <ul class="inline-flex items-center">
            @auth()
                <li>
                    <span class="font-semibold text-green-500">${{moneyFormat($user->balanceAmount())}}</span>
                </li>

                <li>
                    <span
                        class="w-12 h-12 block bg-indigo-800 cursor-pointer ml-10 mr-5 rounded-full border border-red-600"></span>
                </li>
                <li>
                    <form action="{{route('auth.logout')}}" method="POST">
                        @csrf
                        <button>
                            {{__('Logout')}}
                        </button>
                    </form>
                </li>
            @endauth
            @guest()
                <li>
                    <button @click="openLoginModal" class="header-button">{{__('Login')}}</button>
                </li>

                <li>
                    <button @click="openRegisterModal" class="header-button">{{__('Register')}}</button>
                </li>
            @endguest
        </ul>
    </nav>
    <button class="inline-block md:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
        </svg>
    </button>
</header>
